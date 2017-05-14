<?php
namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function me()
    {
        return $this->user();
    }

    public function login(User $user)
    {
        auth()->login($user);

        return $this->success();
    }
}