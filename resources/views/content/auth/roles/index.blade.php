@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Roller</h1>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Adı</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    <a href="{{ route('content.auth.roles.edit', $role) }}" class="btn btn-warning btn-sm">Düzenle</a>
                    <form action="{{ route('content.auth.roles.destroy', $role) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
