@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>All Products</h2>
        <a class="btn btn-info" href="{{ route('product.create') }}">Create Product</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Catrgory</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Brand</th>
                    <th>Sku</th>
                    <th>Created Date</th>
                    <th class="text-center">Actions</th>
                    {{-- @can('isAdmin')
                        <th class="text-center">Actions</th>
                    @endcan --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                    <tr class="align-middle">
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            @if (isset($product->images[0]))
                                <img width="140" src="{{ $product->images[0]->url }}" alt="">
                            @endif
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->brand }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->created_at }}</td>

                        <td class="">
                            <div class="d-flex w-100 gap-2 justify-content-center">
                                <a href="{{ route('product.edit', $product) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('product.destroy', $product) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="{{ route('product.show', $product->slug) }}"
                                    class="btn btn-primary btn-sm">View</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <!-- Add more rows for additional categories -->
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
