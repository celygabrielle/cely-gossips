@extends('layouts.app')

@section('body')
    <h3>
        Bem vindo @auth {{ auth()->user()->name }} @endauth ao Cely Gossips
    </h3>
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
            Nenhuma notícia cadastrada
        </p>
    @else
        <a href="{{ route('noticia.index') }}">Ver todas as Notícias</a>
    @endif
@endsection
