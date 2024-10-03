@extends('layouts/layoutMaster')

@section('title', 'Kanban - Apps')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',

  'resources/assets/vendor/libs/jkanban/jkanban.scss',
  'resources/assets/vendor/libs/select2/select2.scss',
  'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
  'resources/assets/vendor/libs/quill/typography.scss',
  'resources/assets/vendor/libs/quill/katex.scss',
  'resources/assets/vendor/libs/quill/editor.scss',
  'resources/assets/vendor/libs/toastr/toastr.scss',
  'resources/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.scss',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/app-kanban.scss',
  'resources/assets/vendor/scss/pages/app-chat.scss'

  ])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/moment/moment.js',
  'resources/assets/vendor/libs/flatpickr/flatpickr.js',
  'resources/assets/vendor/libs/select2/select2.js',
  'resources/assets/vendor/libs/jkanban/jkanban.js',
  'resources/assets/vendor/libs/quill/katex.js',
  'resources/assets/vendor/libs/quill/quill.js',
  'resources/assets/vendor/libs/toastr/toastr.js',
  'resources/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

@section('page-script')
@vite([

  'resources/assets/js/app-kanban.js',
  'resources/assets/js/app-chat.js',
  'resources/assets/js/extended-ui-sweetalert2.js'

])
@endsection

@section('content')
<div class="app-kanban">
  <!-- Add new board -->
  <div class="row">
    <div class="col-12">
      <form class="kanban-add-new-board">
        <label class="kanban-add-board-btn" for="kanban-add-board-input">
          <i class="ri-add-line"></i>
          <span class="align-middle">Add new</span>

                 </label>
        <input type="text" class="form-control w-px-250 kanban-add-board-input mb-4 d-none" placeholder="Add Board Title" id="kanban-add-board-input" required />
        <div class="mb-4 kanban-add-board-input d-none">
          <button class="btn btn-primary btn-sm me-3">Add</button>
          <button type="button" class="btn btn-outline-secondary btn-sm kanban-add-board-cancel-btn">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Kanban Wrapper -->
  <div class="kanban-wrapper"></div>

  <!-- Edit Task/Task & Activities -->
  <div class="offcanvas offcanvas-end kanban-update-item-sidebar">
    <div class="offcanvas-header border-bottom">
      <h5 class="offcanvas-title">Edit Task</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body pt-2">
      <ul class="nav nav-tabs mb-2 border-bottom">
        <li class="nav-item">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-update">
            <i class="ri-edit-box-line me-1_5"></i>
            <span class="align-middle">Edit</span>
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-comments">
          <i class="ri-chat-3-line me-1_5"></i>
          <span class="align-middle">Comments</span>
          </button>
        </li>
        <!--
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-activity">
            <i class="ri-pie-chart-line me-1_5"></i>
            <span class="align-middle">Activity</span>
          </button>
        </li>
-->

      </ul>
      <div class="tab-content px-0 pb-0 pt-4">
        <!-- Update item/tasks -->
        <div class="tab-pane fade show active task-edit-modal" id="tab-update" role="tabpanel">
          <form>
          <input type="hidden" id="taskId" name="task_id" value="">
            <div class="form-floating form-floating-outline mb-5">
              <input type="text" id="title" class="form-control" placeholder="Enter Title" />
              <label for="title">Title</label>
            </div>


            <div class="form-floating form-floating-outline mb-5">
  <input type="text" class="form-control flatpickr-input active" placeholder="YYYY-MM-DD HH:MM" id="due-date" name="due_date" readonly="readonly">
  <label for="due-date">Due Date</label>
</div>



<div class="form-floating form-floating-outline mb-5">
              <input type="text" id="label" class="form-control" placeholder="Enter Label" />
              <label for="label">Label</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
                <input type="text" id="description" class="form-control" placeholder="Enter Description" />
                <label for="description">Description</label>
              </div>
            <div class="mb-5 assigned-users-input">
              <label class="form-label">Assigned</label>
              <div class="assigned d-flex flex-wrap"></div>
            </div>

            <!--
            <div class="mb-5">
              <label class="form-label">Comment</label>
              <div class="comment-editor"></div>
              <div class="d-flex justify-content-end">
                <div class="comment-toolbar">
                  <span class="ql-formats me-0">
                    <button class="ql-bold"></button>
                    <button class="ql-italic"></button>
                    <button class="ql-underline"></button>
                    <button class="ql-link"></button>
                    <button class="ql-image"></button>
                  </span>
                </div>
              </div>
            </div>
-->
            <div class="mb-5">
              <div class="d-flex flex-wrap">
                <button type="button" class="btn btn-primary me-4"  id="updateTaskBtn" data-bs-dismiss="offcanvas">
                  Update
                </button>
              </div>
            </div>
          </form>
        </div>
        <!-- Activities -->

        
