@extends('layouts.app')
@section('content')
    <div class="w-25 mx-auto">
        <h2 class="text-center">Update Product</h2>
        <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group mt-2">
                <label for="name">Name:</label>
                <input value="{{ $product->name }}" type="text" class="form-control" id="name" name="name"
                    placeholder="Enter product name">
                @if ($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group mt-2">
                <label for="price">Price:</label>
                <input value="{{ $product->price }}" type="text" class="form-control" id="price" name="price"
                    placeholder="Enter product price">
                @if ($errors->has('price'))
                    <div class="text-danger">{{ $errors->first('price') }}</div>
                @endif
            </div>
            <div class="form-group mt-2">
                <label for="brand">Brand:</label>
                <input type="text" value="{{ $product->brand }}" class="form-control" id="brand" name="brand"
                    placeholder="Enter product brand">
                @if ($errors->has('brand'))
                    <div class="text-danger">{{ $errors->first('brand') }}</div>
                @endif
            </div>
            <div class="form-group mt-2">
                <label for="brand">Category:</label>
                <select class="form-select form-select-sm" name="category" aria-label=".form-select-sm example">
                    <option disabled>Open this select category</option>
                    @foreach ($categories as $category)
                        <option @if ($category->name === $product->category) selected @endif value="{{ $category->id }}">
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="sku">SKU:</label>
                <input type="text" value="{{ $product->sku }}" class="form-control" id="sku" name="sku"
                    placeholder="Enter product SKU">
            </div>
            @if ($errors->has('sku'))
                <div class="text-danger">{{ $errors->first('sku') }}</div>
            @endif
            <div class="form-group mt-2">
                <label for="quantity">Quantity:</label>
                <input type="number" value="{{ $product->quantity }}" class="form-control" id="quantity" name="quantity"
                    placeholder="Enter product quantity" min="1">
            </div>
            @if ($errors->has('quantity'))
                <div class="text-danger">{{ $errors->first('quantity') }}</div>
            @endif
            <div class="form-group mt-2">
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($product->images as $img)
                        <img width="82px" src="{{ url($img->url) }}" alt="image of {{ $product->name }}">
                    @endforeach
                </div>
                <label for="image">Images:</label>
                <input type="file" multiple class="form-control" id="image" name="images[]">
                @if ($errors->has('images.*'))
                    <div class="text-danger">{{ $errors->first('images.*') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
@endsection
