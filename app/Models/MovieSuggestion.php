<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieSuggestion extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'year',
        'description',
        'source_link',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}