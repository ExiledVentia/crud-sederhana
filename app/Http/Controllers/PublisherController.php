<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PublisherController extends Controller
{

    public function index(): View
    {
        $publisher = Publisher::latest()->paginate(10);
        return view('publisher.index', compact('publisher'));
    }

    public function create(): View
    {
        return view('publisher.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'publisher_name' => 'required|min:5'
        ]);

        Publisher::create([
            'publisher_name' => $request->publisher_name
        ]);

        return redirect()->route('publisher.index')->with(['success' => 'Data Saved!']);
    }

    public function show(Publisher $publisher): View
    {
        $books = $publisher->books()->paginate(10);
        return view('publisher.show', compact('publisher', 'books'));
    }


    public function edit(Publisher $publisher): View
    {
        return view('publisher.edit', compact('publisher'));
    }

    public function update(Request $request, Publisher $publisher): RedirectResponse
    {
        $validated = $request->validate([
            'publisher_name' => 'required|string|min:3|unique:publishers,publisher_name,' . $publisher->id,
        ]);
        
        $publisher->update($validated);
        
        return redirect()->route('publisher.index')->with(['success' => 'Publisher Updated!']);
    }

    public function destroy(Publisher $publisher): RedirectResponse
    {
        $publisher->delete();

        return redirect()->route('publisher.index')->with(['success' => 'Publisher Successfully Deleted!']);
    }
}
