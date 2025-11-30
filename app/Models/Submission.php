<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'challenge_id', 'artwork_id', 'is_winner', 'winner_position'
    ];

    protected $casts = [
        'is_winner' => 'boolean',
    ];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }
}