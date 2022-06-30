@extends('layouts.app')

@section('body')
    <h3 class="">
        Bem vindo(a) @auth {{ auth()->user()->name }} @endauth a Área administrativa do Cely Gossips
    </h3>
    <div class="row">
        <div class="col-6">
            <div class="card text-center">
                <div class="card-header">
                    Notícias
                </div>
                <div class="card-body">
                    <h3>
                        {{ $qtd_noticias }}
                    </h3>

                </div>
                <div class="card-footer btn-list">
                    <a href="{{ route('noticia.index') }}" class="btn btn-info">
                        Ver Notícias
                    </a>
                    <a href="{{ route('noticia.create') }}" class="btn btn-primary">
                        Cadastrar uma notícia
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card text-center">
                <div class="card-header">
                    Usuários
                </div>
                <div class="card-body">
                    <h3>
                        {{ $qtd_users }}
                    </h3>
                </div>
                <div class="card-footer btn-list">
                    <a href="{{ route('user.index') }}" class="btn btn-info">
                        Ver Usuários
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
