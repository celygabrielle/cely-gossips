@extends('layouts.app')

@section('body')

    
<div class="card">
<div class="card-header pb-0 border-bottom-0">
        <h3 class="card-title text-muted">
            Usuário
        </h3>
            <a href="{{ route('user.edit', ['id' => $user->id]) }}">Editar</a>
    </div>
    <div class="card-body pt-0">
        <div class="mt-2">
            <h3 class="fw-semibold">
                {{ $user->name }}
            </h3>
        </div>
        <p>{{ $user->email }}</p>
    </div>
    </div>
    
@endsection
