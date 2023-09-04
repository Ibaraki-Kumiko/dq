<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Module extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'translation',
        'description'

    ];

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($module) {
            $module->slug = Str::slug($module->name);
        });
    }
}
