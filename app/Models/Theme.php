<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'name',
        'description',
        'cover'
    ];
    public function hackaython()
    {
        return $this->belongsTo(Hackathon::class);
    }
    public function project()
    {
        return $this->hasOne(Project::class);
    }
}
