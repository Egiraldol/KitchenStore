<!--By Esteban Giraldo Llano-->

@extends('layouts.app')
@section('title', $viewData["title"])
@section('content')
<div class="container">
    @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
    <form action="{{ route('product.index') }}" method="GET" class="mb-3" id="sort_form">
        <div class="mb-2">
            <label for="order_by">
                <i class="fa-solid fa-filter"></i>
                Order By:
            </label>
        </div>
        <select name="order_by" id="order_by" class="form-control" onchange="document.getElementById('sort_form').submit();">
            <option value="random" @if(Request::input('order_by') == 'random') selected @endif>Recomended</option>
            <option value="most_purchased" @if(Request::input('order_by') == 'most_purchased') selected @endif>Most purchased</option>
            <option value="newest" @if(Request::input('order_by') == 'newest') selected @endif>Newest Products</option>
            <option value="highest_review" @if(Request::input('order_by') == 'highest_review') selected @endif>Best rated</option>
        </select>
    </form>

    <div class="row d-flex align-items-stretch">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        @foreach ($viewData['products'] as $product)
        <div class="col-md-4 col-lg-3 mb-2">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h5 style="font-weight: bold; text-align:center;">{{ $product->getName() }}</h5>
                    <div class="container">
                        <img src="{{ $product->getImages() }}" alt="Product Image" style="display: block; width: 100px; height: 100px; object-fit: cover; margin: 0 auto;">
                    </div>
                    <p >{{ $product->getDescription() }}</p>
                    <p style="text-align: left;">Stock: {{ $product->getStock() }}</p>
                    <p>${{ number_format($product->getPrice(), 0, ',', '.') }}</p>
                    <a href="{{ route('product.show', ['id'=> $product->getId()]) }}" class="btn bg-primary text-white mt-auto">More details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
</div>
@endsection
