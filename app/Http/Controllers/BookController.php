<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $books = Book::latest()->paginate(10);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'cover' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'author' => 'required|min:5',
            'publisher' => 'required|min:5',
            'category' => 'required|min:5'
        ]);

        $cover = $request->file('cover');
        $cover->storeAs('books', $cover->hashName());

        Book::create([
            'cover' => $cover->hashName(),
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'category' => $request->category
        ]);

        return redirect()->route('books.index')->with(['success' => 'Data Saved!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $books = Book::findOrFail($id);
        return view('books.show', compact('books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $books = Book::findOrFail($id);
        return view('books.edit', compact('books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'cover' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'author' => 'required|min:5',
            'publisher' => 'required|min:5',
            'category' => 'required|min:5'
        ]);

        $books = Book::findOrFail($id);

        if ($request->hasFile('cover')) {
            Storage::delete('books/'.$books->cover);
            $cover = $request->file('cover');
            $cover->storeAs('books', $cover->hashName());

            $books->update([
            'cover' => $cover->hashName(),
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'category' => $request->category
            ]);

        } else {
            $books->update([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'category' => $request->category
            ]);
        }
        return redirect()->route('books.index')->with(['success' => 'Data Saved!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $books = Book::findOrFail($id);
        Storage::delete('books/'. $books->cover);
        $books->delete();
        return redirect()->route('books.index')->with(['success' => 'Data Successfully Deleted!']);
    }
}
