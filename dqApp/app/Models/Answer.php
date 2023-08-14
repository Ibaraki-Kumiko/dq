<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'exercise_id', 'data'
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class)->select([ 'answers']);
    }
}
