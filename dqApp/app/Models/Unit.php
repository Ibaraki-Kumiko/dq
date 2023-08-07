<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'translation',
        'module_id'
    ];


    public function module()
    {

        return $this->belongsTo(Module::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
    public function theory()
    {
        return $this->hasOne(Theory::class);
    }
}
