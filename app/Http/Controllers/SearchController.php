<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->query('q');
        $tag = Tag::where('slug', $request->query('t'))->first();
        $user = User::where('username', $request->query('u'))->first();

        $blogs = Blog::with(['user', 'tags']);

        if ($user) {
            $blogs->whereBelongsTo($user);
        }

        if ($tag) {
            $blogs->whereAttachedTo($tag);
        }

        if ($keyword) {
            $blogs->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', "%$keyword%")
                      ->orWhere('body', 'LIKE', "%$keyword%");
            });

            // Ini mirip group di CodeIgniter.
            // Biar orWhere yg paling akhir itu ga ngehapus kondisi semua where sebelumnya

            /**
             * WHERE (
             *   user
             *   AND tag
             *   AND (
             *     title OR body
             *   )
             * )
             */


        }

        $blogs = $blogs->latest()->paginate(10)->appends($request->query());

        return view('blogs.results', ['blogs' => $blogs]);
    }
}
