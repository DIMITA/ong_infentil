<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $query = Post::published()->orderByDesc('published_at');

        $category = request('category');
        if ($category && array_key_exists($category, Post::CATEGORIES)) {
            $query->byCategory($category);
        }

        $posts = $query->paginate(9);
        $categories = Post::CATEGORIES;

        $featured = Post::published()->orderByDesc('published_at')->first();

        return view('pages.blog', compact('posts', 'categories', 'featured'));
    }

    public function show(string $slug): View
    {
        $post = Post::where('slug', $slug)
            ->published()
            ->firstOrFail();

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('pages.blog-show', compact('post', 'related'));
    }
}
