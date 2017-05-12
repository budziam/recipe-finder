<?php
namespace App;

use App\Models\Recipe;
use App\Models\User;
use App\Models\UserRecipe;

class UserRecipeRepository
{
    /** @var RecipeFinder */
    protected $recipeFinder;

    public function __construct(RecipeFinder $recipeFinder)
    {
        $this->recipeFinder = $recipeFinder;
    }

    public function markAsTodo(User $user, Recipe $recipe)
    {
        $this->getUserRecipe($user, $recipe)
            ->update([
                'todo' => true,
                'done' => false,
            ]);
    }

    public function markAsDone(User $user, Recipe $recipe)
    {
        $this->getUserRecipe($user, $recipe)
            ->update([
                'todo' => false,
                'done' => true,
            ]);
    }

    public function markAsFavourite(User $user, Recipe $recipe)
    {
        $this->getUserRecipe($user, $recipe)
            ->update([
                'favourite' => true,
            ]);
    }

    public function unmarkAsFavourite(User $user, Recipe $recipe)
    {
        $this->getUserRecipe($user, $recipe)
            ->update([
                'favourite' => false,
            ]);
    }

    public function unmarkAsDone(User $user, Recipe $recipe)
    {
        $this->getUserRecipe($user, $recipe)
            ->update([
                'done' => false,
            ]);
    }

    public function unmarkAsTodo(User $user, Recipe $recipe)
    {
        $this->getUserRecipe($user, $recipe)
            ->update([
                'todo' => false,
            ]);
    }

    protected function getUserRecipe(User $user, Recipe $recipe) : UserRecipe
    {
        if (!$recipe->isComplete()) {
            $this->recipeFinder->get($recipe->recipe_id);
        }

        return UserRecipe::firstOrCreate([
            'user_id'   => $user->id,
            'recipe_id' => $recipe->id,
        ]);
    }
}