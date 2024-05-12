@extends('layouts.app')
@section('content')
    <div class="w-25 mx-auto">
        <h2 class="text-center">Add Product</h2>
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-2">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name">
                @if ($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group mt-2">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Enter product price">
                @if ($errors->has('price'))
                    <div class="text-danger">{{ $errors->first('price') }}</div>
                @endif
            </div>
            <div class="form-group mt-2">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter product brand">
                @if ($errors->has('brand'))
                    <div class="text-danger">{{ $errors->first('brand') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="5"
                    placeholder="Enter product description"></textarea>
            </div>
            <div class="form-group mt-2">
                <label for="brand">Category:</label>
                <select class="form-select form-select-sm" name="category_id" aria-label=".form-select-sm example">
                    <option disabled>Open this select category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="sku">SKU:</label>
                <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter product SKU">
            </div>
            @if ($errors->has('sku'))
                <div class="text-danger">{{ $errors->first('sku') }}</div>
            @endif
            <div class="form-group mt-2">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                    placeholder="Enter product quantity" min="1">
            </div>
            @if ($errors->has('quantity'))
                <div class="text-danger">{{ $errors->first('quantity') }}</div>
            @endif
            <div class="form-group mt-2">
                <label for="image">Images:</label>
                <input type="file" multiple class="form-control" id="image" name="images[]">
            </div>
            @if ($errors->has('image.*'))
                <div class="text-danger">{{ $errors->first('image.*') }}</div>
            @endif
            <button type="submit" class="btn btn-primary mt-2">Create</button>
        </form>
    </div>
@endsection
