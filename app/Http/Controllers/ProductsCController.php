<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\product_catagory;
use App\Models\customer;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class ProductsCController extends Controller
{
    public function products()
    {
        $products = products::first()->paginate(4);

        return view('productupload.products', compact('products'));
    }
    //add product
    public function addProduct(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|',
                'price' => 'required',
                'category' => 'required',
                'description' => 'required',
                'gallery' => 'required'


            ],
            // [
            //     'name.required' => 'Name is Required',
            //     'name.unique' => 'Customer Already Exists',
            //     'email.required' => 'Email is Required',
            //     'email.unique' => 'Email Already Exists',
            //     'phone.required' => 'Phone is Required',
            //     'role.required' => 'Role is Required',
            //     'password' => 'password is Required'



            // ]

        );

        $product = new products();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->product_categoryId = $request->category;
        $product->description = $request->description;
        $product->gallery = $request->gallery;

        $product->save();

        return response()->json([
            'status' => 'success',
        ]);
    }


    //update product
    public function updateProduct(Request $request)
    {
        $request->validate(
            [
                'up_name' => 'required|unique:products,name,' . $request->up_id,
                'up_price' => 'required',
                'up_category' => 'required',
                'up_description' => 'required',
                'up_gallery' => 'required'


            ],
            // [
            //     'up_name.required' => 'Name is Required',
            //     'up_price.unique' => 'priice Already Exists',
            //     'up_catagory.required' => 'Phone is Required',
            //     'up_desctripton.required' => 'role is Required',
            //     'up_gallery' => 'password is required'



            // ]

        );

        // products::where('id', $request->up_id)->update([
        //     'name' => $request->up_name,
        //     'price' => $request->up_price,
        //     'category' =>  $request->up_category,
        //     'product_catagoryId' =>,
        //     'description' => $request->up_description,
        //     'gallery' => $request->up_gallery,
        // ]);
        products::where('id', $request->up_id)->update([
            'name' => $request->up_name,
            'price' => $request->up_price,
            'category' =>  $request->up_category,
            // 'product_catagory' => $product_catagory,
            'description' => $request->up_description,
            'gallery' => $request->up_gallery,
        ]);


        return response()->json([
            'status' => 'success',
        ]);
    }

    public function deleteProduct(Request $request)
    {
        products::find($request->product_id)->delete();
        return response()->json([
            'status' => 'success',

        ]);
    }

    public function pagination(Request $request)
    {
        $products = products::first()->paginate(4);
        return view('productupload.pagination_products', compact('products'))->render();
    }

    //search product
    public function searchProduct(Request $request)
    {
        $products = products::where('name', 'like', '%' . $request->search_string . '%')

            ->orWhere('price', 'like', '%' . $request->search_string . '%')
            ->orWhere('category', 'like', '%' . $request->search_string . '%')
            ->orWhere('description', 'like', '%' . $request->search_string . '%')
            ->orderBy('id', 'asc')
            ->paginate(5);

        if ($products->count() >= 1) {
            return view('productupload.pagination_products', compact('products'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found',
            ]);
        }
    }
}
