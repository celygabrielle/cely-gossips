@extends('layouts.app')

@section('body')
    <div class="card">
        <div class="card-header pb-0 border-bottom-0">
            <h3 class="card-title text-muted">
                Editar Usuário
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update.role', ['id' => $user->id]) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="">{{ $user->name }}</label>
                    <div class="input-group">
                        <input type="checkbox" name="admin" value="{{ $user->id }}" class="form-control"
                            {{ $user->is_admin ? 'checked' : '' }}>
                        <label for="">Administrador?</label>
                    </div>

                </div>
                <button type="submit" class="btn btn-success">
                    Salvar Alterações
                </button>
            </form>
        </div>
    </div>
@endsection
