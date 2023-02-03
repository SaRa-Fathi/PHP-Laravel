<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable =[
        'title' ,
        'description' ,
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function comments(): HasMany
    // {
    //     return $this->hasMany(Comment::class);
    // }


    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
