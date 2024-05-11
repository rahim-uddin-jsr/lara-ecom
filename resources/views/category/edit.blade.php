@extends('layouts.app')
@section('content')
    <div class="container w-25">
        <h2 class="text-center">Edit Category</h2>
        @if (session('success'))
            <div id="successMessage" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="errorMessage" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('category.update', $category) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group mt-2">
                <label for="name">Name:</label>
                <input type="text" value="{{ $category->name }}" class="form-control" id="name" name="name"
                    placeholder="Enter category name">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
@endsection
