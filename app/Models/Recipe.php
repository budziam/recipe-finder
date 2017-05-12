<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'recipe_id',
        'publisher',
        'f2f_url',
        'title',
        'source_url',
        'image_url',
        'social_rank',
        'publisher_url',
        'ingredients',
    ];

    protected $casts = [
        'ingredients' => 'array',
    ];

    public function userRecipes()
    {
        return $this->hasMany(UserRecipe::class);
    }
}
