<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category; // 1. IMPORT the Category model
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // 2. EAGER LOAD the category relationship to prevent N+1 query issues
        $books = Book::with('category')->latest()->paginate(10);
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // 3. FETCH ALL CATEGORIES to pass to the form
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // 4. VALIDATE category_id, not category
        $validated = $request->validate([
            'cover' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'author' => 'required|min:5',
            'publisher' => 'required|min:5',
            'category_id' => 'required|exists:categories,id',
        ]);

        $cover = $request->file('cover');
        $cover->storeAs('books', $cover->hashName());

        // 5. SAVE category_id using the validated data
        Book::create([
            'cover' => $cover->hashName(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'author' => $validated['author'],
            'publisher' => $validated['publisher'],
            'category_id' => $validated['category_id'],
        ]);

        return redirect()->route('books.index')->with(['success' => 'Data Saved!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): View // 6. USE ROUTE-MODEL BINDING
    {
        // The book is already fetched automatically
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View // USE ROUTE-MODEL BINDING
    {
        // Also fetch categories for the dropdown in the edit form
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): RedirectResponse // USE ROUTE-MODEL BINDING
    {
        $validated = $request->validate([
            'cover' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048', // Nullable on update
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'author' => 'required|min:5',
            'publisher' => 'required|min:5',
            'category_id' => 'required|exists:categories,id',
        ]);

        $updateData = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'author' => $validated['author'],
            'publisher' => $validated['publisher'],
            'category_id' => $validated['category_id'], // SAVE the category_id
        ];

        if ($request->hasFile('cover')) {
            // Delete the old cover
            Storage::delete('public/books/' . $book->cover);

            $cover = $request->file('cover');
            $coverPath = $cover->store('public/books');
            $updateData['cover'] = basename($coverPath);
        }
        
        $book->update($updateData);

        return redirect()->route('books.index')->with(['success' => 'Data Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse // USE ROUTE-MODEL BINDING
    {
        Storage::delete('public/books/' . $book->cover);
        $book->delete();
        return redirect()->route('books.index')->with(['success' => 'Data Successfully Deleted!']);
    }
}