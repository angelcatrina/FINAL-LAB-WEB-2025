<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'curator_id', 'title', 'description', 'rules',
        'prize', 'start_date', 'end_date', 'banner_path'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function curator()
    {
        return $this->belongsTo(User::class, 'curator_id');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    // Jika ingin ambil winners nanti
    public function winners()
    {
        return $this->hasMany(Winner::class);
    }
}
