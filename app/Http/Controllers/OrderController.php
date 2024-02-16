<?php

namespace App\Http\Controllers;

use App\Imports\OrderExcludes;
use App\Notifications\OrderCreated;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

use App\Subscriber;
use App\Transaction;
use App\Notifications\Receipt;
use Illuminate\Support\Facades\Mail;
use App\Mail\Subscribe;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    // public function __construct(Request $request)
    // {
    //     session()->put('order', null);
    //     session()->put('exclude', null);        
    // }
    public function subscribe(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers'
        ]);
        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $email = $request->all()['email'];

        $subscriber = Subscriber::create([
            'email' => $email
            ]);

            if($subscriber){
                Mail::to($email)->send(new Subscribe($email));
                return new JsonResponse(['success' => true, 'message' => "Thank you for subscribing to our mail, please check your inbox"], 200);

            }        
    }

    public function index()
    {        
    //  $temp = Transaction::first();
    //     // dd($temp);
    //Notification::route('mail', config('custom.admin_email'))->notify(new Receipt($temp));

        $order = session('order');
        if (!$order) $order = new Order();        
        session(['order' => $order]);
        return view('orders.index', compact('order'));
    }

    public function test()
    {
        $order = session('order');
        if (!$order) $order = new Order();
        
        session(['order' => $order]);

        return view('orders.test', compact('order'));
    }
    public function filters(Request $request)
    {
        $order = Order::make($request->get('filters'));        
        if ($request->has('filters.excluding')) $order->exclude = session('exclude');

        session(['order' => $order]);

        return View::make('orders.partials.selected', compact('order'));
    }

    public function selected(Request $request)
    {
        $order = Order::make($request->get('selected'));

        if ($request->has('filters.excluding')) $order->exclude = session('exclude');

        session(['order' => $order]);

        return View::make('orders.partials.' . $request->get('tab') . '-tab', compact('order'));
    }

    public function excludes(Request $request)
    {   
        $this->validate($request, [
            'file' => 'required|mimes:csv,txt|max:10240'
        ]);

        Excel::import(new OrderExcludes(), $request->file('file'));

        $order = session('order');
        $order->exclude = session('exclude');

        return [
            'selected' => view('orders.partials.selected', compact('order'))->render(),
            'filters' => view('orders.partials.exclude-tab', compact('order'))->render(),
        ];
    }

    public function create(Request $request) //to get the matching records. when clicking the matching record button.
    {
        $data = $request->only([
            'filters.gender', 'filters.age', 'filters.geography',
            'filters.living_type', 'filters.phone_numbers', 'filters.excluding'
        ]);
        
        $order = Order::make($data['filters']);        
        $model = '\App\Address' . ucfirst($order->phone_numbers);

        if ($request->has('filters.excluding')) {
            $order->exclude = session('exclude');
            $order->matching_records = $model::matchingRecords($order)->count();
        } else {
            $order->matching_records = Cache::rememberForever(json_encode($data), function () use ($order, $model) {
                return $model::matchingRecords($order)->count();
            });
        }

        session(['order' => $order]);
        return number_format($order->matching_records);
    }

    public function counters(Request $request) //to get the sales summary data.
    {
        $order = session('order');

        if (!$order) $order = new Order;

        $this->validate(
            $request,
            [
                'number_to_purchase' => 'required|integer|max:' . ($order->matching_records ? $order->matching_records : 20)
            ],
            [
                'number_to_purchase.max' => __('The :attribute may not be greater than matching records')
            ]
        );

        $order->number_to_purchase = $request->get('number_to_purchase');
        $order->discount_code = $request->get('discount_code');
        session(['order' => $order]);
        
        return view('orders.partials.counters', compact('order'));
    }

    public function confirm() 
    {
        $order = session('order');
        if (!$order) return redirect('/')->withErrors(__('Fill in order info first!'));
        if (!$order->number_to_purchase) return redirect('/')->withErrors(__('Enter the desired number to purchase!'));

        return view('orders.confirm', compact('order'));
    }

    public function addressConfirm()
    {
        $order = session('order');        
        if (!$order) return redirect('/')->withErrors(__('Fill in order info first!'));
        if (!$order->number_to_purchase) return redirect('/')->withErrors(__('Enter the desired number to purchase!'));

        return view('orders.addressConfirm', compact('order'));
        
    }

    public function store(Request $request) // when clicking the submit button with contact info, 
    {
        
        $validator = Validator::make($request->all(), [
            // 'g-recaptcha-response' => 'required|captcha',
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'email' => 'required|email',
            'postal_address' => 'required',
            'zip' => 'required',
            'company_name' => 'required',
            'organization_number' => 'required',
            'phone' => 'required|string|max:110',
            'message' => 'required|string',
            'area' => 'required|string',
            'payment_option' => 'required|in:' . implode(',', array_keys(Order::$payment_options)),
        ]);

        /** @var Order $order */
        $order = session('order');           
        if (!$order) return redirect('/')->withErrors(__('Fill in order info first!'));

        foreach ($request->except(['g-recaptcha-response', 'terms', '_token']) as $key => $val) {
            $order->{$key} = $val;
        }

        // foreach ($request->except(['terms', '_token']) as $key => $val) {
        //     $order->{$key} = $val;
        // }
        if ($validator->fails()) {
            Session::flash('errors', $validator->messages());
            session(['order' => $order]);
            return redirect('orders/addressConfirm');
        }
        if (($order->totalToPay > config('custom.payson_limit')) && ($order->payment_option == Order::PAYMENT_OPTION_STRIPE))
            return redirect('/')->withErrors(__('validation.payson_limit_exceeded'));
            //$order->payment_option = 'invoice';//remove it later
        $order->save();                
        if ($order->payment_option == 'invoice') {      
            //dd('invoice statues entered')      ;
            Notification::route('mail', config('custom.invoiced_order_email'))
                ->notify(new OrderCreated($order));

            return redirect('thanks')->with('order', $order);
        }
        $uuidObject = $order->id; // Assuming $order->id contains the UUID object
        $uuidValue = $uuidObject->toString(); // Retrieve the UUID value as a string
        //dd($uuidValue);        

        return redirect('transactions/' . $uuidValue);
    }

    public function nixValidation($id)
    {
        
        $order = Order::findOrFail($id);

        $order->nix_validation = true;
        
        $order->save();        
        return redirect('transactions/' . $order->id);
    }

    public function download($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status != Order::STATUS_EXPORTED)
            return redirect('/')->withErrors(__('Export data is not prepared yet!'));

        if (!Storage::disk('local')->exists($order->path))
            return redirect('/')->withErrors(__('Export data is not prepared yet!'));

        return Storage::disk('local')->download($order->path, 'addresses.xlsx');
    }
}
