<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Example extends Model
{
    use HasFactory;

    protected $casts = ['data' => 'json', 'data_not_selectable' => 'json'];

    public function exampleRelations(): HasMany
    {
        return $this->hasMany(ExampleRelation::class);
    }
}
