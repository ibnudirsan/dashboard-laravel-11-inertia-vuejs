<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Handles the signin functionality by rendering the login page.
     *
     * @return \Inertia\Response
     */
    public function signin()
    {
        return Inertia::render('Auth/login');
    }

    /**
     * Handles the signin functionality by validating user input and creating a new user.
     *
     * @param Request $request The incoming HTTP request containing user signin data.
     * @throws None
     * @return \Illuminate\Http\RedirectResponse Redirects to the intended page after successful signin.
     */
    public function storeSignin(Request $request)
    {
        $credentials = Validator::make($request->all(),[
            'email' => ['required','string','email','max:30'],
            'password' => ['required','string','min:8']
        ]);
        if($credentials->fails()){
            return redirect()->back()->withErrors($credentials)->withInput();
        }
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];
                if(Auth::attempt($credentials)){
                    $request->session()->regenerate();
                    return redirect()->intended('/');
                }
                    return back()->withErrors([
                        'email' => 'The provided credentials do not match our records.',
                    ]);
    }

    /**
     * Handles the signup functionality by rendering the signup page.
     *
     * @return \Inertia\Response
     */
    public function signup()
    {
        return Inertia::render('Auth/signup');
    }

    /**
     * Handles the signup functionality by validating user input and creating a new user.
     *
     * @param Request $request The incoming HTTP request containing user signup data.
     * @throws ValidationException If the validation of the user input fails.
     * @return \Illuminate\Http\RedirectResponse Redirects to the login route after successful signup.
     */
    public function storeSignup(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','string','max:20'],
            'email' => ['required','string','email','max:50','unique:users'],
            'password' => ['required','string','min:8','confirmed']
        ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
                $user = User::create([
                   'name'       => $request->name, 
                   'email'      => $request->email, 
                   'password'   => $request->password, 
                ]);
                    return redirect()->route('login');
    }

    /**
     * Logout the user and invalidate the session.
     *
     * @param Request $request The incoming HTTP request.
     * @return \Illuminate\Http\RedirectResponse Redirects to the login route.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
