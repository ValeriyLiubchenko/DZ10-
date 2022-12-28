<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(15);
        return view('admin/tag/index', compact('tags'));
    }
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('admin/tag/show', compact('tag'));
    }
    public function create()
    {
        $tag = new Tag();
        return view('admin/tag/form', compact( 'tag'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3'],
            'body' => ['required'],
        ]);

        $tag = Tag::create($request->all());
        $tag->post()->attach($request->input('posts'));
        return redirect()->route('admin.tag');

    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin/tag/form-edit', compact('tag'));
    }

    public function update(Request $request)
    {
        $tag = Tag::find($request['id']);
        $request->validate([
            'title' => ['required', 'min:3'],
            'body' => ['required'],
        ]);
        $tag->update($request->all());
        return redirect()->route('admin.tag');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->post()->detach();
        $tag->delete();
        return redirect()->route('admin.tag');
    }


}
