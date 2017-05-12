<?php
namespace App;

use Illuminate\Support\Collection;

class RecipeFinder
{
    /** @var Food2ForkClient */
    protected $client;

    /** @var RecipeRepository */
    protected $recipeRepository;

    public function __construct(Food2ForkClient $client, RecipeRepository $recipeRepository)
    {
        $this->client = $client;
        $this->recipeRepository = $recipeRepository;
    }

    public function search(array $ingredients, int $page) : Collection
    {
        $results = $this->client->search($ingredients, $page);

        return collect($results)
            ->map(function (array $result) {
                return $this->recipeRepository->updateOrCreate($result);
            });
    }

    public function get(string $id)
    {
        $result = $this->client->get($id);

        return $this->recipeRepository->updateOrCreate($result);
    }
}