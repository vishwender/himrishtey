<?php

namespace App\Http\Controllers\MemberAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller (for members)
    |--------------------------------------------------------------------------
    |
    | This controller handles password resets for members. It uses the
    | ResetsPasswords trait while specifying the members broker and guard.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect members after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest:member');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('members');
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    protected function guard()
    {
        return Auth::guard('member');
    }

    /**
     * Show the password reset form for members.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        // Use the shared auth.passwords.reset view but ensure the form posts
        // to the member password update route name.
        return view('auth.passwords.reset', [
            'token' => $token,
            'email' => $request->email,
            'route' => 'member.password.update'
        ]);
    }
}
