@extends('layouts/layoutMaster')

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/apex-charts/apex-charts.scss',
  'resources/assets/vendor/libs/toastr/toastr.scss'
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/apex-charts/apexcharts.js',
  'resources/assets/vendor/libs/toastr/toastr.js'
])
@endsection

@section('page-script')
@vite([
  'resources/assets/js/dashboards-analytics.js',
  'resources/assets/js/ui-toasts.js'
])
@endsection

@section('content')
<div class="row gy-6">
  <!-- gratulations card -->
  <div class="col-md-12 col-lg-4">
    <div class="card">
      <div class="card-body text-nowrap">
        <h5 class="card-title mb-0 flex-wrap text-nowrap mb-lg-2">Hoşgeldiniz! 😊</h5>
        <h4 class="text-primary mb-4">
        @if (auth()->check())
        {{ \Illuminate\Support\Facades\Auth::user()->name }}
        @else
        Misafir
        @endif
      
      </h4>
        <!--<p class="mb-2">78% of target 🚀</p>-->
        <div class="badge bg-label-primary rounded-pill mb-xl-1">{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</div>
            </div>
          <div class="h-100 position-relative">
            <img src="{{asset('assets/img/illustrations/illustration-2.png')}}" alt="Ratings" class="position-absolute card-img-position scaleX-n1-rtl bottom-0 w-auto end-0 me-3 me-xl-0 me-xxl-3 pe-2" width="81">
        </div>
    </div>
  </div>
  <!--/ Congratulations card -->

  <!-- Transactions -->
  <div class="col-lg-8">
    <div class="card h-99">
      <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
          @if (auth()->check())
          <h5 class="card-title m-0 me-2">İşte Genel Olarak Sistem İstatistikleriniz!</h5>
          @else
          <h5 class="card-title m-0 me-2">İstatistikler için lütfen giriş yapınız.</h5>
          @endif
        </div>
      </div>
      @if (auth()->check())
      <div class="card-body pt-lg-5">
        <div class="row g-6">
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-success rounded shadow-xs">
                  <i class="ri-group-line ri-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <p class="mb-0">Users</p>
                <h5 class="mb-0">{{ \App\Models\User::count() }}</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-primary rounded shadow-xs">
                  <i class="ri-group-line ri-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <p class="mb-0">Customer</p>
                <h5 class="mb-0">{{ \App\Models\Customer::count() }}</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-warning rounded shadow-xs">
                  <i class="ri-table-line ri-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <p class="mb-0">Tables</p>
                <h5 class="mb-0">{{ \App\Models\Table::count() }}</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-info rounded shadow-xs">
                  <i class="ri-drag-drop-line ri-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <p class="mb-0">Kanban's</p>
                <h5 class="mb-0">{{ \App\Models\KanbanBoard::count() }}</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      @else
      <p class="text-center"> İstatistikler için lütfen giriş yapınız.</p>
      @endif
    </div>
  </div>

  <!--/ Transactions -->

  <!-- Bildirimler aga onemli -->
  <div class="col-xxl-4 col-md-6">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        @if (auth()->check())
        <h5 class="card-title m-0 me-2">User Notifications</h5>
        @else 
        <h5 class="card-title m-0 me-2">İstatistikler için lütfen giriş yapınız.</h5>
        @endif
        @if (auth()->check())
        <div class="dropdown">
          <button class="btn text-muted p-0" type="button" id="userNotifications" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="ri-more-2-line ri-24px"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userNotifications">
            <a class="dropdown-item" href="javascript:void(0);" id="mark-all-read">Mark all as read</a>
            <a class="dropdown-item" href="javascript:void(0);">View all notifications</a>
          </div>
          <script>
            document.getElementById('mark-all-read').onclick = function (event) {
              event.preventDefault();

              fetch('{{ route("notifications.markAllAsRead") }}', {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Content-Type': 'application/json'
                }
              })
                .then(response => {
                  if (response.ok) {
                    toastr.success('Bildirimler Başarıyla Okundu Olarak İşaretlendi!');
                    setTimeout(() => {
                  location.reload();
                    }, 2000);
                  }
                })
                .catch(error => console.error('Error:', error));
            };
          </script>
        </div>
               @endif
      </div>
      <div class="card-body">
        <ul class="p-0 m-0">
        @if (auth()->check())
          @if (auth()->user()->unreadNotifications->isEmpty())
          
              <figure class="text-center mt-2">
              <blockquote class="blockquote">
                <p class="mb-0">Okunmamış bildiriminiz bulunmamaktadır.</p>
              </blockquote>
            </figure>
              @else
          @foreach (auth()->user()->unreadNotifications->take(6) as $notification)
        <li class="d-flex mb-4 pb-2">
        <div class="avatar flex-shrink-0 me-4">
          <span class="avatar-initial rounded-circle bg-label-success">
          <i class="ri-notification-3-line"></i>
          </span>
        </div>
        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
          <div class="me-2">
          <h6 class="mb-0">{{ $notification->data['message'] }}</h6>
          <small class="d-flex align-items-center">
            <i class="ri-calendar-line ri-14px"></i>
            <span class="ms-2">{{ $notification->created_at->diffForHumans() }}</span>
          </small>
          </div>
        </div>
        </li>
      @endforeach
      @endif
      @else
      <p class="text-center">İstatistikler için lütfen giriş yapınız. </p>
      @endif
        </ul>
      </div>
    </div>
  </div>

  <!--/ Bildirimler bitis -->






<!-- Tablolar -->
@php
    $tables = Illuminate\Support\Facades\DB::table('tables')->get();
@endphp

