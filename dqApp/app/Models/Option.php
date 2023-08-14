<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'options',
        'translation',
        'exercise_id',

    ];
    public function unit()
    {
        return $this->belongsTo(Exercise::class)->select([ 'options']);
    }
}
