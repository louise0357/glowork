@extends('layouts/layoutMaster')

@section('title', 'Accordion - UI elements')
@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/toastr/toastr.scss',
    'resources/assets/vendor/libs/animate-css/animate.scss',
    'resources/assets/vendor/libs/select2/select2.scss',
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss'

])
@endsection
<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/toastr/toastr.js',
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js'

])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite([
    'resources/assets/js/tables-datatables-template.js',
    'resources/assets/js/ui-toasts.js',
    'resources/assets/js/forms-selects.js',
    'resources/assets/js/forms-tagify.js',
    'resources/assets/js/forms-typeahead.js',
    'resources/assets/js/extended-ui-sweetalert2.js'

])
@endsection

@section('content')
<script>
    window.alert = function () { };
</script>

<div id="routes" data-my-endpoint="{{ route('tablobirendp') }}" data-table-id="{{ $table->id }}"></div>
<div class="card">
    <h5 class="card-header">{{ $table->name }}</h5>
    <div class="card-datatable text-nowrap">
        <table class="dt-scrollableTable table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    @foreach ($columns as $column)
                        <th>{{ $column->name }}</th>
                    @endforeach
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- CORUMLU BETMEN ROW EDITTT!!! -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Edit Row</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 h-100">
            <form class="add-new-user pt-0" id="addNewUserForm" action="/update-cell-content" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="row-id" name="row_id">
                <input type="hidden" id="table-id" name="table_id">
                @foreach ($columns as $column)
                            <div class="form-floating form-floating-outline mb-5">
                                @if ($column->type === 'calls')
                                                <select name="calls_{{ $column->id }}[]" class="select2 form-select"
                                                    id="inputGroupSelect02-{{ $column->id }}" placeholder="{{ $column->name }}"
                                                    aria-describedby="button-addon2" multiple>
                                                    @foreach($calls as $call)
                                                        <option value="{{ $call->call_id }}">{{ $call->call_id }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="inputGroupSelect02-{{ $column->id }}">{{ $column->name }}</label>
                                                <small class="mb-2">
                                                    <a href="javascript:void(0);" class="fetchDetailsBtn" data-column-id="{{ $column->id }}"
                                                        data-bs-toggle="modal" data-bs-target="#AramaDetay">
                                                        Seçili aramaların detaylarını görmek için tıklayınız!
                                                    </a>
                                                </small>

                                                <!-- Modal -->
                                                <div class="modal fade modal-xl" id="AramaDetay" tabindex="-1" aria-labelledby="AramaDetayLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="AramaDetayLabel">Arama Detayları</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-bordered" id="callDetailsTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Arama ID</th>
                                                                            <th>Arayan No</th>
                                                                            <th>Aranan No</th>
                                                                            <th>Başlangıç Zamanı</th>
                                                                            <th>Bitiş Zamanı</th>
                                                                            <th>Arama Süresi</th>
                                                                            <th>Özet</th>
                                                                            <th>Durum</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Kapat</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function () {
                                                        const fetchDetailLinks = document.querySelectorAll('.fetchDetailsBtn');

                                                        fetchDetailLinks.forEach(function (fetchDetailsBtn) {
                                                            fetchDetailsBtn.addEventListener('click', function (event) {
                                                                event.preventDefault();

                                                                const columnId = this.getAttribute('data-column-id');
                                                                const selectElement = document.querySelector(`select[name="calls_${columnId}[]"]`);

                                                                const selectedCalls = Array.from(selectElement.options).filter(option => option.selected).map(option => option.value);

                                                                if (selectedCalls.length === 0) {
                                                                    toastr.warning('Lütfen en az bir arama seçin!');
                                                                    return;
                                                                }

                                                                fetch('/api/call-details', {
                                                                    method: 'POST',
                                                                    headers: {
                                                                        'Content-Type': 'application/json',
                                                                        'X-CSRF-TOKEN': window.csrfToken
                                                                    },
                                                                    body: JSON.stringify({
                                                                        call_ids: selectedCalls
                                                                    })
                                                                })
                                                                    .then(response => response.json())
                                                                    .then(data => {
                                                                        if (data.success) {
                                                                            const tableBody = document.querySelector('#callDetailsTable tbody');
                                                                            tableBody.innerHTML = '';

                                                                            data.details.forEach(detail => {
                                                                                const row = document.createElement('tr');
                                                                                row.innerHTML = `
                                        <td>${detail.call_id}</td>
                                        <td>${detail.caller_no}</td>
                                        <td>${detail.called_no}</td>
                                        <td>${detail.call_start_time}</td>
                                        <td>${detail.call_end_time}</td>
                                        <td>${detail.call_duration}</td>
                                        <td>${detail.call_summary ? detail.call_summary : 'Yok'}</td>
                                        <td>${detail.resolution_status}</td>
                                    `;
                                                                                tableBody.appendChild(row);
                                                                            });


                                                                            $('#callDetailsTable').DataTable({
                                                                                scrollY: '300px',
                                                                                scrollCollapse: true,
                                                                                paging: true
                                                                            });

                                                                            toastr.success('Detaylar başarıyla yüklendi!');
                                                                        } else {
                                                                            toastr.error('Detaylar yüklenemedi!');
                                                                        }

                                                                    })
                                                                    .catch(error => {
                                                                        toastr.error('Bir hata oluştu!');
                                                                        console.error(error);
                                                                    });
                                                            });
                                                        });
                                                    });
                                                </script>


                                @elseif ($column->type === 'text')

                                    <!-- STATUS DEĞİL VE NORMAL TEXT İNPUTU İSE -->
                                    <input type="text" class="form-control"
                                        id="add-{{ \Illuminate\Support\Str::slug($column->name, '-') }}"
                                        placeholder="{{ $column->name }}" name="column_{{ $column->id }}"
                                        data-column-id="{{ $column->id }}" aria-label="{{ $column->name }}" />
                                    <label for="add-{{ \Illuminate\Support\Str::slug($column->name, '-') }}">{{ $column->name }}</label>

                                @elseif ($column->type === 'status')

                                    <input type="hidden" name="status_columns[]" value="{{ $column->id }}">
                                    <select name="status_ids_{{ $column->id }}[]" class="select2 form-select"
                                        id="select2Primary-{{ $column->id }}" multiple>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->status }}</option>
                                        @endforeach
                                    </select>
                                    <label for="select2Primary-{{ $column->id }}">{{ $column->name }}</label>
                                    <small class="mb-2"><a href="javascript:0;" data-bs-toggle="modal"
                                            data-bs-target="#onboardHorizontalImageModal">Tablonuza özel status oluşturmak için
                                            tıklayın!</a></small>

                                @elseif ($column->type === 'assigned')
                                    <input type="hidden" name="assigned_columns[]" value="{{ $column->id }}">
                                    <select name="assigned_ids_{{ $column->id }}[]" class="select2 form-select"
                                        id="select2Primary-{{ $column->id }}" multiple>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="select2Primary-{{ $column->id }}">{{ $column->name }}</label>



                                @elseif ($column->type === 'datetime')

                                    <input type="text" class="form-control flatpickr-input active" placeholder="YYYY-MM-DD HH:MM"
                                        id="due-date_{{ $column->id }}" name="column_{{ $column->id }}"
                                        data-column-id="{{ $column->id }}" readonly="readonly">
                                    <label for="due-date_{{ $column->id }}">{{ $column->name }}</label>

                                @endif
                            </div>
                @endforeach


                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="offcanvas">Cancel</button>
            </form>
        </div>
    </div>



    <!-- Sabit Yatay Çubuk -->
