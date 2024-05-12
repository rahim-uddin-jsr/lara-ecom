@extends('layouts.app')
@section('content')
    <section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Cart</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container">
            @if (Cart::Count() > 0)
                <div class="row">
                    <div class="col-md-12 text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr class="align-middle">
                                        <td>
                                            <a href="{{ route('product.show', $item->id) }}">
                                                <img width="150" src="{{ asset($item->options->image) }}"
                                                    class="blur-up lazyloaded" alt="{{ $item->name }}">
                                            </a>
                                        </td>
                                        <td class="">
                                            <a class="text-start mb-3 card-title nav-link " href="">
                                                <h3>{{ $item->name }}</h3>
                                            </a>
                                            <div class="mobile-cart-content row">
                                                <div class="col">
                                                    <h2 class="td-color">
                                                        <a href="javascript:void(0)">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h2>${{ $item->price }}</h2>
                                        </td>
                                        <td>
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <form action="{{ route('cart.quantity.update', $item->rowId) }}"
                                                        method="post" class="update-form">
                                                        @csrf
                                                        @method('PUT')
                                                        <input min="1" type="number" name="quantity"
                                                            data-rowid="{{ $item->rowId }}"
                                                            class="form-control input-number" value="{{ $item->qty }}">
                                                    </form>
                                                </div>
                                            </div>
                                            <script script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                            <script>
                                                $(document).ready(function() {
                                                    $('.input-number').on('change', function() {

                                                        $(this).closest('.update-form').submit();
                                                    });
                                                });
                                            </script>
                                        </td>
                                        <td>
                                            <h2 class="td-color">${{ $item->subtotal() }}</h2>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" href="{{ route('cart.remove', $item->rowId) }}">
                                                Remove
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 mt-md-5 mt-4">
                        <div class="row">
                            <div class="col-sm-7 col-5 order-1">
                                <div class="left-side-button text-end d-flex d-block justify-content-end">
                                    <a class="btn btn-danger" href="{{ route('cart.clear') }}"
                                        class="text-decoration-underline theme-color d-block text-capitalize">clear
                                        all items</a>
                                </div>
                            </div>
                            <div class="col-sm-5 col-7">
                                <div class="left-side-button float-start">
                                    <a href="{{ route('app') }}" class="btn btn-solid-default btn fw-bold mb-0 ms-0">
                                        <i class="fas fa-arrow-left"></i> Continue Shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-checkout-section">
                        <div class="row g-4">
                            <div class="col-lg-4 col-sm-6">
                                <div class="promo-section">
                                    <form class="row g-3">
                                        <div class="col-7">
                                            <input type="text" class="form-control" id="number"
                                                placeholder="Coupon Code">
                                        </div>
                                        <div class="col-5 ">
                                            <button class="btn btn btn-success">Apply Coupon</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 ">
                                <div class="checkout-button">
                                    <a href="{{ route('checkout') }}" class="btn btn-solid-default btn fw-bold">
                                        Check Out <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="cart-box">
                                    <div class="cart-box-details">
                                        <div class="total-details">
                                            <div class="top-details">
                                                <h3>Cart Totals</h3>
                                                <h6>Sub Total <span>${{ Cart::subtotal() }}</span></h6>
                                                <h6>Tax <span>${{ Cart::tax() }}</span></h6>
                                                <h6>Total <span>${{ Cart::total() }}</span></h6>
                                            </div>
                                            <div class="bottom-details">
                                                <a class="btn btn-success" href="{{ route('checkout') }}">Process
                                                    Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Your cart is empty !</h2>
                        <h5 class="mt-3">Add Items to it now.</h5>
                        <a href="{{ route('app') }}" class="btn btn-warning mt-5">Shop Now</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
