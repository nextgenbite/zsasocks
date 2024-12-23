<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\LoginPointService;
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
    // use AuthenticatesUsersByPhoneOrEmail;
    protected $loginPointService;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if (Auth::user()->role == 'admin') {
            return '/home';
        } else {
            return '/dashboard';
        }
    }

        // Override username method to return the login field
        public function username()
        {
            return 'login';
        }
    
        // Override credentials method to support email or phone login
        protected function credentials(Request $request)
        {
            $login = $request->input('login');
            $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
            return [
                $field => $login,
                'password' => $request->input('password'),
            ];
        }
    
        // Override validateLogin method to use the custom login field
        protected function validateLogin(Request $request)
        {
            $request->validate([
                'login' => 'required|string',
                'password' => 'required|string',
            ]);
        }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LoginPointService $loginPointService)
    {
        $this->loginPointService = $loginPointService;
        $this->middleware('guest')->except('logout');
    }
    
    protected function authenticated(Request $request, $user)
    {
        $this->loginPointService->giveDailyLoginPoints($user);
    }
}
