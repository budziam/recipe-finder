<?php
namespace App;

use App\Models\Recipe;
use Illuminate\Support\Str;

class RecipeRepository
{
    public function updateOrCreate(array $attributes) : Recipe
    {
        if (isset($attributes['f2f_url'])) {
            $attributes['f2f_url'] = Str::limit($attributes['f2f_url'], 512, '');
        }

        if (isset($attributes['source_url'])) {
            $attributes['source_url'] = Str::limit($attributes['source_url'], 512, '');
        }

        if (isset($attributes['image_url'])) {
            $attributes['image_url'] = Str::limit($attributes['image_url'], 512, '');
        }

        if (isset($attributes['publisher_url'])) {
            $attributes['publisher_url'] = Str::limit($attributes['publisher_url'], 512, '');
        }

        $recipe = Recipe::where('id', data_get($attributes, 'id', 0))
            ->orWhere('recipe_id', data_get($attributes, 'recipe_id', 0))
            ->first();

        if ($recipe !== null) {
            $recipe->update($attributes);

            return $recipe;
        }

        return Recipe::create($attributes);
    }
}