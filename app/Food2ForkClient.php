<?php
namespace App;

use App\Exceptions\Food2ForkException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Log;

class Food2ForkClient
{
    const SORT_RATING = 'r';
    const SORT_TRENDINGNESS = 't';

    protected $searchUrl = 'http://food2fork.com/api/search';
    protected $getUrl = 'http://food2fork.com/api/get';

    /** @var string */
    protected $apiKey;

    /** @var Client */
    protected $client;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client();
    }

    public function search(array $ingredients, int $page = 1, string $sort = Food2ForkClient::SORT_RATING) : array
    {
        $q = implode(',', $ingredients);

        $query = $this->buildQuery(compact('q', 'sort', 'page'));

        try {
            $response = $this->client
                ->get($this->searchUrl . '?' . $query)
                ->getBody();
        } catch (BadResponseException $exception) {
            Log::error($exception);

            throw new Food2ForkException();
        }

        $decoded = json_decode($response, true);

        if (!isset($decoded['recipes'])) {
            throw new Food2ForkException();
        }

        return $decoded['recipes'];
    }

    public function get(string $rId)
    {
        $query = $this->buildQuery(compact('rId'));

        try {
            $response = $this->client
                ->get($this->getUrl . '?' . $query)
                ->getBody();
        } catch (BadResponseException $exception) {
            Log::error($exception);
            throw new Food2ForkException();
        }

        $decoded = json_decode($response, true);

        if (!isset($decoded['recipe'])) {
            Log::error($response);
            throw new Food2ForkException();
        }

        return $decoded['recipe'];
    }

    protected function buildQuery(array $args) : string
    {
        return http_build_query(array_merge(['key' => $this->apiKey], $args));
    }
}