<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Author extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'authors';

    protected function dob(): Attribute
    {
        return Attribute::make(
          get: static fn ($value) => Carbon::parse($value),
          set: static fn ($value) => Carbon::parse($value)
        );
    }
}
