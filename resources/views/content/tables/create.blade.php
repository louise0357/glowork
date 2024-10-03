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
    <h1>Create Table</h1>
    <form action="{{ route('tables.store') }}" method="POST">
        @csrf
        <label for="name">Table Name</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Create</button>
    </form>
@endsection
