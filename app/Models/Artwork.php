<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'description', 'file_path', 'tags'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
public function isFavoritedBy($user)
{
    return $this->favorites()->where('user_id', $user->id)->exists();
}
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function isLikedBy($user)
{
    return $this->likes()->where('user_id', $user->id)->exists();
}

}