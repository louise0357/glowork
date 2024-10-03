@php
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Route;
  $configData = Helper::appClasses();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- ! Hide app brand if navbar-full -->
  @if(!isset($navbarFull))
    <div class="app-brand demo">
    <a href="{{url('/')}}" class="app-brand-link">
      <span class="app-brand-logo demo me-1">
      @include('_partials.macros', ["height" => 20])
      </span>
      <span class="app-brand-text demo menu-text fw-semibold ms-2">{{config('variables.templateName')}}</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="menu-toggle-icon d-xl-block align-middle"></i>
    </a>
    </div>
  @endif

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">


    <li class="menu-item ">
      <a href="/" class="menu-link">
        <i class="menu-icon tf-icons ri-home-smile-line"></i>
        <div>Dashboard</div>
      </a>
    </li>
    @role('admin')
    <li class="menu-header mt-7">
      <span class="menu-header-text">Users </span>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle waves-effect">
        <i class="menu-icon tf-icons ri-lock-2-line"></i>
        <div>Roles &amp; Permissions</div>
      </a>


      <ul class="menu-sub">



        <li class="menu-item ">
          <a href="/app/access-roles" class="menu-link">
            <div>Roles</div>
          </a>


        </li>



        <li class="menu-item ">
          <a href="/app/access-permission" class="menu-link">
            <div>Permission</div>
          </a>


        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="/app/user/list" class="menu-link">
        <i class="menu-icon tf-icons ri-user-line"></i>
        <div> Personel List</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="/app/customer/list" class="menu-link">
        <i class="menu-icon tf-icons ri-user-line"></i>
        <div> Customers List</div>
      </a>
    </li>
    @endrole





    <li class="menu-header mt-7">
      <span class="menu-header-text">Call Center </span>
    </li>
    <li class="menu-item">
      <a href="/calls" class="menu-link">
        <i class="menu-icon tf-icons ri-phone-line"></i>
        <div> Calls</div>
      </a>
    </li>


@role('admin')
    <li class="menu-header mt-7">
      <span class="menu-header-text"> Kategoriler Düzen </span>
    </li>
    <li class="menu-item" data-bs-toggle="modal" data-bs-target="#DeleteMainModal">
      <a href="javascript:void(0);" class="menu-link" id="delete-main-category-btn">
      <i class="ri-delete-bin-6-line"></i>
      <div> Delete Main Category</div>
      </a>
    </li>
    <li class="menu-item" data-bs-toggle="modal" data-bs-target="#DeleteSubCategoryModal">
  <a href="javascript:void(0);" class="menu-link" id="delete-sub-category-btn">
    <i class="ri-delete-bin-6-line"></i>
    <div> Delete Subcategory</div>
  </a>
</li>

    <li class="menu-item" data-bs-toggle="modal" data-bs-target="#mainCategoryModal">
      <a href="javascript:void(0);" class="menu-link" id="create-main-category-btn">
      <i class="ri-add-line"></i>
      <div> Create Main Category</div>
      </a>
    </li>

    <li class="menu-item" data-bs-toggle="modal" data-bs-target="#subCategoryModal">
      <a href="javascript:void(0);" class="menu-link" id="create-sub-category-btn">
      <i class="ri-add-line"></i>
      <div> Create Subcategory</div>
      </a>
    </li>
@endrole


    <!-- Kategorilerr kral (rule, kanban, table) -->
    @if (Auth::check())
    <li class="menu-header mt-7">
      <span class="menu-header-text">Kategoriler </span>
    </li>
@php
$allowedRoles = ['admin'];
$hasSpecialRole = auth()->user()->hasAnyRole($allowedRoles);

$groupedCategories = [];
foreach ($categories as $rule) {
    $categoryName = $rule->mainCategory->name ?? 'Diğer';
    $ruleName = $rule->ruleTableSb->name ?? 'Kural Bulunamadı';

    if (!isset($groupedCategories[$categoryName])) {
        $groupedCategories[$categoryName] = [];
    }
    $groupedCategories[$categoryName][] = [
        'rule' => $rule,
        'ruleName' => $ruleName
    ];
}
@endphp
@foreach ($categories as $mainCategory)
    @php
    $hasMainCategoryPermission = auth()->user()->can($mainCategory->name);
    @endphp
    @if ($hasMainCategoryPermission || auth()->user()->hasAnyRole(['admin']))
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon ri-book-2-line"></i>
            <div>{{ $mainCategory->name }}</div> 
        </a>

        <ul class="menu-sub">
            @php
            $displayedTableIds = [];
            @endphp

            @foreach ($mainCategory->rules as $rule)
                @if (!in_array($rule->table_id, $displayedTableIds))
                    @php
                    $displayedTableIds[] = $rule->table_id;
                    @endphp

                    @if ($hasMainCategoryPermission || auth()->user()->can($rule->rule_name) || auth()->user()->hasAnyRole(['admin']))
                    <li class="menu-item">
                        <a href="/ruletable/{{$rule->id}}" class="menu-link">
                            <div>{{ $rule->ruleTableSb->name ?? 'Kural Bulunamadı' }}</div>
                        </a>
                    </li>
                    @endif
                @endif
            @endforeach
        </ul>
    </li>
    @endif
