<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model
{
    use HasFactory , SoftDeletes , Sluggable;


    protected $fillable =[
        'title' ,
        'description' ,
        'image',
        'user_id',
        'slug',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

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
