<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
