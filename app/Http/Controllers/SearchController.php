<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->query('q');
        $tag = Tag::where('slug', $request->query('t'))->first();
        $user = User::where('username', $request->query('u'))->first();

        if (($request->query('u') !== null && $user === null) ||
            ($request->query('t') !== null && $tag === null)) {
            // Kalo user atau tag ga ada di database
            $emptyPaginator = new LengthAwarePaginator([], 0, 10);

            return view('blogs.results', ['blogs' => $emptyPaginator]);
        }

        if ($user) {
            $request->session()->flash('authorName', $user->name);
            $request->session()->flash('profilePic', $user->picture);
        }

        if ($tag) {
            $request->session()->flash('tagName', $tag->name);
        }

        $blogs = Blog::with(['user', 'tags'])
            ->when($user, fn($q) => $q->whereBelongsTo($user))
            ->when($tag, fn($q) => $q->whereAttachedTo($tag))
            ->when($keyword, fn($q) => $q->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', "%$keyword%")
                      ->orWhere('body', 'LIKE', "%$keyword%");
            }))
            ->latest()
            ->paginate(10)
            ->appends($request->query());

        return view('blogs.results', ['blogs' => $blogs]);
    }
}
