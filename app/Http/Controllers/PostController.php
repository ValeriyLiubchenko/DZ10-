<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts/posts', compact('posts'));
    }

    public function IndexByUser($user_id)
    {
        $posts = Post::whereHas('user', function ($user) use ($user_id) {
            $user->where('user_id', '=', $user_id);
        })->get();
        return view('posts/posts-user', compact('posts'));
    }

    public function IndexByCategory($category_id)
    {
        $posts = Post::whereHas('category', function ($category) use ($category_id) {
            $category->where('category_id', '=', $category_id);
        })->get();
        return view('posts/posts-category', compact('posts'));
    }

    public function IndexByTag($tag_id)
    {
        $posts = Post::whereHas('tags', function ($tag) use ($tag_id) {
            $tag->where('tag_id', '=', $tag_id);
        })->get();
        return view('posts/posts-tags', compact('posts'));
    }

    public function IndexByUserAndCategory($user_id, $category_id)
    {
        $posts = Post::whereHas('user', function ($user) use ($user_id) {
            $user->where('user_id', '=', $user_id);
        })->where('category_id', '=', $category_id)->get();
        return view('posts/posts-user-category', compact('posts'));
    }

    public function IndexByUserAndCategoryAndTag($user_id, $category_id, $tag_id)
    {
        $posts = Post::whereHas('user', function ($user) use ($user_id) {
            $user->where('user_id', '=', $user_id);
        })->where('category_id', '=', $category_id)->whereHas('tags', function ($tag) use ($tag_id) {
            $tag->where('tag_id', '=', $tag_id);
        })->get();
        return view('posts/posts-user-category-tag', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts/show', compact('post'));
    }
}
