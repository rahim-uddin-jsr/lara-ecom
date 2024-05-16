<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use http\Env\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(5);
        return view('book.index', compact('books'));
    }

    public function pagination()
    {
        $books = Book::paginate(5);
        return view('book.pagination-table', compact('books'))->render();
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        //
    }

    public function search(\Illuminate\Http\Request $request)
    {

        $key = $request->key; // Retrieve the search key from the request
//        return response()->json($key);
        // Search for books using the search key
        $books = Book::where('title', 'like', '%' . $key . '%')
            ->orWhere('price', 'like', '%' . $key . '%')
            ->orWhere('pages', 'like', '%' . $key . '%')
            ->paginate();

        if ($books->count() > 0) {
            // If books are found, return the view with the paginated books data
            return view('book.pagination-table', compact('books'))->render();
        } else {
            // If no books are found, return a JSON response indicating that nothing was found
            return response()->json('Nothing Found');
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {

        try {
            $isCreated = Book::create([
                'title' => $request->title,
                'description' => $request->description,
                'pages' => $request->pages,
                'price' => $request->price,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json($isCreated, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, $id)
    {
        try {
            Book::where('id', $id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'pages' => $request->pages,
                'price' => $request->price
            ]);

            return response()->json('{success:true}', 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $isDeleted = Book::destroy($id);
            return response()->json(['isDeleted' => $isDeleted], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
