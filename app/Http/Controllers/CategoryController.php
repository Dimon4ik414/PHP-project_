<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('Category.index', compact('categories'));
    }

    public function create()
    {
        return view('Category.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'color' => 'required',
            'sort_order' => 'required'
        ]);

        Category::create($data);
        return redirect()->route('category.index');
    }

    public function edit(Category $category)
    {
        return view('Category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:Category,slug,' . $category->id,
            'description' => 'nullable',
            'color' => 'nullable',
            'sort_order' => 'nullable|integer'
        ]);

        $category->update($data);
        return redirect()->route('Category.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('Category.index');
    }
}
