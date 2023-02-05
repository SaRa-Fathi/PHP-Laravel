<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
class SocialiteController extends Controller
{

    public function redirect($provider)
    {
        try
        {
            if(Str::lower($provider)=='google' || Str::lower($provider)=='github')
            {
                return Socialite::driver($provider)->redirect();
            }

        }
        catch(\Exception $e)
        {
            return redirect()->route('login');
        }
        return redirect()->route('posts.index');
        // return Socialite::driver($provider)->redirect();
    }


    public function callback($provider)
    {
        try
        {
            if(Str::lower($provider)=='google' || Str::lower($provider)=='github')
            {
                $user = Socialite::driver($provider)->user();
                // return Socialite::driver($provider)->redirect();
            }


        }
        catch(\Exception $e)
        {
            return redirect()->route('login');
        }
        $authUser = $this->checkLogin($user);
        Auth::login($authUser);

        // $user = Socialite::driver('github')->user();
        // dd($user);

        return redirect()->route('home');
    }


    public function checkLogin($data)
    {
        $authUser = User::where('provider_id', $data->id)->first();
        if ($authUser)
        {
            return $authUser;
        }
        return User::create([
            'name' =>$data->name ?? $data->username,
            'email' =>$data->email,
            'provider_id' =>$data->id,
            'avatar' =>$data->avatar,
        ]);
    }
}
