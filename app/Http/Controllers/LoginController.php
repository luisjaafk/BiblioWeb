<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;   
use App\Models\User;


class LoginController extends Controller
{
    public function loginProcess(Request $request): View|RedirectResponse
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $users = User::all();
return redirect()->route('books.index')->with('success', 'Inicio de sesión exitoso');
    }

    return back()->withErrors([
        'email' => 'Las credenciales proporcionadas son incorrectas.',
    ])->onlyInput('email');
}
public function validateAccount($token)
{
    $user = User::where('remember_token', $token)->first();

    if (!$user) {
        return redirect('/login')->with('error', 'Token inválido o cuenta ya activada.');
    }

    // Aquí marcas la cuenta como verificada, por ejemplo:
    $user->email_verified_at = now();

    // Limpias el token de activación (que estás usando en remember_token)
    $user->remember_token = null;

    $user->save();

    return redirect('/login')->with('success', 'Cuenta activada correctamente. Ya puedes iniciar sesión.');
}

}
