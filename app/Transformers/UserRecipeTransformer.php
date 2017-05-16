<?php
namespace App\Transformers;

use App\Models\UserRecipe;
use League\Fractal\TransformerAbstract;

class UserRecipeTransformer extends TransformerAbstract
{
    public function transform(UserRecipe $userRecipe)
    {
        $recipe = $userRecipe->recipe;

        return [
            'id'            => $recipe->id,
            'recipe_id'     => $recipe->recipe_id,
            'publisher'     => $recipe->publisher,
            'f2f_url'       => $recipe->f2f_url,
            'title'         => $recipe->title,
            'source_url'    => $recipe->source_url,
            'image_url'     => $recipe->image_url,
            'social_rank'   => $recipe->social_rank,
            'publisher_url' => $recipe->publisher_url,
            'ingredients'   => $recipe->ingredients,
            'user_recipe'   => $this->userRecipe($userRecipe),
        ];
    }

    public function userRecipe(UserRecipe $userRecipe)
    {
        return [
            'todo'      => $userRecipe->todo,
            'done'      => $userRecipe->done,
            'favourite' => $userRecipe->favourite,
        ];
    }
}
