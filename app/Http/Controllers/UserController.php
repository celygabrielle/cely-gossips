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
        $users = $this->users->all();
        return view('user.index', ['users' => $users]);
    }

    public function show($id, Request $request)
    {
        $user = $this->users->find($id);
        if (!$user) {
            return redirect()->route('user.index')->with(['Error' => 'Não foi possivel encontrar o usuário']);
        }
        return view('user.show', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $user = $this->users->create($request->validated());
        return redirect()->route('user.show', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = $this->users->find($id);
        if (!$user) {
            return redirect()->route('user.index')->with(['Error' => 'Não foi possivel encontrar o usuário']);
        }
        return view('user.edit', ['user' => $user]);
    }

    public function update($id, Request $request)
    {
        $user = $this->users->find($id);
        if (!$user) {
            return redirect()->route('user.index')->with(['Error' => 'Não foi possivel encontrar o usuário']);
        }
        $this->repository->update($request->validated(), $user->id);
        return redirect()->back()->with(['success' => "Alterado com sucesso"]);
    }

    public function delete($id, Request $request)
    {
        $user = $this->users->find($id);
        if (!$user) {
            return redirect()->route('user.index')->with(['Error' => 'Não foi possivel encontrar o usuário']);
        }

        $user->delete();

        if (auth()->id() === $id) {
            auth()->logout();
        }
        return redirect()->route('home');
    }
}
