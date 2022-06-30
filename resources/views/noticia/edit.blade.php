@extends('layouts.app')

@section('body')
    <div class="card">
        <div class="card-header pb-0 border-bottom-0">
            <h3 class="card-title text-muted">
                Editar Notícia
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('noticia.update', ['id' => $noticia->id]) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="">Titulo</label>
                    <input type="text" name="titulo" value="{{ $noticia->titulo }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">SubTitulo</label>
                    <input type="text" name="subtitulo" value="{{ $noticia->subtitulo }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Corpo</label>
                    <textarea name="corpo" class="form-control" cols="5" rows="5">{{ $noticia->corpo }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">
                    Salvar Alterações
                </button>
            </form>
        </div>
    </div>
@endsection
