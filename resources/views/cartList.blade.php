@extends('master')
@section('content')
    <div class="custom-product">
        <div class="col-sm-10">
            <div class="trending-wrapper">
                <h4>Result for Products</h4>

                @if ($product == null )
                    <h4>$product </h4>
                @endif
                @if ($product)
                    @foreach ($product as $item)
                        <div class=" row searched-item cart-list-devider">
                            <div class="col-sm-3">
                                <a href="detail/{{ $item->id }}">
                                    <img class="trending-image" src="{{ $item->gallery }}">
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <div class="cartlist-content">
                                    <h3 style="font-weight:600">{{ $item->name }}</h3>
                                    <h5 style="font-weight:500">{{ $item->description }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <a style="margin-top:9px" href="/removecart/{{ $item->cart_id }}"
                                    class="btn btn-warning">Remove to Cart</a>
                                <a style="margin-top:8px" class="btn btn-success" href="ordernow">Order Now</a>

                            </div>
                        </div>
                    @endforeach
                    <a class="btn btn-success" href="orderall">Order All</a> <br> <br>
            </div>
        @else
            @endif
        </div>
    </div>
@endsection
