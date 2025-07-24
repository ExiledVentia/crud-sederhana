<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(): View
    {
        $category = Category::latest()->paginate(10);
        return view('category.index', compact('category'));
    }


    public function create(): View
    {
        return view('category.create');
    }


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


    public function show(Category $category): View
    {
        $books = $category->books()->paginate(10);
        return view('category.show', compact('category', 'books'));
    }


    public function edit(Category $category): View
    {
        return view('category.edit', compact('category'));
    }


    public function update(Request $request, Category $category): RedirectResponse 
    {
        $validated = $request->validate([
            'category_name' => 'required|string|min:3|unique:categories,category_name,' . $category->id,
        ]);
        
        $category->update($validated);
        
        return redirect()->route('category.index')->with(['success' => 'Category Updated!']);
    }


    public function destroy(Category $category): RedirectResponse 
    {
        $category->delete();

        return redirect()->route('category.index')->with(['success' => 'Category Successfully Deleted!']);
    }

    public function trashed(): View
    {
        $category = Category::onlyTrashed()->paginate(10);
        return view('category.trashed', compact('category'));
    }

    public function restore($id): RedirectResponse
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('category.index')->with(['success' => 'category Restored Successfully!']);
    }

    public function forceDelete($id): RedirectResponse
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        return redirect()->route('category.trashed')->with(['success' => 'category Permanently Deleted!']);
    }
}
