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

        $validated = $request->validate([
            'titulo' => ['required', 'string'],
            'subtitulo' => ['required', 'string'],
            'corpo' => ['required', 'string'],
            'imagem' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png,gif,svg'],
        ]);

        $extensao = null;
        $imagem = [];
        if ($request->hasfile('imagem')) {
            $nome_extensao = $request->imagem->getClientOriginalName();
            $extensao = pathinfo($nome_extensao, PATHINFO_EXTENSION);
            $imagem = [
                'imagem_nome' => pathinfo($nome_extensao, PATHINFO_FILENAME),
                'imagem_extensao' => $extensao,
            ];
        }

        $noticia = $this->noticias->create($validated + ['id_user' => auth()->id()] + $imagem);

        if ($request->hasfile('imagem')) {
            $request->imagem->storeAs('imagens/', $noticia->id . '.' . $extensao);
        }

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

        $validated = $request->validate([
            'titulo' => ['required', 'string'],
            'subtitulo' => ['required', 'string'],
            'corpo' => ['required', 'string'],
            'imagem' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png,gif,svg'],
        ]);

        $extensao = null;
        $imagem = [];
        if ($request->hasfile('imagem')) {
            $nome_extensao = $request->imagem->getClientOriginalName();
            $extensao = pathinfo($nome_extensao, PATHINFO_EXTENSION);
            $imagem = [
                'imagem_nome' => pathinfo($nome_extensao, PATHINFO_FILENAME),
                'imagem_extensao' => $extensao,
            ];
            $request->imagem->storeAs('imagens/', $noticia->id . '.' . $extensao);
        }

        $noticia->update($validated + $imagem);

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
