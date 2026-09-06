<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MSitename;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Session;

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
    public function redirectTo()
    {
        $roles        = Auth::user()->roles_id;
        $kdcustomer   = Auth::user()->kdcustomer;
        $namacustomer = Auth::user()->getcustomer->namacustomer;
        $category     = Auth::user()->getcustomer->category;
        $sitename     = Auth::user()->idsitename;
        $namasitename = MSitename::where('id', $sitename)->first();

        switch ($roles) {
            case 1:

                Session::put('runidsitename', $sitename);
                Session::put('runnamasitename', $namasitename->namasitename);
                Session::put('roles_id', $roles);
                Session::put('kdcustomer', $kdcustomer);
                Session::put('namacustomer', $namacustomer);
                Session::put('category', $category);
                return route('root');
                break;
            case 2:

                Session::put('runidsitename', $sitename);
                Session::put('runnamasitename', $namasitename->namasitename);
                Session::put('roles_id', $roles);
                Session::put('kdcustomer', $kdcustomer);
                Session::put('namacustomer', $namacustomer);
                Session::put('category', $category);
                return route('root');
                break;
            case 4:

                Session::put('runidsitename', $sitename);
                Session::put('runnamasitename', $namasitename->namasitename);
                Session::put('roles_id', $roles);
                Session::put('kdcustomer', $kdcustomer);
                Session::put('namacustomer', $namacustomer);
                Session::put('category', $category);
                return route('root');
                break;
            case 5:

                Session::put('runidsitename', $sitename);
                Session::put('runnamasitename', $namasitename->namasitename);
                Session::put('roles_id', $roles);
                Session::put('kdcustomer', $kdcustomer);
                Session::put('namacustomer', $namacustomer);
                Session::put('category', $category);
                return route('root');
                break;
            case 6:

                Session::put('runidsitename', $sitename);
                Session::put('runnamasitename', $namasitename->namasitename);
                Session::put('roles_id', $roles);
                Session::put('kdcustomer', $kdcustomer);
                Session::put('namacustomer', $namacustomer);
                Session::put('category', $category);
                return route('root');
                break;
            default:
                return redirect()->route('login');
                break;
        }
    }
}
