<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $category = Category::latest()->paginate(10);
        return view('category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_name' => 'required|min:5'
        ]);

        Category::create([
            'category_name' => $request->category_name
        ]);

        return redirect()->route('category.index')->with(['success' => 'Data Saved!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        $books = $category->books()->paginate(10);
        return view('category.show', compact('category', 'books'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse 
    {
        $validated = $request->validate([
            'category_name' => 'required|string|min:3|unique:categories,category_name,' . $category->id,
        ]);
        
        $category->update($validated);
        
        return redirect()->route('category.index')->with(['success' => 'Category Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse 
    {
        $category->delete();

        return redirect()->route('category.index')->with(['success' => 'Category Successfully Deleted!']);
    }
}
