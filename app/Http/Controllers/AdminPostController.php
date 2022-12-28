<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(15);
        return view('admin/post/index', compact('posts'));
    }

    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $users = User::all();
        $tags = Tag::all();
        return view('admin/post/form', compact('categories', 'tags', 'post', 'users'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3'],
            'body' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'user_id' => ['required', 'exists:users,id'],
            'tags' => ['required', 'exists:tags,id'],
        ]);

        $post = Post::create($request->all());
        $post->tags()->attach($request->input('tags'));
        return redirect()->route('admin.post');

    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $users = User::all();
        $tags = Tag::all();
        return view('admin/post/form-edit', compact('post', 'categories', 'tags','users'));
    }

    public function update(Request $request)
    {
        $post = Post::find($request['id']);
        $request->validate([
            'title' => ['required', 'min:3'],
            'body' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'user_id' => ['required', 'exists:users,id'],
            'tags' => ['required', 'exists:tags,id'],
        ]);
        $post->update($request->all());
        $post->tags()->sync($request->input('tags'));
        return redirect()->route('admin.post');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.post');
    }


}
