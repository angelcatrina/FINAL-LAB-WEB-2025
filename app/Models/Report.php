<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Artwork;
use App\Models\Comment;

class Report extends Model
{
    protected $fillable = [
        'reporter_id', 'reported_type', 'reported_id', 'reason', 'details', 'status'
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function artwork()
    {
        
        return $this->belongsTo(Artwork::class, 'reported_id');
    }

    public function comment()
    {
        
        return $this->belongsTo(Comment::class, 'reported_id');
    }
}
