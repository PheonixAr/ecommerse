<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\Cart;
use App\Models\order;
use Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    // public function checkout(Request $req)
    // {
    //     $userId = Session::get('user')['id'];
    //     $total  = DB::table('cart')
    //         ->join('products', 'cart.product_id', '=', 'products.id')
    //         ->where('cart.user_id', $userId)
    //         ->get();
    //     if ($req->payment === 'online') {

    //         return view('checkout', compact('total'));
    //     }
    //     return redirect('myorders');
    // }

    public function checkout(Request $req)
    {
        $userId = Session::get('user')['id'];
        $product = cart::join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select('products.*', 'cart.id as cart_id')
            ->get();
        $empty = 1;
        return view('checkout', compact('product', 'empty'));
    }


    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $productname = $request->get('productname');
        $totalprice = $request->get('total');
        $two0 = "00";
        $total = "$totalprice$two0";

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'INR',
                        'product_data' => [
                            "name" => $productname,

                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],

            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }



    // public function stripe(Request $request)
    // {
    //     $stripe = new \Stripe\StripeClient(config('stripe.sk'));
    //     $response = $stripe->checkout->sessions->create([
    //         'line_items' => [
    //             [
    //                 'price_data' => [
    //                     'currency' => 'usd',
    //                     'product_data' => [
    //                         'name' => $request->product_name,
    //                     ],
    //                     'unit_amount' => $request->price * 100,
    //                 ],
    //                 'quantity' => $request->quantity,
    //             ],
    //         ],
    //         'mode' => 'payment',
    //         'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
    //         'cancel_url' => route('cancel'),
    //     ]);
    //     //dd($response);
    //     if (isset($response->id) && $response->id != '') {
    //         session()->put('product_name', $request->product_name);
    //         session()->put('quantity', $request->quantity);
    //         session()->put('price', $request->price);
    //         return redirect($response->url);
    //     } else {
    //         return redirect()->route('cancel');
    //     }
    // }

    public function success(Request $request)
    {
        if (isset($request->session_id)) {

            $stripe = new \Stripe\StripeClient(config('stripe.sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);
            //dd($response);

            $payment = new Payment();
            $payment->payment_id = $response->id;
            $payment->product_name = session()->get('product_name');
            $payment->quantity = session()->get('quantity');
            $payment->amount = session()->get('price');
            $payment->currency = $response->currency;
            $payment->customer_name = $response->customer_details->name;
            $payment->customer_email = $response->customer_details->email;
            $payment->payment_status = $response->status;
            $payment->payment_method = "Stripe";
            $payment->save();

            return "Payment is successful";

            session()->forget('product_name');
            session()->forget('quantity');
            session()->forget('price');
        } else {
            return redirect()->route('cancel');
        }
        // return redirect('/order')->with('success', "Thanks for you order You have just completed your payment. The seeler will reach out to you as soon as possible");
    }
    public function cancel()
    {
        return "Payment is canceled.";
    }
}
