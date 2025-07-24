<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_name'
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    protected static function boot() {
        parent::boot();

        static::deleted(function (Category $category){
            $category->books()->delete();
        }); 

        static::restoring(function (Category $category){
            $category->books()->onlyTrashed()->restore();
        }); 
    }
}
