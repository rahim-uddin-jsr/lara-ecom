<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Category::class);
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // dd($request->all());
        $this->authorize('create', Category::class);
        $created = Category::create([
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
        ]);

        if ($created) {
            session()->flash('success', 'Category created successfully!');
        } else {
            session()->flash('error', 'Failed to create category.');
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $isUpdated = $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        if ($isUpdated) {
            session()->flash('success', 'Category deleted successfully!');
        } else {
            session()->flash('error', 'Failed to delete category.');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            session()->flash('success', 'Category deleted successfully!');
        } else {
            session()->flash('error', 'Failed to delete category.');
        }

        return back();
    }
}
