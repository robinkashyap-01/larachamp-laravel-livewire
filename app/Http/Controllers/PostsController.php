<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function show($name)
    {
        $post = Post::query()->with('user')->where('url', $name)->first();
        return view('frontend.single-post', compact("post"));
    }

    public function index(Request $request, $category = 'all')
    {
        $posts = Post::query()
            ->where('status', 'published')
            ->orderBy('id', 'desc');

        if ($category !== 'all') {
            $posts->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        }

        $categories = (new Category())->getAll();
        $tags = (new Tag())->getAll();

        if ($request->ajax()) {
            $posts = $posts->where('title', 'like', "%$request->search%")->paginate(10);
            return view('frontend.content', compact('posts', 'categories', 'tags'));
        }

        $posts = $posts->paginate(10);
        return view('welcome', compact('posts', 'categories', 'tags'));
    }
}
