@extends('layouts.app')

@section('body')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Usuário
            </h3>
            <div class="btn-list">
                @if (auth()->id() === $user->id)
                    <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn text-primary">Editar</a>
                @endif
                @if (auth()->user()->is_admin !== 0 && $user->is_admin !== 1)
                    <a href="{{ route('user.edit.role', ['id' => $user->id]) }}" class="btn btn-warning">Editar Função</a>
                @endif
            </div>

            @if ($user->is_admin !== 1 && (auth()->id() === $user->id || auth()->user()->is_admin !== 0))
                <form method="POST" action="{{ route('user.delete', ['id' => $user->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Excluir usuario</button>
                </form>
            @endif
        </div>
        <div class="card-body">
            <h3 class="fw-semibold">
                {{ $user->name }}
            </h3>
            <p>Email: {{ $user->email }}</p>
            <p>Admin: {{ $user->is_admin ? 'Administrador' : 'Usuário' }}</p>
        </div>
    </div>
@endsection
