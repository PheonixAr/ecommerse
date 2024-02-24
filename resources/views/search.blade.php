@extends('master')
@section('content')
    <div class="custom-product">
        <div class="col-sm-4">
            <a href="#">Filter</a>
        </div>
        <div class="col-sm-5">
            <div class="trending-wrappers">
                <div class="serchitem ">
                    <h4>Result for Products</h4>
                    @foreach ($product as $item)
                        <div class="searched-item">
                            <a href="detail/{{ $item['id'] }}">
                                <div class="search-img">
                                    <img class="trending-image" src="{{ $item['gallery'] }}">
                                </div>
                                <div class="search-content">
                                    <h2>{{ $item['name'] }}</h2>
                                    <h5>{{ $item['description'] }}</h5>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
