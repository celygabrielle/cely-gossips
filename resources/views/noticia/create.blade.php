@extends('layouts.app')

@section('body')
    <div class="card">
        <div class="card-header pb-0 border-bottom-0">
            <h3 class="card-title text-muted">
                Cadastrar Noticia
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('noticia.store') }}">
                @csrf
                <div class="form-group">
                    <label for="">Titulo</label>
                    <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">SubTitulo</label>
                    <input type="text" name="subtitulo" value="{{ old('subtitulo') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Corpo</label>
                    <textarea name="corpo" class="form-control" cols="5" rows="5">{{ old('corpo') }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">
                    Salvar
                </button>
            </form>
        </div>
    </div>
@endsection
