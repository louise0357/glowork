@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($role) ? 'Rol Düzenle' : 'Yeni Rol Ekle' }}</h1>

    <form action="{{ isset($role) ? route('roles.update', $role) : route('roles.store') }}" method="POST">
        @csrf
        @if (isset($role))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Rol Adı</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name ?? old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="permissions">İzinler</label>
            @foreach ($permissions as $permission)
                <div class="form-check">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input" 
                        {{ isset($role) && $role->hasPermissionTo($permission) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Kaydet</button>
    </form>
</div>
@endsection
