<?php

namespace App\Http\Controllers;

use App\Exports\BooksExport;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Elibyy\TCPDF\Facades\TCPDF;
use Carbon\Carbon; // Import Carbon

class BookController extends Controller
{
    public function index(Request $request): View
    {
        $query = Book::query()->with('category', 'publisher');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('author', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('publisher_id')) {
            $query->where('publisher_id', $request->publisher_id);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        $books = $query->latest()->paginate(10);

        $categories = Category::all();
        $publishers = Publisher::all();

        return view('books.index', compact('books', 'categories', 'publishers'));
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
        $cover->storeAs('public/books', $cover->hashName());

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
            Storage::delete('public/books/' . $book->cover);

            $cover = $request->file('cover');
            $cover->storeAs('public/books', $cover->hashName());
            $updateData['cover'] = $cover->hashName();
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

    public function exportPDF(Request $request)
    {
        $query = Book::query()->with('category', 'publisher');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('author', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('publisher_id')) {
            $query->where('publisher_id', $request->publisher_id);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        $books = $query->latest()->get();

        $data = [
            'title' => 'Filtered Book Report',
            'date' => date('m/d/Y'),
            'books' => $books
        ];
        
        $html = view('books.books_pdf', $data)->render();

        TCPDF::SetTitle('Book Report');
        TCPDF::AddPage();
        TCPDF::writeHTML($html, true, false, true, false, '');

        TCPDF::Output('books_report.pdf', 'D');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new BooksExport($request), 'books.xlsx');
    }
}