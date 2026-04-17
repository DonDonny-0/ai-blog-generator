<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class Post extends Model
{
    protected $fillable = ['title', 'content'];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
