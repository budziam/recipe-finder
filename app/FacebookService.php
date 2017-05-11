<?php
namespace App;

class FacebookService
{
    public function firstOrCreate($id, string $email, string $name) : User
    {
        // Get by facebook id
        $user = User::where('facebook_id', $id)->first();
        if ($user !== null) {
            return $user;
        }

        // Get by email
        $user = User::where('email', $email)->first();
        if ($user !== null) {
            $user->update([
                'facebook_id' => $id,
                'name'        => $name,
            ]);

            return $user;
        }

        // Create
        return User::create([
            'email'       => $email,
            'name'        => $name,
            'facebook_id' => $id,
        ]);
    }
}