<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Auth\LoginController;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuth extends LoginController
{
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */

    public function handleProviderCallback($service)
    {
        $userSocial = Socialite::driver($service)->user();

        $findUser = User::where('email',$userSocial->email)->first();

        if ($findUser) {
            Auth::login($findUser);
            return redirect('/');
        } else {
            $user = new User();
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt(123456);
            $user->save();
            Auth::login($user);

            return redirect('/');
        }

    }
}
