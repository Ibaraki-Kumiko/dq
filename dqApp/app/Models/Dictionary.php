<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Dictionary extends Model
{
    use HasFactory, Searchable;
    protected $fillable = ['term', 'translation', 'type', 'definition', 'slug'];

    public function searchableAs()
    {
        return "terms";
    }

    public function examples()
    {
       //return $this->hasMany(Example::class);
    }
}
