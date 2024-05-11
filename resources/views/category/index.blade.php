@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All categories</h2>
        <a class="btn btn-info" href="{{ route('category.create') }}">Create Category</a>
        <table class="table">
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
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Created Date</th>
                    @can('isAdmin')
                        <th class="text-center">Actions</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->created_at }}</td>
                        @can('isAdmin')
                            <td class="d-flex w-100 gap-2 justify-content-center">
                                <a href="{{ route('category.edit', $category) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('category.destroy', $category) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        @endcan
                    </tr>
                @endforeach
                <!-- Add more rows for additional categories -->
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection
