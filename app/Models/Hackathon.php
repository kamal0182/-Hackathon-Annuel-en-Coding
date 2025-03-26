<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hackathon extends Model
{
    protected $fillable = [
        'title',
        'date',
        'lieu',
        'total_team_member'
    ];
    public function  organisateur()
    {
        return $this->belongsTo(User::class , 'organisateur_id');
    }
    public function teams()
    {
        return $this->hasMany(Team::class,'hackathon_id');
    }
    public function rules()
    {
        return $this->belongsToMany(Rule::class , "user_rules");
    }
    public function themes()
    {
        return $this->hasMany(Theme::class);
    }
}
