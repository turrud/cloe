<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lms extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'text', 'file', 'image'];

    protected $searchableFields = ['*'];
}
