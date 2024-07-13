<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->roles_id == 1) {
                return redirect()->route('admin.home');
            }if(auth()->user()->roles_id == 2){
                return redirect()->route('kepala.home');
            }if(auth()->user()->roles_id == 3){
                return redirect()->route('TU.home');
            }if(auth()->user()->roles_id == 4){
                return redirect()->route('guru.home');
            }if(auth()->user()->roles_id == 5){
                return redirect()->route('walikelas.home');
            }if(auth()->user()->roles_id == 6){
                return redirect()->route('siswa.home');
            }if(auth()->user()->roles_id == 7){
                return redirect()->route('pengunjung.home');
            }
            else{
                return redirect()->route('login');
            }
        }else{
            return redirect()->route('login')
                ->with('email','Email-Address And Password Are Wrong.');
        }
          
    }
}
