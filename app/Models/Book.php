<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;



    protected $fillable = [
        'cover',
        'title',
        'description',
        'author',
        'publisher_id',
        'category_id',    
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function publisher(): BelongsTo {
        return $this->belongsTo(Publisher::class);
    }
}
