<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
