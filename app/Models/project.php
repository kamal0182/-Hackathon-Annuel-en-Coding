<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    protected $fillable = [
        'link_github',
        'name'
    ];
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
