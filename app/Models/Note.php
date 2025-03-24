<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'comment',
        'note'
    ];
    public function jurymember()
    {
        return $this->belongsTo(JuryMemmber::class , 'member_id');
    }
    public function  team()
    {
        return $this->belongsTo(Team::class);
    }
}
