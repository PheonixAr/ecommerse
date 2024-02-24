<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\product_catagory;
use App\Models\Cart;
use App\Models\order;
// use Illuminate\Contracts\Session\Session;
use Session;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function index()
    {
        // return view('product');

        // $items = products::all();
        $items = products::all();
        $product_catagory['catagory'] = product_catagory::join('products', 'products.product_catagoryId', '=', 'product_catagory.product_catagoryId')->select('catagory')
            ->get();
        $count = 0;
        // $s = [];
        // foreach ($product_catagory as $row) {

        //     $s[$row['product_catagoryId']] = $row['catagory'];
        // }
        return view('product', compact('items', 'product_catagory', 'count'));
    }
    public function detail($id)
    {
        $product = products::find($id);

        return view('details', compact('product'));
    }

    // public function product_forignkey(){
    //     $product = products_catagory::
    // }

    public function search(Request $req)
    {
        $product = products::where('name', 'like', '%' . $req->input('query') . '%')
            ->orwhere('product_catagoryId', 'like', '%' . $req->input('query') . '%')
            ->get();


        return view('search', compact('product'));
    }

    public function addToCart(Request $req)
    {
        if ($req->session()->has('user')) {
            $cart = new Cart;
            $cart->user_id = $req->session()->get('user')['id'];
            $cart->product_id = $req->product_id;
            $cart->save();
            return redirect('cartlist');
        } else {
            return redirect('/login');
        }
    }

    public static function cartItem()
    {
        $userId = Session::get('user')['id'];
        return Cart::where('user_id', $userId)->count();
    }

    public static function ordercancel()
    {
        $userId = Session::get('user')['id'];
        return order::where('user_id', $userId)->count();
    }

    public  function cartList()
    {
        $userId = Session::get('user')['id'];
        $product = cart::join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select('products.*', 'cart.id as cart_id')
            ->get();
        $empty = 1;
        return view('cartList', compact('product', 'empty'));
    }
    public function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('cartlist');
    }
    public function ordernow()
    {
        $userId = Session::get('user')['id'];
        $total  = cart::join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->sum('products.price');

        return view('ordernow', compact('total'));
    }

    public function buynow()
    {
        $userId = Session::get('user')['id'];
        $total  = cart::join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->sum('products.price');

        return view('details', compact('total'));
    }

    public function orderplace(Request $req)
    {

        $userId = Session::get('user')['id'];
        $allcart = Cart::where('user_id', $userId)->get();
        foreach ($allcart as $cart) {
            $order = new order();
            $order->product_id = $cart['product_id'];
            $order->user_id = $cart['user_id'];
            $order->status = 'pending';
            $order->payment_method = $req->payment;
            $order->payment_status = 'pending';
            $order->address = $req->address;
            $order->save();
            Cart::where('user_id', $userId)->delete();
        }
        $req->input();
        if ($req->payment === 'online') {
            return redirect('/');
        }
        return redirect('/checkout');
    }
    public function myorders()
    {
        $userId = Session::get('user')['id'];
        $orders = order::join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.user_id', $userId)
            ->get();
        return view('myorders', compact('orders'));
    }

    public function pastcontent(Request $req)
    {
        if ($req->ajax()) {
            $output = "";
            $content = $req->search;
            $output = $content;
        }
        return Response($output);
    }

    public function payment()
    {
        return view('payment');
    }

    public function session(Request $request)
    {
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        $stripe = new \Stripe\StripeClient('sk_test_51OFR1sAC4lfPhNEmX6zAtr20XXzKaonx6PSrT5jrfOVnNKGLK8JKYIgRj8sUiwsIEFoo6iBzv9SpwgnumyQYVGNG002GCHulbi');

        $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => ['name' => 'T-shirt'],
                        'unit_amount' => 2000,
                        'tax_behavior' => 'exclusive',
                    ],
                    'adjustable_quantity' => [
                        'enabled' => true,
                        'minimum' => 1,
                        'maximum' => 10,
                    ],
                    'quantity' => 1,
                ],
            ],
            'automatic_tax' => ['enabled' => true],
            'mode' => 'payment',
            'success_url' => 'https://example.com/success',
            'cancel_url' => 'https://example.com/cancel',
        ]);

        // return redirect()->away($session->url);
    }

    public function productupload(Request $request)
    {
        // $product = product::
        return view('productupload');
    }
}
