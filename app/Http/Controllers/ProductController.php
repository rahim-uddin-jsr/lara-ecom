<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('images', 'category')->paginate(10);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $product_Id = Product::insertGetId([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'price' => $request->price,
                'brand' => $request->brand,
                'sku' => $request->sku,
                'category_id' => $request->category_id,
                'quantity' => $request->quantity,
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                    $extension = $image->getClientOriginalExtension();
                    $filename = uniqid() . Date('His') . '.' . $extension;
                    $destination = 'assets/uploads/products';
                    $image->move($destination, $filename);

                    ProductImage::create([
                        'url' => $destination . '/' . $filename,
                        'product_id' => $product_Id,
                    ]);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        session()->flash('success', 'Product created successfully!');
        return back();
    }
    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('images', 'category')->firstOrFail();
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $images = ProductImage::where('product_id', $product->id)->get();
        ProductImage::where('product_id', $product->id)->delete();
        foreach ($images as $key => $image) {
            if (File::exists($image->url)) {
                File::delete($image->url);
            }
        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = uniqid() . Date('His') . '.' . $extension;
                $destination = 'assets/uploads/products';
                $image->move($destination, $filename);

                ProductImage::create([
                    'url' => $destination . '/' . $filename,
                    'product_id' => $product->id,
                ]);
            }
        }
        $isUpdated = $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'brand' => $request->brand,
            'sku' => $request->sku,
            'category' => $request->category,
            'quantity' => $request->quantity,
        ]);
        if ($isUpdated) {
            session()->flash('success', 'Product updated successfully!');
        } else {
            session()->flash('error', 'Failed to update product.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $images = ProductImage::where('product_id', $product->id)->get();
        ProductImage::where('product_id', $product->id)->delete();

        foreach ($images as $key => $image) {
            if (File::exists($image->url)) {
                File::delete($image->url);
            }
        }
        if ($product->delete()) {

            session()->flash('success', 'Product deleted successfully!');
        } else {
            session()->flash('error', 'Failed to delete product.');
        }

        return back();
    }
}
