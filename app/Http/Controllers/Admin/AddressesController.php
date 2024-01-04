<?php

namespace App\Http\Controllers\Admin;

use App\AddressFixedLandLine;
use App\AddressMobile;
use App\AddressPhone;
use App\AddressStreetAddress;
use App\Http\Controllers\Controller;
use App\Address;
use App\Jobs\AddressesImportByPieces;
use App\Jobs\AddressesImportCompleted;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $addresses = Address::where('gender', '=', "$keyword")
                ->orWhere('mobile1', '=', "$keyword")
                ->orWhere('mobile2', '=', "$keyword")
                ->orWhere('mobile3', '=', "$keyword")
                ->orWhere('mobile4', '=', "$keyword")
                ->orWhere('phone1', '=', "$keyword")
                ->orWhere('phone2', '=', "$keyword")
                ->orWhere('phone3', '=', "$keyword")
                ->orWhere('zipcode', '=', "$keyword")
                ->orWhere('town', '=', "$keyword")
                ->orWhere('birthdate', '=', "$keyword")
                ->orWhere('living', '=', "$keyword")
                ->paginate($perPage);
        } else {
            $addresses = Address::paginate($perPage);
        }

        return view('admin.addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        Address::create($requestData);

        Cache::flush();

        return redirect('admin/addresses')->with('flash_message', 'Address added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $address = Address::findOrFail($id);

        return view('admin.addresses.show', compact('address'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $address = Address::findOrFail($id);

        return view('admin.addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $address = Address::findOrFail($id);
        $address->update($requestData);

        Cache::flush();

        return redirect('admin/addresses')->with('flash_message', 'Address updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Address::destroy($id);

        Cache::flush();

        return redirect('admin/addresses')->with('flash_message', 'Address deleted!');
    }

    public function importView()
    {
        $files = Storage::files('addresses');

        return view('admin.addresses.import', [
            'files' => array_filter($files, function ($var) {
                return $var != 'addresses/.gitignore';
            })
        ]);
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $path = $request->get('name');

        if (!Storage::disk('local')->exists($path))
            return redirect()->back()->withErrors('Import file does not exists!');

        Address::truncate();
        AddressStreetAddress::truncate();
        AddressPhone::truncate();
        AddressMobile::truncate();
        AddressFixedLandLine::truncate();

        dispatch(new AddressesImportByPieces($path));
        dispatch(new AddressesImportCompleted($path))->onQueue(config('queue.connections.redis.low_queue'));

        Setting::updateOrInsert(
            ['key' => 'import_running'],
            ['value' => '1']
        );

        return redirect()->back()->with('flash_message', 'Import queued!');
    }
}
