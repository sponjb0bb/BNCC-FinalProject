<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use hasFactory;

    protected $fillable = ['category'];

    public function item(): HasMany
    {
        $this->hasMany(Item::class, 'category_id');
    }
}
