<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::content();
        $cartCount = Cart::count();
        return view('cart.index', compact('cartItems', 'cartCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product)
    {
        $product->load('images');

        Cart::add($product->id, $product->name, 1, $product->price, ['image' => $product->images[0]->url]);
        $cartCount = Cart::count();
        // dd($cartCount);
        return back()->with('cartCount', $cartCount);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    public function incrementQuantity(Request $request, $id)
    {
        $item = Cart::get($id);
        if ($item) {
            Cart::update($id, $request->quantity);
        }

        return back();
    }

    public function decrementQuantity($rowId)
    {
        $item = Cart::get($rowId);
        if ($item && $item->qty > 1) {
            Cart::update($rowId, $item->qty - 1);
        }

        return back();
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }
    public function remove(string $id)
    {
        Cart::remove($id);
        return back();
    }
    public function clearCart()
    {
        Cart::destroy();
        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
