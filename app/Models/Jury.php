<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jury extends Model
{
    public function teams()
    {
        return $this->hasMany(Team::class);
    }
    public function memberjury()
    {
        return $this->hasMany(JuryMemmber::class);
    }
    public function hacakthon()
    {
        return $this->belongsTo(Hackathon::class);
    }
}
