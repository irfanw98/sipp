<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ],
        [
            'username.required' => 'Username tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.'
        ]);

        if(Auth::attempt(array('username' => $request['username'], 'password' => $request['password']))){
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/dashboard-admin');
            } else if(Auth::user()->role === 'pimpinan') {
                return redirect()->intended('/dashboard-pimpinan');
            } else if(Auth::user()->role === 'customer_service') {
                return redirect()->intended('/dashboard-cs');
            } else if(Auth::user()->role === 'kadiv_offset') {
                return redirect()->intended('/dashboard-kadiv-offset');
            } else if(Auth::user()->role === 'kadiv_produksi') {
                return redirect()->intended('/dashboard-kadiv-produksi');
            } else {
                return redirect()->intended('/dashboard-kadiv-finishing');
            }
        }
            return back()->withErrors([
                'username' => 'Maaf username atau password salah',
            ])->onlyInput('username');

    }

}
