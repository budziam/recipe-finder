<?php
namespace App\Http\Controllers;

use App\Food2ForkClient;
use App\Http\Requests\SearchRequest;
use App\Models\Recipe;
use App\RecipeFinder;
use App\UserRecipeRepository;

class RecipeController extends Controller
{
    public function search(SearchRequest $request, RecipeFinder $recipeFinder)
    {
        $ingredients = $request->input('ingredients');
        $page = $request->input('page', 1);
        $sort = $request->input('sort', Food2ForkClient::SORT_RATING);

        return $recipeFinder->search($ingredients, $page, $sort);
    }

    public function favourites()
    {
        return $this->user()
            ->userRecipes()
            ->where('favourite', true)
            ->with('recipe')
            ->get()
            ->pluck('recipe');
    }

    public function done()
    {
        return $this->user()
            ->userRecipes()
            ->where('done', true)
            ->with('recipe')
            ->get()
            ->pluck('recipe');
    }

    public function todo()
    {
        return $this->user()
            ->userRecipes()
            ->where('todo', true)
            ->with('recipe')
            ->get()
            ->pluck('recipe');
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