<div id="action-bar" class="action-bar bg-primary text-white d-none">
    <div class="container-fluid py-1 d-flex justify-content-end align-items-center flex-wrap">
        <div class="form-group mb-2 me-2">
            <select id="main-category-selectt" class="form-select text-dark">
                <option value="">Ana kategori seçin</option>
            </select>
        </div>
        <div class="form-group mb-2 me-2">
            <select id="sub-category-selectt" class="form-select text-dark" disabled>
                <option value="">Alt kategori seçin</option>
            </select>
        </div>
        <div class="form-group mb-2 me-2">
            <select id="kanban-list-selectt" class="form-select text-dark" disabled>
                <option value="">Kanban List'i seçin</option>
            </select>
        </div>
        <button id="action-submit" class="btn btn-light text-primary me-10">Send To Kanban</button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const mainCategorySelect = document.getElementById('main-category-selectt');
    const subCategorySelect = document.getElementById('sub-category-selectt');

    // Sayfa yüklendiğinde ana kategorileri yükle
    loadMainCategories();

    // Ana kategori seçildiğinde alt kategorileri yükle
    mainCategorySelect.addEventListener('change', handleMainCategoryChange);

    /**
     * Ana kategorileri yükleme işlemi
     */
    function loadMainCategories() {
        resetSelect(mainCategorySelect, 'Ana kategori seçin');
        resetSelect(subCategorySelect, 'Alt kategori seçin', true);

        fetchData('/api/main-categories/kanban')
            .then(data => {
                console.log('Ana Kategoriler:', data); // Gelen veriyi kontrol edelim
                populateSelect(mainCategorySelect, data);
            })
            .catch(error => console.error('Ana kategoriler yüklenirken hata oluştu:', error));
    }

    /**
     * Ana kategori değiştiğinde alt kategorileri yükle
     */
    function handleMainCategoryChange() {
        const mainCategoryId = this.value;
        console.log(`Seçilen Ana Kategori ID: ${mainCategoryId}`);

        resetSelect(subCategorySelect, 'Alt kategori seçin', true);

        if (mainCategoryId) {
            fetchData(`/api/getsubs/kanban/${mainCategoryId}`)
                .then(data => {
                    console.log('Alt Kategoriler:', data); // Alt kategorileri kontrol edelim
                    populateSelect(subCategorySelect, data);
                })
                .catch(error => console.error('Alt kategoriler yüklenirken hata oluştu:', error));
        }
    }

    /**
     * Fetch API ile veri çekme işlemi
     * @param {string} url - İstek yapılacak URL
     * @returns {Promise<any>} - JSON formatında veri döndürür
     */
    function fetchData(url) {
        return fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ağ hatası: ' + response.status);
                }
                return response.json();
            });
    }

    /**
     * Seçim kutusunu sıfırlama işlemi
     * @param {HTMLSelectElement} selectElement - Seçim kutusu elementi
     * @param {string} defaultText - Varsayılan metin
     * @param {boolean} [disable=false] - Seçim kutusunu devre dışı bırak
     */
    function resetSelect(selectElement, defaultText, disable = false) {
        selectElement.innerHTML = `<option value="" disabled selected>${defaultText}</option>`;
        selectElement.disabled = disable;
    }

    /**
     * Gelen verileri seçim kutusuna ekleme işlemi
     * @param {HTMLSelectElement} selectElement - Seçim kutusu elementi
     * @param {Array} data - Gelen veri dizisi
     */
    function populateSelect(selectElement, data) {
        if (data.length === 0) {
            console.warn('Seçenekler bulunamadı.');
            return;
        }

        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name;
            selectElement.appendChild(option);
        });

        selectElement.disabled = false;
    }

    document.getElementById('sub-category-selectt').addEventListener('change', function() {
    const selectedSecondId = this.value;
    const thirdSelect = document.getElementById('kanban-list-selectt');

    thirdSelect.innerHTML = '<option value="" selected disabled>Yükleniyor...</option>';

    fetch(`/api/getkanbanlists/kanban/${selectedSecondId}`)
        .then(response => response.json())
        .then(data => {
            thirdSelect.innerHTML = "<option value='' selected disabled>Kanban List'i Seçin</option>";
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.name;
                thirdSelect.appendChild(option);
            });
            thirdSelect.disabled = false;
        })
        .catch(error => {
            console.error('Error fetching third select options:', error);
        });
});

});

