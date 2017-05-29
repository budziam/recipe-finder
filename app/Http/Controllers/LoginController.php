<?php
namespace App\Http\Controllers;

use App\FacebookService;
use GuzzleHttp\Exception\ClientException;
use Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')
            ->redirectUrl(route('login.facebook.callback'))
            ->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @param FacebookService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(FacebookService $service)
    {
        try {
            $socialiteUser = Socialite::driver('facebook')
                ->redirectUrl(route('login.facebook.callback'))
                ->user();
        } catch (ClientException $e) {
            return redirect()->to('/no-access');
        }

        $facebookId = $socialiteUser->getId();
        $email = $socialiteUser->getEmail();
        $name = $socialiteUser->getName() ?? uniqid();

        if (!strlen($facebookId) || !strlen($email)) {
            return redirect()->to('/no-access');
        }

        $user = $service->firstOrCreate($facebookId, $email, $name);

        auth()->login($user);

        return redirect()->to('/');
    }

    public function logout()
    {
        auth()->logout();

        return $this->success();
    }
}
