<?php


namespace App\Http\Controllers\MemberAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function broker()
    {
        return Password::broker('members');
    }

    public function showLinkRequestForm()
    {
        // Use the shared auth.passwords.email view but point its form to member route
        return view('auth.passwords.email', ['route' => 'member.password.email']);
    }
}
