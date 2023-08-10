<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'translation',
        'answer',
        'exercise_id'
    ];
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
