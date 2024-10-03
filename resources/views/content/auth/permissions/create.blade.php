@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($permission) ? 'İzin Düzenle' : 'Yeni İzin Ekle' }}</h1>

    <form action="{{ isset($permission) ? route('permissions.update', $permission) : route('permissions.store') }}" method="POST">
        @csrf
        @if (isset($permission))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">İzin Adı</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name ?? old('name') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Kaydet</button>
    </form>
</div>
@endsection
