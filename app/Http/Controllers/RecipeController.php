<?php
namespace App\Http\Controllers;

class RecipeController extends Controller
{
    public function index()
    {
        return [
            [
                'name' => 'recipe1',
            ],
            [
                'name' => 'recipe2',
            ],
        ];
    }
}