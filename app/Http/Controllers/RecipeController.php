<?php
namespace App\Http\Controllers;

use App\Food2ForkClient;
use App\Http\Requests\SearchRequest;
use App\Models\Recipe;
use App\Models\UserRecipe;
use App\RecipeFinder;
use App\Transformers\UserRecipeTransformer;
use App\UserRecipeRepository;

class RecipeController extends Controller
{
    public function show(Recipe $recipe, UserRecipeRepository $repository)
    {
        $userRecipe = $repository->getUserRecipe($this->user(), $recipe);

        return fractal()
            ->item($userRecipe, new UserRecipeTransformer())
            ->toArray();
    }

    public function search(SearchRequest $request, RecipeFinder $recipeFinder)
    {
        $ingredients = $request->input('ingredients');
        $page = $request->input('page', 1);
        $sort = $request->input('sort', Food2ForkClient::SORT_RATING);

        $userRecipes = $recipeFinder->search($ingredients, $page, $sort)
            ->map(function (Recipe $recipe) {
                $userRecipe = $this->user()
                    ->userRecipes
                    ->first(function (UserRecipe $userRecipe) use ($recipe) {
                        return $userRecipe->recipe_id === $recipe->id;
                    });

                if ($userRecipe === null) {
                    /** @var UserRecipe $userRecipe */
                    $userRecipe = UserRecipe::make();
                    $userRecipe->setAttribute('recipe', $recipe);
                }

                return $userRecipe;
            });

        return fractal()
            ->collection($userRecipes, new UserRecipeTransformer())
            ->toArray();
    }

    public function favourites()
    {
        $userRecipes = $this->user()
            ->userRecipes()
            ->with('recipe')
            ->where('favourite', true)
            ->get();

        return fractal()
            ->collection($userRecipes, new UserRecipeTransformer())
            ->toArray();
    }

    public function done()
    {
        $userRecipes = $this->user()
            ->userRecipes()
            ->with('recipe')
            ->where('done', true)
            ->get();

        return fractal()
            ->collection($userRecipes, new UserRecipeTransformer())
            ->toArray();
    }

    public function todo()
    {
        $userRecipes = $this->user()
            ->userRecipes()
            ->with('recipe')
            ->where('todo', true)
            ->get();

        return fractal()
            ->collection($userRecipes, new UserRecipeTransformer())
            ->toArray();
    }

    public function markFavourite(Recipe $recipe, UserRecipeRepository $repository)
    {
        $repository->markAsFavourite($this->user(), $recipe);

        return $this->success();
    }

    public function markTodo(Recipe $recipe, UserRecipeRepository $repository)
    {
        $repository->markAsTodo($this->user(), $recipe);

        return $this->success();
    }

    public function markDone(Recipe $recipe, UserRecipeRepository $repository)
    {
        $repository->markAsDone($this->user(), $recipe);

        return $this->success();
    }

    public function unmarkFavourite(Recipe $recipe, UserRecipeRepository $repository)
    {
        $repository->unmarkAsFavourite($this->user(), $recipe);

        return $this->success();
    }

    public function unmarkTodo(Recipe $recipe, UserRecipeRepository $repository)
    {
        $repository->unmarkAsTodo($this->user(), $recipe);

        return $this->success();
    }

    public function unmarkDone(Recipe $recipe, UserRecipeRepository $repository)
    {
        $repository->unmarkAsDone($this->user(), $recipe);

        return $this->success();
    }
}