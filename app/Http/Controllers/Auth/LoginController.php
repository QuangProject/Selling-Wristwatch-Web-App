<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return redirect('/home');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        // fetch authenticated user
        $firstName = $user->user['given_name'];
        $lastName = $user->user['family_name'];
        $email = $user->user['email'];

        $checkUser = User::where('email', $email)->first();
        if ($checkUser) {
            auth()->login($checkUser);
            if ($checkUser->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home');
        } else {
            $user = User::create([
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email,
                'password' => bcrypt('12345678'),
            ]);
            auth()->login($user);
            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
            }
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home');
        }
    }
}
