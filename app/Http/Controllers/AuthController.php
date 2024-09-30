<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\DefinirSenhaMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register()
    {
        return view('pages.auth.register');
    }

    public function registerPost(Request $request, User $user)
    {
        $regras = [
            'name'      => 'required|min:5',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:3',
        ];

        $msgRequired = 'Campo obrigatório';
        $msgMin = 'Mínimo :min caracteres';

        $mensagens = [
            // required
            'name.required'         => $msgRequired,
            'email.required'        => $msgRequired,
            'password.required'     => $msgRequired,
            // min
            'name.min'              => $msgMin,
            'password.min'          => $msgMin,
            // email
            'email.email'           => 'Email inválido',
            // unique
            'email.unique'          => 'Email já cadastrado',
        ];

        $request->validate($regras, $mensagens);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return back()->with('success', 'Registro realizado com sucesso.');
    }

    public function login()
    {
        return view('pages.auth.login');
    }

    public function loginPost(Request $request)
    {
        $regras = [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];

        $msgRequired = 'Preencha o campo';

        $mensagens = [
            'email.required' => $msgRequired,
            'email.email' => 'Email inválido',
            'password.required' => $msgRequired,
        ];

        $credentials = $request->validate($regras, $mensagens);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('index');
        }

        return back()->with('error', 'Email ou Senha inválidos');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }

    public function setPassword($email)
    {
        $email = $email;

        return view('pages.auth.set_password', compact('email'));
    }

    public function createPassword(Request $request)
    {
        $user = User::where('email', $request->email)->get()->first();

        if(!$user) {
            return back()->with('error', 'Email não cadastrado no sistema.');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Senha definida com sucesso.');
    }

    public function resetPassword()
    {
        return view('pages.auth.reset_password');
    }

    public function resetPasswordPost(Request $request)
    {
        $userEmail = $request->email;
        $userName = User::where('email', $userEmail)->get()->first();

        if(!$userName) return back()->with('error', 'Email informado não está cadastrado no sistema!');

        Mail::to($userEmail)->send(new DefinirSenhaMail($userName->name, $userEmail));

        return back()->with('success', 'Redefinição de senha solicitada com sucesso!');
    }
}