@endforeach



<!-- RULE TABLE KATEGORİ -->
    





    @foreach ($mainCategories as $category)
    @php
    $hasMainCategoryPermission = auth()->user()->can($category->title);

    $hasSubCategoryPermission = false;
    foreach ($category->tables as $table) {
      if (auth()->user()->can($table->name)) {
      $hasSubCategoryPermission = true;
      break;
      }
    }

    $allowedRoles = ['admin'];

    $hasSpecialRole = auth()->user()->hasAnyRole($allowedRoles);

  @endphp
    @if ($hasMainCategoryPermission || $hasSubCategoryPermission || $hasSpecialRole)
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons ri-table-alt-line"></i>
      <div>{{ $category->title }}</div>

      </a>

      <ul class="menu-sub">
      @foreach ($category->tables as $table)
      @if ($hasMainCategoryPermission || auth()->user()->can($table->name) || $hasSpecialRole)
      <li class="menu-item">
      <a href="/tables/{{$table->id}}" class="menu-link">
      <div>{{ $table->name }}</div>
      </a>
      </li>
    @endif
    @endforeach
      </ul>
    </li>
  @endif
  @endforeach


  @endif
    <!-- KANBAN KATEGORİLERİ -->
    @if (Auth::check())

    @foreach ($kanbanCategoriesWithBoards as $categoryData)
    @php
    $hasMainCategoryPermission = auth()->user()->can($categoryData['category']->name);

    $hasBoardPermission = false;
    foreach ($categoryData['boards'] as $board) {
      if (auth()->user()->can($board->name)) {
      $hasBoardPermission = true;
      break;
      }
    }

    $allowedRoles = ['admin'];

    $hasSpecialRole = auth()->user()->hasAnyRole($allowedRoles);

  @endphp

    @if ($hasMainCategoryPermission || $hasBoardPermission || $hasSpecialRole)
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons ri-drag-drop-line"></i>
      <div>{{ $categoryData['category']->name }}</div>
      </a>

      <ul class="menu-sub">
      @foreach ($categoryData['boards'] as $board)
      @if ($hasMainCategoryPermission || auth()->user()->can($board->name) || $hasSpecialRole)
      <li class="menu-item">
      <a href="/boards/{{$board->id}}" class="menu-link">
      <div>{{ $board->name }}</div>
      </a>
      </li>
    @endif
    @endforeach
      </ul>
    </li>
  @endif
  @endforeach

  @endif

    <!-- KANBAN KATEGORİLERİ KODU FINISH -->
  </ul>

</aside>


<!-- DELETE SUB CATEGORY MODAL -->
<!-- Modal -->
<div class="modal fade" id="DeleteSubCategoryModal" tabindex="-1" aria-labelledby="DeleteSubCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DeleteSubCategoryModalLabel">Kategori Seçimi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Kategori Türü</label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category-type" id="type-table" value="table">
                            <label class="form-check-label" for="type-table">Table</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category-type" id="type-kanban" value="kanban">
                            <label class="form-check-label" for="type-kanban">Kanban</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="main-category-select" class="form-label">Ana Kategori</label>
                    <select id="main-category-select" class="form-select" disabled>
                        <option value="" selected disabled>Ana kategori seçin</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="sub-category-select" class="form-label">Alt Kategori</label>
                    <select id="sub-category-select" class="form-select" disabled>
                        <option value="" selected disabled>Alt kategori seçin</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="button" id="submit-button" class="btn btn-danger">Sil</button>
            </div>
        </div>
    </div>
</div>




<!-- Main Category Modal -->
<div class="modal fade" id="mainCategoryModal" tabindex="-1" aria-labelledby="mainCategoryModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mainCategoryModalLabel">Create Main Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="mainCategoryForm">
          @csrf
          <div class="mb-3">
            <label for="mainCategoryName" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="mainCategoryName" name="mainCategoryName" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Category Type</label>
            <div>
              <input type="radio" id="kanbanType" name="categoryType" value="kanban" required>
              <label for="kanbanType">Kanban</label>
            </div>
            <div>
              <input type="radio" id="tableType" name="categoryType" value="table" required>
              <label for="tableType">Table</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Subcategory Modal -->
