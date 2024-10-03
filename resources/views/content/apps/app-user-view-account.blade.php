@extends('layouts/layoutMaster')

@section('title', 'User View - Pages')

@section('vendor-style')
  @vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss',
    'resources/assets/vendor/libs/animate-css/animate.scss',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
    'resources/assets/vendor/libs/select2/select2.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss',
    'resources/assets/vendor/libs/toastr/toastr.scss'
  ])
@endsection

@section('page-style')
  @vite([ 'resources/assets/vendor/scss/pages/page-user-view.scss'])
@endsection

@section('vendor-script')
  @vite([
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
    'resources/assets/vendor/libs/cleavejs/cleave.js',
    'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    'resources/assets/vendor/libs/toastr/toastr.js'
  ])
@endsection

@section('page-script')
  @vite([
    'resources/assets/js/modal-edit-user.js',
    'resources/assets/js/app-user-view.js',
    'resources/assets/js/app-user-view-account.js',
    'resources/assets/js/ui-toasts.js'
  ])
@endsection

@section('content')
  @if (session('success'))
    <script>
      document.addEventListener("DOMContentLoaded", function() {
          toastr.success('İşlem Başarıyla Gerçekleştirildi!', 'Başarılı!');
      });
    </script>
  @endif

  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card mb-6">
        <div class="card-body pt-12">
          <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
              <img class="img-fluid rounded mb-4" src="{{ auth()->user() ? auth()->user()->profile_photo_url : asset('assets/img/avatars/1.png') }}" height="120" width="120" alt="User avatar" />
              <div class="user-info text-center">
                <h5>{{ $user->name }}</h5>
                <span class="badge bg-label-danger rounded-pill">{{ $user->role }}</span>
              </div>
            </div>
          </div>
          <h5 class="pb-4 border-bottom mb-4">Details</h5>
          <div class="info-container">
            <ul class="list-unstyled mb-6">
              <li class="mb-2">
                <span class="h6">Username:</span>
                <span>{{ $user->username }}</span>
              </li>
              <li class="mb-2">
                <span class="h6">Email:</span>
                <span>{{ $user->email }}</span>
              </li>
              <li class="mb-2">
                <span class="h6">Status:</span>
                <span class="badge bg-label-success rounded-pill">Active</span>
              </li>

              <!-- Roller -->
              <li class="mb-2">
                <span class="h6">Role:</span>
                <span>
                  @if ($roles->count() === 0)
                    <span class="badge bg-primary">Kullanıcının Rolü bulunmamaktadır.</span>
                  @else
                    @foreach($roles as $role)
                      <span class="badge bg-primary mb-1">{{ $role }}</span>
                    @endforeach
                  @endif
                </span>
              </li>
              <!-- /Roller -->

              <!-- Permler -->
              <li class="mb-2">
                <span class="h6">Perms:</span>
                <span>
                  @if ($permissions->count() === 0)
                    <span class="badge bg-primary">Kullanıcının Yetkisi bulunmamaktadır.</span>
                  @else
                    @foreach($permissions as $permission)
                      <span class="badge bg-primary mb-1">{{ $permission->name }}</span>
                    @endforeach
                  @endif
                </span>
              </li>
              <!-- /Permler -->

              <li class="mb-2">
                <span class="h6">Contact:</span>
                <span>{{ $user->phone }}</span>
              </li>
            </ul>
            <div class="d-flex justify-content-center">
              <a href="javascript:;" class="btn btn-primary me-4" data-bs-target="#editUserModal" data-bs-toggle="modal">Edit</a>
              <a href="javascript:;" class="btn btn-outline-danger suspend-user">Suspend</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /User Card -->
    </div>
    <!-- /User Sidebar -->

    <!-- User Content -->
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
      <!-- User Tabs -->
      <div class="nav-align-top">
        <ul class="nav nav-pills flex-column flex-md-row flex-wrap mb-6 row-gap-2">
          <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0);" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true"><i class="ri-group-line me-1_5"></i>Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0);" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-security" aria-controls="navs-pills-top-security" aria-selected="false"><i class="ri-lock-2-line me-1_5"></i>Security</a>
          </li>
        </ul>
      </div>
      <!-- /User Tabs -->

      <div class="tab-content">
        <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
          <!-- İlgili Kişi Tablolar -->
          <div class="card mb-6">
            <h5 class="card-header">İlgili Kişi Olarak Etiketlenilmiş Tablolar</h5>
            <div class="card-datatable table-responsive mb-n0">
              <table class="table datatable-projectt table-border-bottom-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tablonun Kategorisi</th>
                    <th>Tablo İsmi</th>
                    <th class="text-nowrap">Kolon İsmi</th>
                    <th>Satır İd</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $index => $item)
                    <tr>
                      <td>{{ intval($index) + 1 }}</td>
                      <th>{{ $item['table_main_category'] }}</th>
                      <td><a href="/tables/{{ $item['table_id'] }}" target="_blank">{{ $item['table_name'] }}</a></td>
                      <td>{{ $item['column_name'] }}</td>
                      <td>{{ $item['row_id'] }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- /İlgili Kişi Tablolar -->

          <!-- İlgili Kişi Kanbanlar -->
          <div class="card mb-6">
            <h5 class="card-header">İlgili Kişi Olarak Etiketlenilmiş Kanbanlar</h5>
            <div class="card-datatable table-responsive mb-n0">
              <table class="table datatable-projectt table-border-bottom-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Kanbanın Kategorisi</th>
                    <th>Kanban İsmi</th>
                    <th class="text-nowrap">Board İsmi</th>
                    <th>Task İsmi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($kanbanData as $index => $item)
                    <tr>
                        <td>{{ intval($index) + 1 }}</td>
                        <th>{{ $item['board_main'] }}</th>
                        <td><a href="/boards/{{ $item['board_id'] }}" target="_blank">{{ $item['board_name'] }}</a></td>
                        <td>{{ $item['list_name'] }}</td>
                        <td>{{ $item['task_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
              </table>
            </div>
          </div>
          <!-- /İlgili Kişi Kanbanlar -->
        </div>

        <div class="tab-pane fade show" id="navs-pills-top-security" role="tabpanel">
    <!-- Change Password -->
    <div class="card mb-6">
        <h5 class="card-header">Şifre Sıfırlama Bağlantısı Gönder</h5>
        <div class="card-body">
            <form id="formChangePassword" method="POST" onsubmit="sendResetLink(event)">
                @csrf
                <div class="row gx-5">
                    <div>
                        <button type="submit" class="btn btn-primary me-2" style="justify-content: center;">
                            Şifre Sıfırlama Bağlantısı Gönder!
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/ Change Password -->
</div>

<script>
    function sendResetLink(event) {
        event.preventDefault(); 

        const form = document.getElementById('formChangePassword');
        const formData = new FormData(form);

        fetch('/password/email/user', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                toastr.success(data.message); 
            } else {
                toastr.error('Bir hata oluştu.');
            }
        })
        .catch(error => {
            console.error('Hata:', error);
            toastr.error('Bir hata oluştu.');
        });
    }
</script>




      </div>
    </div>
    <!-- /User Content -->
  </div>








  <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Kullanıcı Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="editUserForm" method="POST" action="{{ route('user.update', $user->id) }}">
                    @csrf                    
                    @method('POST')
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="username" class="form-label">Kullanıcı Adı:</label>
                        <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name" class="form-label">İsim:</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
                    </div>

                  <div class="form-group mb-3">
                      <label for="roles" class="form-label">Roller</label>
                      <select class="select2 form-select" id="roles" name="roles[]" multiple>
                          @foreach($fullroles as $role)
                              <option value="{{ $role->name }}" 
                                  {{ in_array($role->name, $roles->toArray()) ? 'selected' : '' }}>
                                  {{ $role->name }}
                              </option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group mb-3">
                      <label for="permissions" class="form-label">İzinler</label>
                      <select class="select2 form-select" id="permissions" name="permissions[]" multiple>
                          @foreach($fullpermissions as $permission)
                              <option value="{{ $permission->name }}" 
                                  {{ $permissions->contains('name', $permission->name) ? 'selected' : '' }}>
                                  {{ $permission->name }}
                              </option>
                          @endforeach
                      </select>
                  </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary" onclick="document.getElementById('editUserForm').submit();">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('editUserForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const userId = document.getElementById('user_id').value;

    fetch(`/user/update/${userId}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: 'Başarılı!',
                text: data.message,
                icon: 'success',
            });
            $('#editUserModal').modal('hide');
        } else {
            Swal.fire({
                title: 'Hata!',
                text: data.message,
                icon: 'error',
            });
        }
    })
    .catch(error => {
        console.error('Hata:', error);
        Swal.fire({
            title: 'Hata!',
            text: 'Bir hata oluştu, lütfen tekrar deneyin.',
            icon: 'error',
        });
    });
});


</script>


@endsection
