<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JuryMemmber extends Model
{
    protected $table = 'memberjuries';
    protected $fillable = [
        'name',
        'code',
    ];
    public function jury()
    {
        return $this->belongsTo(Jury::class);
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    
}
