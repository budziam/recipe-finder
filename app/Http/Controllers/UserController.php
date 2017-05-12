<?php
namespace App\Http\Controllers;

class UserController extends Controller
{
    public function me()
    {
        return $this->user();
    }
}