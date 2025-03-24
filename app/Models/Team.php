<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name'
    ];
    public function hackathon()
    {
        return $this->belongsTo(Hackathon::class);
    }
    public function jury()
    {
        return $this->belongsTo(Jury::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }
    public function participants()
    {
        return $this->hasMany(User::class);
    }
}