<div class="col-12 col-md-6 col-xxl-4">
    <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2">Tablolar</h5>
        </div>
        <div class="card-body">
            @if(auth()->check())
                <ul class="p-0 m-0">
                    @foreach($tables as $table)
                        @if(auth()->user()->hasRole('admin') || auth()->user()->can($table->name))
                            @php
                                $rowCount = Illuminate\Support\Facades\DB::table('table_rows')->where('table_id', $table->id)->count();
                            @endphp
                            <li class="d-flex mb-6">
                                <div class="chart-progress me-4"></div>
                                <div class="row w-100 align-items-center">
                                    <div class="col-9">
                                        <div class="me-2">
                                            <h6 class="mb-2">
                                                <i class="ri-corner-down-right-line ri-12px"></i> {{ $table->name }}
                                            </h6>
                                            <p class="mb-0">{{ $rowCount }} Satır</p>
                                        </div>
                                    </div>
                                    <div class="col-3 text-end">
                                        <a href="/tables/{{ $table->id }}">
                                            <button type="button" class="btn btn-sm btn-icon bg-label-secondary">
                                                <i class="ri-arrow-right-s-line ri-20px scaleX-n1-rtl"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @else
                <p class="text-center">İstatistikler için lütfen giriş yapınız.</p>
            @endif
        </div>
    </div>
</div>
<!--/ Tablolar -->



<!-- Kanbanlar -->
@php
    $kanbans = Illuminate\Support\Facades\DB::table('kanban_boards')->get();
@endphp

<div class="col-12 col-md-6 col-xxl-4">
    <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2">Kanbanlar</h5>
        </div>
        <div class="card-body">
            @if(auth()->check())
                <ul class="p-0 m-0">
                    @foreach($kanbans as $kanban)
                        @if(auth()->user()->hasRole('admin') || auth()->user()->can($kanban->name))
                            @php
                                $listIds = Illuminate\Support\Facades\DB::table('kanban_lists')
                                    ->where('board_id', $kanban->id)
                                    ->pluck('id');

                                $listCount = Illuminate\Support\Facades\DB::table('kanban_lists')
                                    ->where('board_id', $kanban->id)
                                    ->count();

                                $taskCount = Illuminate\Support\Facades\DB::table('kanban_tasks')
                                    ->whereIn('list_id', $listIds)
                                    ->count();
                            @endphp
                            <li class="d-flex mb-6">
                                <div class="chart-progress me-4"></div>
                                <div class="row w-100 align-items-center">
                                    <div class="col-9">
                                        <div class="me-2">
                                            <h6 class="mb-2">
                                                <i class="ri-corner-down-right-line ri-12px"></i> 
                                                {{ $kanban->name }}
                                            </h6>
                                            <p class="mb-0">{{ $listCount }} Başlık, {{ $taskCount }} Görev</p>
                                        </div>
                                    </div>
                                    <div class="col-3 text-end">
                                        <a href="/kanban/{{ $kanban->id }}">
                                            <button type="button" class="btn btn-sm btn-icon bg-label-secondary">
                                                <i class="ri-arrow-right-s-line ri-20px scaleX-n1-rtl"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @else
                <p class="text-center">İstatistikler için lütfen giriş yapınız.</p>
            @endif
        </div>
    </div>
</div>
<!--/ Kanbanlar -->

<!-- Kanban Deadline -->
@php
    use Carbon\Carbon;

    $tasks = \App\Models\KanbanTask::where('due_date', '>=', Carbon::now())
            ->where('due_date', '<=', Carbon::now()->addDays(3))
            ->orderBy('due_date', 'asc')
            ->get();
@endphp

<div class="col-12 col-md-6 col-xxl-4">
    <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2">Süresi 3 Günden Az Kalmış Görevler</h5>
        </div>
        <div class="card-body">
            @if(auth()->check())
                <ul class="p-0 m-0">
                    @foreach($tasks as $task)
                        @if(auth()->user()->hasRole('admin'))
                            @php
                $now = Carbon::now();
                $dueDate = Carbon::parse($task->due_date);

                $remainingDays = (int) $now->diffInDays($dueDate); // gün
                $remainingHours = $now->diffInHours($dueDate) % 24; // saat
                $remainingMinutes = $now->diffInMinutes($dueDate) % 60; // dakika

                $message = "";
                
                if ($remainingDays > 1) {
                    $message .= "3 günden az kaldı!";
                } elseif ($remainingDays == 1) {
                    $message .= "1 gün kaldı!";
                } else {
                    $message .= "1 günden az kaldı! ($remainingHours Saat, $remainingMinutes Dakika)";
                }
                            @endphp

                            @if($task->count() > 0)
                                <li class="d-flex mb-6">
                                    <div class="chart-progress me-4"></div>
                                    <div class="row w-100 align-items-center">
                                        <div class="col-9">
                                            <div class="me-2">
                                                <h6 class="mb-2">
                                                    <i class="ri-corner-down-right-line ri-12px"></i> 
                                                    {{ $task->name }}
                                                </h6>
                                                <p class="mb-0">{{$message}}</p>
                                            </div>
                                        </div>
                                        <div class="col-3 text-end">
                                            <a href="/kanban/{{ $task->id }}">
                                                <button type="button" class="btn btn-sm btn-icon bg-label-secondary">
                                                    <i class="ri-arrow-right-s-line ri-20px scaleX-n1-rtl"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            @else
                <p class="text-center">İstatistikler için lütfen giriş yapınız.</p>
            @endif
        </div>
    </div>
</div>
<!--/ Kanban Deadline -->



</div>
@endsection