@extends('layouts.app')

@section('body')

    @foreach ($noticias as $noticia)
        <div class="card mt-2">
            <div class="card-header">
                <h3 class="card-title text-muted">
                    {{ $noticia->titulo }}
                </h3>
            </div>
            <div class="card-body">
                <p>{{ $noticia->subtitulo }}</p>
                <a href="{{ route('noticia.show', ['id' => $noticia->id]) }}" class="btn btn-primary">Ver Mais</a>
            </div>
        </div>
    @endforeach

    @if (count($noticias) <= 0)
        <p>
            Nenhuma Notícia cadastrada
        </p>
    @endif
@endsection
