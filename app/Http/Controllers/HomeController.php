<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $noticias;
    protected $users;

    public function __construct(Noticia $noticias, User $users)
    {
        $this->noticias = $noticias;
        $this->users = $users;
    }

    public function index(Request $request)
    {
        $noticias = $this->noticias->latest()->take(5)->get();
        return view('home', ['noticias' => $noticias]);
    }

    public function admin(Request $request)
    {
        if (auth()->user()->is_admin !== 1) {
            return redirect()->route('home')->with(['Error' => 'Não autorizado']);
        }
        $qtd_noticias = $this->noticias->count();
        $qtd_users = $this->users->count();
        return view('admin', ['qtd_noticias' => $qtd_noticias, 'qtd_users' => $qtd_users]);
    }
}