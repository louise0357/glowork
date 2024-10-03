@extends('layouts/layoutMaster')

@section('title', 'User List - Pages')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss',
  'resources/assets/vendor/libs/select2/select2.scss',
  'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/moment/moment.js',
  'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
  'resources/assets/vendor/libs/select2/select2.js',
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js',
  'resources/assets/vendor/libs/cleavejs/cleave.js',
  'resources/assets/vendor/libs/cleavejs/cleave-phone.js'
])
@endsection

@section('page-script')
@vite('resources/assets/js/app-customer-list.js')
@endsection

@section('content')

<div class="row g-6 mb-6">

</div>
<!-- Users List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h4 class="card-title mb-0">Sistem Üzerindeki Müşteriler</h4>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-users table">
      <thead>
      <tr>
            <th>ID</th>
            <th>Kullanıcı Adı</th>
            <th>İsim Soyisim</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>Adres</th>
            <th>Ülke</th>
            <th>Şehir</th>
            <th>İlçe</th>
            <th>Doğum Tarihi</th>
            <th>Müşteri Kayıt Tarihi</th>
            <th>Son Satın Alım Tarihi</th>
            <th>Müşteri Kaydı Durumu</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- Offcanvas to add new user -->

</div>
@endsection