<div class="modal fade" id="subCategoryModal" tabindex="-1" aria-labelledby="subCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subCategoryModalLabel">Create Subcategory</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="subCategoryForm">
          @csrf
          <div class="mb-3">
            <label for="subCategoryName" class="form-label">Subcategory Name</label>
            <input type="text" class="form-control" id="subCategoryName" name="subCategoryName" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Select Main Category</label>
            <select class="form-select" id="mainCategorySelect" name="mainCategoryId" required>
              <!-- JS gel olum bura -->
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Category Type</label>
            <div>
              <input type="radio" id="subKanbanType" name="subCategoryType" value="kanban" required>
              <label for="subKanbanType">Kanban</label>
            </div>
            <div>
              <input type="radio" id="subTableType" name="subCategoryType" value="table" required>
              <label for="subTableType">Table</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="subCategoriesModal" tabindex="-1" aria-labelledby="subCategoriesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subCategoriesModalLabel">Alt Kategorileri Göster</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="subCategoriesForm">
          @csrf
          <div class="mb-3">
            <label class="form-label">Kategori Türü</label>
            <div>
              <input type="radio" id="subCatKanbanType" name="subCatType" value="kanban" required>
              <label for="subCatKanbanType">Kanban</label>
            </div>
            <div>
              <input type="radio" id="subCatTableType" name="subCatType" value="table" required>
              <label for="subCatTableType">Table</label>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Ana Kategori Seçin</label>
            <select class="form-select" id="subCategoriesMainSelect" name="mainCategoryId" required>
              <!-- Ana kategoriler burada listelenecek -->
            </select>
          </div>
          <button type="button" id="fetchSubCategoriesBtn" class="btn btn-primary">Alt Kategorileri Getir</button>
        </form>
        <div id="subCategoriesList" class="mt-3">
          <h5>Alt Kategoriler:</h5>
          <ul id="subCategoriesUl">
            <!-- Alt kategoriler burada listelenecek -->
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- Delete Main Category Modal -->
<div class="modal fade" id="DeleteMainModal" tabindex="-1" aria-labelledby="DeleteMainModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="DeleteMainModalLabel">Delete Main Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="deleteMainCategoryForm">
          @csrf
          <div class="mb-3">
            <label class="form-label">Select Main Category</label>
            <select class="form-select" id="deleteMainCategorySelect" name="mainCategoryId" required>
              <!-- JS! come here meeennn,, -->
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Category Type</label>
            <div>
              <input type="radio" id="deleteKanbanType" name="categoryType" value="kanban" required>
              <label for="deleteKanbanType">Kanban</label>
            </div>
            <div>
              <input type="radio" id="deleteTableType" name="categoryType" value="table" required>
              <label for="deleteTableType">Table</label>
            </div>
          </div>
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>




<script>
  document.addEventListener('DOMContentLoaded', function () {
    const createSubCategoryBtn = document.querySelector('#create-sub-category-btn');
    const subCategoryModal = new bootstrap.Modal(document.querySelector('#subCategoryModal'));
    const deleteMainCategoryModal = new bootstrap.Modal(document.querySelector('#DeleteMainModal'));
    const subCategoryForm = document.querySelector('#subCategoryForm');
    const deleteMainCategoryForm = document.querySelector('#deleteMainCategoryForm');
    const mainCategorySelect = document.querySelector('#mainCategorySelect');
    const deleteMainCategorySelect = document.querySelector('#deleteMainCategorySelect');
    const subKanbanTypeInput = document.querySelector('#subKanbanType');
    const subTableTypeInput = document.querySelector('#subTableType');
    const deleteKanbanTypeInput = document.querySelector('#deleteKanbanType');
    const deleteTableTypeInput = document.querySelector('#deleteTableType');

    createSubCategoryBtn.addEventListener('click', async () => {
      await updateMainCategorySelectOptions(mainCategorySelect, subKanbanTypeInput, subTableTypeInput);
      subCategoryModal.show();
    });

    async function updateMainCategorySelectOptions(selectElement, kanbanInput, tableInput) {
      selectElement.innerHTML = '';
      if (kanbanInput.checked || tableInput.checked) {
        let url = '';
        if (kanbanInput.checked) {
          url = '/api/main-categories/kanban';
        } else if (tableInput.checked) {
          url = '/api/main-categories/table';
        }
        const response = await fetch(url);
        const categories = await response.json();
        selectElement.innerHTML = categories.map(category =>
          `<option value="${category.id}">${category.name || category.title}</option>`
        ).join('');
      }
    }

    subCategoryForm.addEventListener('submit', async (event) => {
      event.preventDefault();
      const formData = new FormData(subCategoryForm);
      const categoryType = formData.get('subCategoryType');
      const url = `/api/sub-categories/${categoryType}`;
      
      const response = await fetch(url, {
        method: 'POST',
        body: formData
      });

      if (response.ok) {
        toastr.success('Alt kategori başarıyla oluşturuldu');
        subCategoryModal.hide();
      } else {
        toastr.error('Alt kategori oluşturulurken bir hata oluştu');
      }
    });

    [subKanbanTypeInput, subTableTypeInput].forEach(input => {
      input.addEventListener('change', () => {
        updateMainCategorySelectOptions(mainCategorySelect, subKanbanTypeInput, subTableTypeInput);
      });
    });

    [deleteKanbanTypeInput, deleteTableTypeInput].forEach(input => {
      input.addEventListener('change', () => {
        updateMainCategorySelectOptions(deleteMainCategorySelect, deleteKanbanTypeInput, deleteTableTypeInput);
      });
    });

    deleteMainCategoryForm.addEventListener('submit', async (event) => {
      event.preventDefault();
      const formData = new FormData(deleteMainCategoryForm);
      const categoryType = formData.get('categoryType');
      const url = `/api/main-categories/delete/${categoryType}`;

      const response = await fetch(url, {
        method: 'POST',
        body: formData
      });

      if (response.ok) {
        toastr.success('Ana kategori başarıyla silindi');
        deleteMainCategoryModal.hide();
      } else {
        toastr.error('Ana kategori silinirken bir hata oluştu');
      }
    });
  });
