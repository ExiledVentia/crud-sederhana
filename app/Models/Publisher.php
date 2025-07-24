<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publisher extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'publishers';
    protected $fillable = [
        'publisher_name'
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function (Publisher $publisher) {
            $publisher->books()->delete();
        });

        static::restoring(function (Publisher $publisher) {
            $publisher->books()->onlyTrashed()->restore();
        });
    }
}
