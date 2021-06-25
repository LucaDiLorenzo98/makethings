<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function postSignUp(Request $request): RedirectResponse
    {
        $request->validate([ //specify the rules of input data
            'email' => 'email|unique:users',
            'first_name' => 'required|max:120',
            'password' => 'required|min:4',
        ]);

        $email = $request['email'];
        $first_name = $request['first_name'];
        $password = bcrypt($request['password']); //bcrypt encrypt user password

        $user = new User(); // create a new instance of User object.

        $user->email = $email;
        $user->first_name = $first_name;
        $user->password = $password;

        $user->save(); // save user data on DB

        Auth::login($user); // after input the data login with it

        return redirect()->route('dashboard'); // if everything ok go to dashboard
    }

    public function postSignIn(Request $request): RedirectResponse
    {
        $request->validate([ //specify the rules of input data
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
