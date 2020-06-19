<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name', 'description', 'state', 'next_screen_title',
    ];

    public function standards()
    {
        return $this->belongsToMany(Standard::class);
    }
}
