@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Product Images Carousel -->
                <div id="productImagesCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($product->images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset($image->url) }}" class="d-block w-100" alt="Product Image">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#productImagesCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productImagesCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Product Details -->
                <h2>{{ $product->name }}</h2>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                <p><strong>Brand:</strong> {{ $product->brand }}</p>
                <p><strong>SKU:</strong> {{ $product->sku }}</p>
                <p><strong>Availability:</strong> {{ $product->availability ? 'In Stock' : 'Out of Stock' }}</p>
                <p><strong>Category:</strong> {{ $product->category->name }}</p>
            </div>
        </div>
    </div>
@endsection
