<?php

namespace App\Observers;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogObserver
{
    /**
     * Handle the Blog "creating" event.
     */
    public function creating(Blog $blog): void
    {
        $blog->loadMissing('user');
        $username = $blog->user?->username ?? '';

        $blog->slug = $this->generateUniqueSlug($blog->title, $username);
    }

    /**
     * Handle the Blog "updating" event.
     */
    public function updating(Blog $blog): void
    {
        if ($blog->isDirty('title')) {
            $blog->loadMissing('user');
            $username = $blog->user?->username ?? '';

            $blog->slug = $this->generateUniqueSlug($blog->title, $username, $blog->id);
        }
    }

    /**
     * Handle the Blog "deleted" event.
     */
    public function deleted(Blog $blog): void
    {
        //
    }

    /**
     * Handle the Blog "restored" event.
     */
    public function restored(Blog $blog): void
    {
        //
    }

    /**
     * Handle the Blog "force deleted" event.
     */
    public function forceDeleted(Blog $blog): void
    {
        //
    }

    private function generateUniqueSlug(string $title, string $author, $ignoreId = null)
    {
        $slug = Str::slug($title) . '-' . $author;
        $originalSlug = $slug;
        $counter = 1;

        while (
            Blog::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $originalSlug . '-' .$counter++;
        }

        return $slug;

    }
}