<!--
        <div class="tab-pane fade" id="tab-activity" role="tabpanel">
          <div class="media mb-4 d-flex align-items-center">
            <div class="avatar me-3 flex-shrink-0">
              <span class="avatar-initial bg-label-success rounded-circle">HJ</span>
            </div>
            <div class="media-body ms-1">
              <p class="mb-0">Jordan Left the board.</p>
              <small class="text-muted">Today 11:00 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-center">
            <div class="avatar me-3 flex-shrink-0">
              <img src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar" class="rounded-circle" />
            </div>
            <div class="media-body ms-1">
              <p class="mb-0">Dianna mentioned <span class="text-primary">@bruce</span> in a comment.</p>
              <small class="text-muted">Today 10:20 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-center">
            <div class="avatar me-3 flex-shrink-0">
              <img src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar" class="rounded-circle" />
            </div>
            <div class="media-body ms-1">
              <p class="mb-0">Martian added mopd
                Charts & Maps task to the done board.</p>
              <small class="text-muted">Today 10:00 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-center">
            <div class="avatar me-3 flex-shrink-0">
              <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle" />
            </div>
            <div class="media-body ms-1">
              <p class="mb-0">Barry Commented on pp
                review task.</p>
              <small class="text-muted">Today 8:32 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-center">
            <div class="avatar me-3 flex-shrink-0">
              <span class="avatar-initial bg-label-dark rounded-circle">BW</span>
            </div>
            <div class="media-body ms-1">
              <p class="mb-0">Bruce was assigpd
                task of code review.</p>
              <small class="text-muted">Today 8:30 PM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-center">
            <div class="avatar me-3 flex-shrink-0">
              <span class="avatar-initial bg-label-danger rounded-circle">CK</span>
            </div>
            <div class="media-body ms-1">
              <p class="mb-0">Clark assigned taskpX
                Research to <span class="text-primary">@martian</span></p>
              <small class="text-muted">Today 8:00 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-center">
            <div class="avatar me-3 flex-shrink-0">
              <img src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar" class="rounded-circle" />
            </div>
            <div class="media-body ms-1">
              <p class="mb-0">Ray Added m
              opd
                <span class="text-heading">Forms & Tables</span> task
                from in progress to done.</p>
              <small class="text-muted">Today 7:45 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-center">
            <div class="avatar me-3 flex-shrink-0">
              <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle" />
            </div>
            <div class="media-body ms-1">
              <p class="mb-0">Barry Complete all pe
                tasks assigned to him.</p>
              <small class="text-muted">Today 7:17 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-center">
            <div class="avatar me-3 flex-shrink-0">
              <span class="avatar-initial bg-label-success rounded-circle">HJ</span>
            </div>
            <div class="media-body ms-1">
              <p class="mb-0">Jordan added taskpo
                update new images.</p>
              <small class="text-muted">Today 7:00 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-center">
            <div class="avatar me-3 flex-shrink-0">
              <img src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar" class="rounded-circle" />
            </div>
            <div class="media-body ms-1">
              <p class="mb-0">Dianna mo
              ved tpk
                <span class="fw-medium text-heading">FAQ UX</span> from in
                progress to done board.</p>
              <small class="text-muted">Today 7:00 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-center">
            <div class="avatar me-3 flex-shrink-0">
              <span class="avatar-initial bg-label-danger rounded-circle">CK</span>
            </div>
            <div class="media-body ms-1">
              <p class="mb-0">Clark added new bopd
                with name <span class="fw-medium text-heading">Done</span></p>
              <small class="text-muted">Yesterday 3:00 PM</small>
            </div>
          </div>
          <div class="media d-flex align-items-center">
            <div class="avatar me-3 flex-shrink-0">
              <span class="avatar-initial bg-label-dark rounded-circle">BW</span>
            </div>
            <div class="media-body ms-1">
              <p class="mb-0">Bruce added new tpk
                in progress board.</p>
              <small class="text-muted">Yesterday 12:00 PM</small>
            </div>
          </div>
        </div>
-->



<!-- YORUMLAR -->
<div class="tab-pane fade text-heading" id="tab-comments" role="tabpanel">
    <ul class="list-unstyled chat-history" id="chat-history">
    </ul>

    <!-- Yorum ekleme formu -->
    <form id="comment-form" action="/kanban/addcomment" method="POST">
        <div class="input-group">
            <input type="hidden" id="task_id_comment_add" value=""></input>
            <input type="text" id="commentInput" class="form-control" placeholder="Yorumunuzu yazın...">
            <button class="btn btn-primary" id="sendCommentBtn" type="button">Gönder</button>
       </div>
    </form>
</div>

  <!-- Other details Modal-->
<div class="modal fade modal-xl" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailsModalLabel">Other Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table id="detailsTable" class="table table-bordered">
          <thead>
            <tr>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>


<script>
    window.Laravel = {
        csrfToken: '{{ csrf_token() }}',
        userId: '{{ auth()->id() }}',
    };
</script>

<div id="user-data" data-user-id="{{ auth()->id() }}"></div>
      <!-- COMMENTS ENDDDDD -->


    </div>
  </div>
</div>


<!-- Add User Assign Modal -->
<div class="modal fade" id="AddUserAsign" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-add-user-asign">
    <div class="modal-content">
      <div class="modal-body p-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="mb-2">Tag Users</h4>
          <p class="mb-6"></p>
        </div>
        <form id="AddUserAsignModal" class="row g-5" action="{{ route('kanban.assignUsers') }}" method="POST">
          @csrf
          <input type="hidden" id="taskIdAsign" name="task_id" value="">

          <div class="col-12">
            <div class="form-floating form-floating-outline">
              <select id="assignedUsers" name="assigned_users[]" class="select2 form-select" multiple>
                @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
              </select>
              <label for="assignedUsers">Select Users</label>
            </div>
          </div>

          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-3">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
   </div>
    </div>
  </div>
</div>
<!--/ Add User Assign Modal -->

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('AddUserAsign');

    modal.addEventListener('show.bs.modal', function (event) {
      const taskId = document.getElementById('taskIdAsign').value;

      fetch(`/kanban/gettask/${taskId}`)
        .then(response => response.json())
        .then(data => {
          var assignedUserIds = data.assigned_users.map(user => user.id);
          
          var selectElement = document.getElementById('assignedUsers');
          
          Array.from(selectElement.options).forEach(option => {
            if (assignedUserIds.includes(parseInt(option.value))) {
              option.selected = true;
            } else {
              option.selected = false;
            }
          });

          $('#assignedUsers').trigger('change');
        })
        .catch(error => console.error('Error fetching task data:', error));
    });
  });
</script>
<script>
    window.alert = function () { };
</script>



@endsection
