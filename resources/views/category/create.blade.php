@extends('layouts.app')
@section('content')
    <div class="container w-25">
        <h2 class="text-center">Add Category</h2>
        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="form-group mt-2">
                <label for="category_name">Category Name:</label>
                <input type="text" class="form-control" id="category_name" name="category_name"
                    placeholder="Enter category name">
                @error('category_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2">Add</button>
        </form>
    </div>
@endsection
