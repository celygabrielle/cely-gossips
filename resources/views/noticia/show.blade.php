@extends('layouts.app')

@section('body')
    <div class="row">
        <div class="@if ($noticia->imagem_extensao) col-8 @else col-12 @endif">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $noticia->titulo }}
                    </h3>
                    @if (auth()->id() === $noticia->id_user)
                        <a href="{{ route('noticia.edit', ['id' => $noticia->id]) }}">Editar</a>
                    @endif
                    @if (auth()->id() === $noticia->id_user || auth()->user()->is_admin !== 0)
                        <form method="POST" action="{{ route('noticia.delete', ['id' => $noticia->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Apagar</button>
                        </form>
                    @endif
                </div>
                <div class="card-body">
                    <h3 class="fw-semibold">
                        {{ $noticia->subtitulo }}
                    </h3>
                    <p>{{ $noticia->corpo }}</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            @if ($noticia->imagem_extensao)
                <img src="{{ asset('storage/imagens/' . $noticia->id . '.' . $noticia->imagem_extensao) }}"
                    class="img-fluid" alt="Responsive image">
            @endif
        </div>
    </div>
@endsection
