<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BookController extends Controller
{

    public function index(): View
    {
        $books = Book::with('category')->latest()->paginate(10);
        return view('books.index', compact('books'));
    }


    public function create(): View
    {
        $category = Category::all();
        $publisher = Publisher::all();
        return view('books.create', compact('category', 'publisher'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cover' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'author' => 'required|min:5',
            'publisher_id' => 'required|exists:publishers,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $cover = $request->file('cover');
        $cover->storeAs('books', $cover->hashName());

        Book::create([
            'cover' => $cover->hashName(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'author' => $validated['author'],
            'publisher_id' => $validated['publisher_id'],
            'category_id' => $validated['category_id'],
        ]);

        return redirect()->route('books.index')->with(['success' => 'Data Saved!']);
    }

    public function show(Book $book): View
    {
        return view('books.show', compact('book'));
    }


    public function edit(Book $book): View
    {
        $category = Category::all();
        $publisher = Publisher::all();
        return view('books.edit', compact('book', 'category', 'publisher'));
    }


    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'cover' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'author' => 'required|min:5',
            'publisher_id' => 'required|exists:publishers,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $updateData = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'author' => $validated['author'],
            'publisher_id' => $validated['publisher_id'],
            'category_id' => $validated['category_id'],
        ];

        if ($request->hasFile('cover')) {
            Storage::delete('/books' . $book->cover);

            $cover = $request->file('cover');
            $coverPath = $cover->store('/books');
            $updateData['cover'] = basename($coverPath);
        }
        
        $book->update($updateData);

        return redirect()->route('books.index')->with(['success' => 'Data Updated!']);
    }

    public function destroy(Book $book): RedirectResponse
    {
        Storage::delete('public/books/' . $book->cover);
        $book->delete();
        return redirect()->route('books.index')->with(['success' => 'Data Successfully Deleted!']);
    }
}