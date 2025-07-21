<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->with(['user', 'tags'])->latest()->paginate(10);

        return view('blogs.index', [
            'blogs' => $blogs,
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create', [
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'min:4', 'max:50'],
            'body' => ['required', 'min:20'],
            'tags' => ['required', 'array', 'min:1', 'max:5'],
        ]);

        $blog = Auth::user()->blogs()->create(Arr::except($attributes, 'tags'));

        foreach ($attributes['tags'] as $tag) {
            $blog->tag($tag);
        }

        return redirect()->route('blogs.show', $blog);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', [
            'blog' => $blog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', [
            'blog' => $blog,
            'tags' => Tag::all(),
            'selectedTags' => $blog->tags->pluck('slug')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $attributes = $request->validate([
            'title' => ['required', 'min:4', 'max:50'],
            'body' => ['required', 'min:20'],
            'tags' => ['required', 'array', 'min:1', 'max:5'],
            'tags.*' => ['string'], // Validasi yg di dalem arraynya. Di file bahasa ga ditambahin.
        ]);

        $blog->update(Arr::except($attributes, 'tags'));

        $tagIds = Tag::whereIn('slug', $attributes['tags'])->pluck('id');

        $blog->tags()->sync($tagIds);

        return redirect()->route('blogs.show', $blog);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

		// redirect
		return redirect()->route('home');
    }
}
