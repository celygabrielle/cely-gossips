<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    protected $noticias;

    public function __construct(Noticia $noticias)
    {
        $this->noticias = $noticias;
    }

    public function index(Request $request)
    {
        $noticias = $this->noticias->all();
        return view('noticia.index', ['noticias' => $noticias]);
    }

    public function create()
    {
        if (auth()->user()->is_admin !== 1) {
            return redirect()->route('noticia.index')->with(['Error' => 'Não autorizado']);
        }
        return view('noticia.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->is_admin !== 1) {
            return redirect()->route('noticia.index')->with(['Error' => 'Não autorizado']);
        }
        $noticia = $this->noticias->create($request->all() + ['id_user' => auth()->id()]);
        return redirect()->route('noticia.show', ['id' => $noticia]);
    }

    public function show($id, Request $request)
    {
        $noticia = $this->noticias->find($id);
        if (!$noticia) {
            return redirect()->route('noticia.index')->with(['Error' => 'Não foi possivel encontrar a notícia']);
        }
        return view('noticia.show', compact('noticia'));
    }

    public function edit($id)
    {
        $noticia = $this->noticias->find($id);
        if (!$noticia) {
            return redirect()->route('noticia.index')->with(['Error' => 'Não foi possivel encontrar a notícia']);
        }
        if (auth()->id() !== $noticia->id_user) {
            return redirect()->route('noticia.index')->with(['Error' => 'Não autorizado']);
        }
        return view('noticia.edit', ['noticia' => $noticia]);
    }

    public function update($id, Request $request)
    {
        $noticia = $this->noticias->find($id);
        if (!$noticia) {
            return redirect()->route('noticia.index')->with(['Error' => 'Não foi possivel encontrar a notícia']);
        }
        if (auth()->id() !== $noticia->id_user) {
            return redirect()->route('noticia.index')->with(['Error' => 'Não autorizado']);
        }
        $noticia->update($request->all());
        return redirect()->route('noticia.show', ['id' => $noticia->id]);
    }

    public function delete($id, Request $request)
    {
        $noticia = $this->noticias->find($id);
        if (!$noticia) {
            return redirect()->route('noticia.index')->with(['Error' => 'Não foi possivel encontrar a notícia']);
        }
        if (auth()->id() !== $noticia->id_user && auth()->user()->is_admin !== 1) {
            return redirect()->route('noticia.index')->with(['Error' => 'Não autorizado']);
        }
        $noticia->delete();
        return redirect()->route('noticia.index');
    }
}