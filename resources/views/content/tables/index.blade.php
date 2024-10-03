@extends('layouts/layoutMaster')
@section('title', 'Accordion - UI elements')
@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/toastr/toastr.scss',
  'resources/assets/vendor/libs/animate-css/animate.scss'
])
@endsection
<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/toastr/toastr.js'
    ])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite([
    'resources/assets/js/tables-datatables-template.js',
    'resources/assets/js/ui-toasts.js'
    ])
@endsection
@section('content')
    <h1>My Tables</h1>
    <a href="{{ route('tables.create') }}">Create New Table</a>
    <ul>
        @foreach ($tables as $table)
            <li><a href="{{ route('tables.show', $table) }}">{{ $table->name }}</a></li>
        @endforeach
    </ul>
@endsection
