<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body'
    ];

    public function tag(String $slug): void
    {
        $tag = Tag::where(['slug' => $slug])->first();
        
        $this->tags()->attach($tag);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function setTitleAttribute($value) {
        $normalizedTitle = preg_replace('/\s+/', ' ', trim($value));
        $this->attributes['title'] = $normalizedTitle;
    }

    public function getExcerptAttribute()
    {
        return Str::words(strip_tags($this->body), 50, '...');
    }

    public function getFormattedCreatedAtAttribute()
    {
        // Nama bulan sesuai bahasa di locale .env
        return $this->created_at->translatedFormat('H:i, j F Y');
    }
}
