<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class);
    }

    public function setNameAttribute($value) {
        $normalizedName = preg_replace('/\s+/', ' ', trim($value));
        $this->attributes['name'] = Str::title($normalizedName);
        $this->attributes['slug'] = Str::slug($normalizedName);
    }
}
