<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel">Profil Bilgileri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                <div class="modal-body">
                    <div class="form-group mb-5">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group mb-5">
                        <label for="username">Kullanıcı Adı</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                    </div>
                    <div class="form-group mb-5">
                        <label for="name">Ad</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group mb-5">
                    <label for="roles">Roller</label>
                    <select class="select2 form-select" id="roles" name="roles[]" multiple>
                        @foreach($fullroles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-5">
                    <label for="permissions">İzinler</label>
                    <select class="select2 form-select" id="permissions" name="permissions[]" multiple>
                        @foreach($fullpermissions as $permission)
                            <option value="{{ $permission->name }}" {{ $user->can($permission->name) ? 'selected' : '' }}>{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="submit"  class="btn btn-primary" onclick="document.getElementById('editUserForm').submit();">Kaydet</button>
                </div>
            </form>
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
            $('#editUserModal').modal('hide'); // Modalı kapat
        } else {
            Swal.fire({
                title: 'Hata!',
                text: data.message,
                icon: 'error',
            });
        }
    })
    .catch(error => {
        console.error('Hata:', error); // Hata mesajını konsola yaz
        Swal.fire({
            title: 'Hata!',
            text: 'Bir hata oluştu, lütfen tekrar deneyin.',
            icon: 'error',
        });
    });
});

</script>