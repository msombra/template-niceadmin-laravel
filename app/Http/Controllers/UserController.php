<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\DefinirSenhaMail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // Se o usuário logado não for admin vai retornar a página de não autorizado
    private function permissionRule() {
        if(Gate::denies('admin_only')) {
            return abort(403, 'ACESSO NÃO AUTORIZADO');
        }
    }

    public function index()
    {
        $users = User::all();

        $this->permissionRule();

        return view('pages.user.user_index', compact('users'));
    }

    public function create()
    {
        $this->permissionRule();

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

        $this->permissionRule();

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
