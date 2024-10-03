@extends('layouts.app')

@section('content')
<div class="container">
    <h1>İzinler</h1>
    <a href="{{ route('permissions.create') }}" class="btn btn-primary">Yeni İzin Ekle</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Adı</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>
                    <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-warning btn-sm">Düzenle</a>
                    <form action="{{ route('permissions.destroy', $permission) }}" method="POST" style="display:inline;">
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
