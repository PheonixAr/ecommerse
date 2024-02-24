@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img class="detail-img" src="{{ $product['gallery'] }}" alt="">
            </div>
            <div class="col-sm-6">
                <a href="/">Go Back</a>
                <h2 style=" font-weight:bold;">{{ $product['name'] }}</h2>
                <h4 style="font-weight:550">Price : $ {{ $product['price'] }}</h4>
                <h5><span style="font-weight:590">Details:</span> {{ $product['description'] }}</h5>
                <h5><span style="font-weight:550">category:</span> {{ $product['category'] }}</h5>
                <form action="/add_to_cart" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value={{ $product->id }}>
                    <button id ='btn-details' class="btn btn-primary">Add Cart</button>
                    <button id ='btn-details' class="btn btn-success">Buy Now</button>


                </form>
                @if (Session::has('success'))
                    <p style="color:green;">{{ Session::get('success') }}</p>
                @endif


            </div>
        </div>
    </div>
@endsection
