<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = [
        'name'
    ];
    public function hackathon()
    {
        return $this->belongsToMany(Hackathon::class);
    }
}
