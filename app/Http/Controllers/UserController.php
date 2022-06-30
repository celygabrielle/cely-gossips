<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function index(Request $request)
    {
        if (auth()->user()->is_admin !== 1) {
            return redirect()->route('home')->with(['Error' => 'Não autorizado']);
        }
        $users = $this->users->all();
        return view('user.index', ['users' => $users]);
    }

    public function show($id, Request $request)
    {
        $user = $this->users->find($id);
        if (!$user) {
            return redirect()->route('user.index')->with(['Error' => 'Não foi possivel encontrar o usuário']);
        }
        if (auth()->id() !== $user->id && auth()->user()->is_admin !== 1) {
            return redirect()->route('home')->with(['Error' => 'Não autorizado']);
        }
        return view('user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->users->find($id);
        if (!$user) {
            return redirect()->route('user.index')->with(['Error' => 'Não foi possivel encontrar o usuário']);
        }
        if (auth()->id() !== $user->id) {
            return redirect()->route('home')->with(['Error' => 'Não autorizado']);
        }
        return view('user.edit', ['user' => $user]);
    }

    public function update($id, Request $request)
    {
        $user = $this->users->find($id);
        if (!$user) {
            return redirect()->route('user.index')->with(['Error' => 'Não foi possivel encontrar o usuário']);
        }
        if (auth()->id() !== $user->id) {
            return redirect()->route('home')->with(['Error' => 'Não autorizado']);
        }
        $user->update($request->all());
        return redirect()->route('user.show', ['id' => $user->id]);
    }

    public function editRole($id)
    {
        if (auth()->user()->is_admin !== 1) {
            return redirect()->route('home')->with(['Error' => 'Não autorizado']);
        }
        $user = $this->users->find($id);
        if (!$user) {
            return redirect()->route('user.index')->with(['Error' => 'Não foi possivel encontrar o usuário']);
        }

        if ($user->is_admin === 1) {
            return redirect()->route('user.index')->with(['Error' => 'Não foi possivel alterar a função do usuário']);
        }
        return view('user.editRole', ['user' => $user]);
    }

    public function updateRole($id, Request $request)
    {
        if (auth()->user()->is_admin !== 1) {
            return redirect()->route('home')->with(['Error' => 'Não autorizado']);
        }

        $user = $this->users->find($id);

        if (!$user) {
            return redirect()->route('user.index')->with(['Error' => 'Não foi possivel encontrar o usuário']);
        }

        if ($user->is_admin === 1) {
            return redirect()->route('user.index')->with(['Error' => 'Não foi possivel alterar a função do usuário']);
        }

        $user->update(['is_admin' => $request->has('admin')]);

        return redirect()->route('user.show', ['id' => $user->id]);
    }

    public function delete($id, Request $request)
    {
        $user = $this->users->find($id);
        if (!$user) {
            return redirect()->route('user.index')->with(['Error' => 'Não foi possivel encontrar o usuário']);
        }
        if (auth()->id() !== $user->id && auth()->user()->is_admin !== 1) {
            return redirect()->route('home')->with(['Error' => 'Não autorizado']);
        }
        $user->delete();
        return redirect()->route('home');
    }
}
