<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AddressesExport;
use App\Http\Controllers\Controller;

use App\Jobs\ExportCompleted;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
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
            $orders = Order::where('matching_records', 'LIKE', "%$keyword%")
                ->orWhere('id', $keyword)
                ->orWhere('first_name', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('company_name', 'LIKE', "%$keyword%")
                ->orWhere('organization_number', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('postal_address', 'LIKE', "%$keyword%")
                ->orWhere('zip', 'LIKE', "%$keyword%")
                ->orWhere('area', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $orders = Order::latest()->paginate($perPage);
        }

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.orders.create');
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
        $this->validate($request, [
			'number_to_purchase' => 'required'
		]);
        $requestData = $request->all();

        Order::create($requestData);

        return redirect('admin/orders')->with('flash_message', 'Order added!');
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
        $order = Order::findOrFail($id);

        return view('admin.orders.show', compact('order'));
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
        $order = Order::findOrFail($id);

        return view('admin.orders.edit', compact('order'));
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
        $this->validate($request, [
			'number_to_purchase' => 'required',
            'price' => 'required',
            'vat' => 'required',
            'email' => 'required',
            'payment_option' => 'required'
		]);
        $requestData = $request->all();

        $order = Order::findOrFail($id);
        $order->update($requestData);

        return redirect('admin/orders')->with('flash_message', 'Order updated!');
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
        Order::destroy($id);

        return redirect('admin/orders')->with('flash_message', 'Order deleted!');
    }

    public function storeExportData($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status == Order::STATUS_EXPORTING)
            return redirect()->back()->withErrors('Export is already queued!');
        if ($order->status == Order::STATUS_EXPORTED)
            return redirect()->back()->withErrors('Data has already been exported!');

        (new AddressesExport($order))->store($order->prepareToExport())->chain([
            new ExportCompleted($order)
        ]);

        return redirect('admin/orders')->with('flash_message', 'Export queued!');
    }

    public function email($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status != Order::STATUS_EXPORTED)
            return redirect()->back()->withErrors('Export data is not prepared yet!');

        Notification::route('mail', $order->email)->notify(new \App\Notifications\ExportCompleted($order));

        return redirect('admin/orders')->with('flash_message', 'Email message has been sent!');
    }

    public function download($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status != Order::STATUS_EXPORTED)
            return redirect()->back()->withErrors('Export data is not prepared yet!');

        if (!Storage::disk('local')->exists($order->path))
            return redirect()->back()->withErrors('Export data is not prepared yet!');

        return Storage::disk('local')->download($order->path);
    }
}