</script>

<script>
  document.getElementById('mainCategoryForm').addEventListener('submit', function(e) {
  e.preventDefault();

  let formData = new FormData(this);

  fetch('/api/main-categories/table', {
    method: 'POST',
    body: formData,
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      toastr.success("Ana Kategori başarıyla oluşturuldu!", "Başarılı!");
      $('#mainCategoryModal').modal('hide');
    } else {
      toastr.error("Ana Kategori oluşturulurken bir hata oluştu, lütfen yönetici ile iletişime geçiniz!", "Hata!");
    }
  })
  .catch(error => {
    //console.error('Error:', error);
    toastr.error("Ana Kategori oluşturulurken bir hata oluştu, lütfen yönetici ile iletişime geçiniz!", "Hata!");

  });
});

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeRadios = document.querySelectorAll('input[name="category-type"]');
    const mainCategorySelect = document.getElementById('main-category-select');
    const subCategorySelect = document.getElementById('sub-category-select');
    const submitButton = document.getElementById('submit-button');

    typeRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            const selectedType = this.value;
            fetchMainCategories(selectedType);
        });
    });

    mainCategorySelect.addEventListener('change', function () {
        const selectedType = document.querySelector('input[name="category-type"]:checked').value;
        const mainCategoryId = this.value;
        fetchSubCategories(selectedType, mainCategoryId);
    });

    submitButton.addEventListener('click', function () {
        const selectedSubCategoryId = subCategorySelect.value;
        const selectedType = document.querySelector('input[name="category-type"]:checked').value;
        
        if (selectedType && selectedSubCategoryId) {
            const endpoint = selectedType === 'kanban' ? `/api/sub-categories/delete/kanban` : `/api/sub-categories/delete/table`;

            fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: selectedSubCategoryId })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                alert('Alt kategori başarıyla silindi!');
                toastr.success("Alt kategori başarıyla silindi!", "Başarılı!")
                subCategorySelect.value = '';
                subCategorySelect.innerHTML = '<option value="" selected disabled>Alt kategori seçin</option>';
                subCategorySelect.disabled = true;
            })
            .catch(error => {
                console.error('Error deleting subcategory:', error);
                alert('Bir hata oluştu, lütfen tekrar deneyin.');
            });
        } else {
            alert('Lütfen alt kategori seçin.');
        }
    });

    function fetchMainCategories(type) {
        mainCategorySelect.innerHTML = '<option value="" selected disabled>Ana kategori seçin</option>';
        subCategorySelect.innerHTML = '<option value="" selected disabled>Alt kategori seçin</option>';
        subCategorySelect.disabled = true;

        fetch(`/api/main-categories/${type}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name || category.title;
                    mainCategorySelect.appendChild(option);
                });
                mainCategorySelect.disabled = false;
            })
            .catch(error => console.error('Error fetching main categories:', error));
    }

    function fetchSubCategories(type, mainCategoryId) {
        subCategorySelect.innerHTML = '<option value="" selected disabled>Alt kategori seçin</option>';
        subCategorySelect.disabled = true;

        fetch(`/api/getsubs/${type}/${mainCategoryId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(subCategory => {
                    const option = document.createElement('option');
                    option.value = subCategory.id;
                    option.textContent = subCategory.name || subCategory.title;
                    subCategorySelect.appendChild(option);
                });
                subCategorySelect.disabled = false;
            })
            .catch(error => console.error('Error fetching subcategories:', error));
    }
});
</script>
