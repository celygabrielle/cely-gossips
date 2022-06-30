@extends('layouts.app')

@section('body')
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table border text-nowrap text-md-nowrap table-bordered table-hover mb-0">
                    <thead>
                        <th>Nome: </th>
                        <th>Email: </th>
                        <th> </th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }} </td>
                                <td>{{ $user->email }} </td>
                                <td>
                                    <a href="{{ route('user.show', ['id' => $user->id]) }}"
                                        class="btn btn-sm btn-primary">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
