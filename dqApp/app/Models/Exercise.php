<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'translation',
        'unit_id',
        'type'

    ];
    public function unit()
    {

        return $this->belongsTo(Unit::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function options()
    {
        return $this->hasMany(Option::class);
    }
    public function answers()
    {
        return $this->hasOne(Answer::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($exercise) {
            $exercise->questions()->delete();
            $exercise->options()->delete();
            $exercise->answers()->delete();
        });
    }
}