</script>

<style>
.action-bar {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1050;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.15);
}

.container-fluid {
    max-width: 1200px;
    margin: auto;
    padding: 0 10px;
}

#action-bar .form-select {
    width: 200px;
}

#action-bar button {
    width: 120px;
}

@media (max-width: 768px) {
    #action-bar .form-select {
        width: auto;
        flex: 1;
    }

    #action-bar button {
        width: auto;
    }

    .container-fluid {
        flex-direction: column;
        align-items: flex-end;
    }
}
</style>

    <!-- CORUMLLU BETMENN ROW EDIT FINISHHH!?!?!?! -->


    <div class="modal fade" id="fileUploadModal" tabindex="-1" aria-labelledby="fileUploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fileUploadModalLabel">Upload File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="uploadFileForm" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="table_row_id" id="row-id" value="">

                        <div class="mb-3">
                            <label for="filePath" class="form-label">File</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- YORUM EKLEME -->

    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel">Add Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="commentForm" method="POST" action="{{ route('comments.store') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="comment-row-id" name="table_rows_id">
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Yorum Görünüm -->
    <div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentsModalLabel">Comments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="comments-container">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-onboarding modal fade animate__animated" id="onboardHorizontalImageModal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content text-center">
                <div class="modal-header border-0">
                    <a class="text-muted close-label" href="javascript:void(0);" data-bs-dismiss="modal">Skip Intro</a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body onboarding-horizontal p-0">
                    <div class="onboarding-media">
                        <img src="" alt="boy-verify-email-light" width="273" class="img-fluid"
                            data-app-light-img="illustrations/boy-verify-email-light.png"
                            data-app-dark-img="illustrations/boy-verify-email-dark.png">
                    </div>
                    <div class="onboarding-content mb-0">
                        <h5 class="onboarding-title text-body">Status Ekleme Formu</h5>
                        <div class="onboarding-info">Aşağıdan Tablonuza özel oluşturacağınız Status'unuzun rengini ve
                            ismini seçiniz.</div>
                        <form id="statusForm" method="POST" action="{{ route('tables.addstatus') }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="hidden" value="{{ $table->id }}" name="table_id_st"
                                            id="table_id_st"></input>
                                        <input class="form-control" placeholder="Örn: Beklemede" type="text" value=""
                                            tabindex="0" id="nameEx7">
                                        <label for="nameEx7">Status İsmi</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating form-floating-outline mb-4">
                                        <select class="form-select" tabindex="0" id="roleEx7">
                                            <option>Yeşil</option>
                                            <option>Kırmızı</option>
                                            <option>Mor</option>
                                            <option>Gri</option>
                                            <option>Turuncu</option>
                                            <option>Mavi</option>
                                            <option>Siyah</option>

                                        </select>
                                        <label for="roleEx7">Status Rengi</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary status-form-submit">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- YORUM EKLEME FINISH -->
    @include('_partials/_modals/row-add')
    @include('_partials/_modals/column-add')
    <script>
        window.csrfToken = '{{ csrf_token() }}';
        window.fileDeleteRoute = '{{ route('file.delete') }}';
    </script>

    @endsection