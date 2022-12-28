<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(15);
        return view('admin/category/index', compact('categories'));
    }
    public function show($id)
    {
        $category = Category::find($id);
        return view('admin/category/show', compact('category'));
    }
    public function create()
    {
        $category = new Category();
        return view('admin/category/form', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3'],
            'body' => ['required']
        ]);

        $category = Category::create($request->all());
        return redirect()->route('admin.category');

    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin/category/form-edit', compact( 'category'));
    }

    public function update(Request $request)
    {
        $category = Category::find($request['id']);
        $request->validate([
            'title' => ['required', 'min:3'],
            'slug' => ['required'],
        ]);
        $category->update($request->all());
        return redirect()->route('admin.category');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->posts()->detach();
        $category->delete();
        return redirect()->route('admin.category');
    }


}
