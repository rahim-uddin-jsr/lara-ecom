<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        @auth
                            <a class="nav-link" href="{{ route('login') }}">
                                @if (Auth::user()->role === 'admin')
                                    Dashboard
                                @elseif (Auth::user()->role === 'user')
                                    Auth::user()->name
                                @else
                                    Login
                                @endif
                            </a>
                        @endauth
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <a href="{{ route('cart.index') }}">
                    <div style="position: relative;">
                        <img style="position: absolute; right: 20px; top: -10px" width="32" height="32"
                            src="https://img.icons8.com/metro/52/shopping-cart.png" alt="shopping-cart">
                        <strong style="position: absolute; bottom: -1px; right: 10px;">{{ $cartCount }}</strong>
                    </div>
                </a>

                <form class="d-flex" role="search">

                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <h1 class="text-center my-4">Shop</h1>
    <div class="row px-0 container mx-auto">
        {{-- <h1>{{ $cartCount }}</h1> --}}
        @foreach ($products as $product)
            <div class="px-3 col-3 mb-3">
                <div class="card">
                    <img src="{{ optional($product->images->first())->url }}" class="card-img-top" alt="Product Image">
                    <div class="card-body ">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <h5 class="card-title">{{ $product->quantity }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
                        <p class="card-text my-0 fw-bolder">Price: ${{ number_format($product->price, 2) }}</p>
                        <p class="card-text my-0">Brand: {{ $product->brand }}</p>
                        <p class="card-text mt-0">Availability:
                            {{ $product->availability ? 'In Stock' : 'Out of Stock' }}
                        </p>
                        <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary">View Details</a>
                        <a href="{{ route('add.to.cart', $product) }}" class="btn btn-success">Add to Cart</a>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $products->links() }}
    </div>
</body>

</html>
