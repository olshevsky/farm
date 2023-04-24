<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Animal;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'website'
    ];

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
