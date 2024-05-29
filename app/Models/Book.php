<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $title
 */
class Book extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'books';

    public function path(): string
    {
        return $this->exists ? $this->id . '-' . Str::slug($this->title) : '';
    }
}
