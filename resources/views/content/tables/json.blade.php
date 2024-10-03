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
    'resources/assets/js/jsonbabus.js',
    'resources/assets/js/ui-toasts.js'
    ])
@endsection


@section('content')
    <h1>Csv Table</h1>

    <form id="jsonForm">
        <input type="file" id="jsonFile" accept=".json,.csv">
        <button type="button" id="uploadButton">Yükle</button>
    </form>

    <h2>Tablo</h2>
    <div>
        <table class="dt-scrollableTable" style="width:100%"></table>
    </div>

    <!-- Düzenlenmiş JavaScript Kodu -->
    <script>
        // JavaScript kodu aşağıda verilmiştir.
    </script>
@endsection