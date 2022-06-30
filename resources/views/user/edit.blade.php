@extends('layouts.app')

@section('body')
    <div class="card">
        <div class="card-header pb-0 border-bottom-0">
            <h3 class="card-title text-muted">
                Editar Usuário
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="">Nome</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">
                    Salvar Alterações
                </button>
            </form>
        </div>
    </div>
@endsection
