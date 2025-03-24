<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hackathon extends Model
{
    protected $fillable = [
        'title',
        'date',
        'lieu'
    ];
    public function  organisateur()
    {
        return $this->belongsTo(User::class , 'organisateur_id');
    }
    public function teams()
    {
        return $this->hasMany(Team::class);
    }
    public function rules()
    {
        return $this->belongsToMany(Rule::class);
    }
}
