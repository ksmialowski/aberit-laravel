<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'founded_year',
        'description',
    ];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
