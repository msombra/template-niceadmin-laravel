<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\DefinirSenhaMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('pages.user.user_index', compact('users'));
    }

    public function create()
    {
        return view('pages.user.user_create');
    }

    public function store(Request $request)
    {
        Mail::to($request->email)->send(new DefinirSenhaMail($request->name, $request->email));

        User::create($request->all());

        return redirect()->route('user.index')->with('success', 'Usuário cadastrado com succeso');
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if(!$user) return back();

        return view('pages.user.user_edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if(!$user) return back();

        $user->update($request->all());

        return redirect()->route('user.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if(!$user) return back();

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Usuário removido com sucesso.');
    }
}
