@extends('layouts/layoutMaster')

@section('title', 'DataTables - Tables')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-select-bs5/select.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss',
  'resources/assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.scss',
  'resources/assets/vendor/libs/rateyo/rateyo.scss',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'

])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/rateyo/rateyo.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'

    ])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite([
    'resources/assets/js/call_table.js',
    'resources/assets/js/extended-ui-sweetalert2.js'
    ])
@endsection

@section('content')
<!-- Scrollable -->
<script>
    window.alert = function() {
};
</script>
<div class="card">
  <h5 class="card-header">Call Center Table</h5>
  
  <div class="card-datatable text-nowrap">
    <table class="dt-scrollableTable table table-bordered">
    <thead>
            <tr>
                <th class="add-row"></th>
                <th>Call ID</th>
                <th>Caller No</th>
                <th>Caller Name</th>
                <th>Called No</th>
                <th>Called Name</th>
                <th>Representative ID</th>
                <th>Call Start Time</th>
                <th>Call End Time</th>
                <th>Call Duration</th>
                <th>Call Type</th>
                <th>Call Reason</th>
                <th>Call Notes</th>
                <th>Personel Evaluation</th>
                <th>Resolution Status</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
  </div>
</div>
<!--/ Scrollable -->



<!-- ROW EDİT MODALL BABYY -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Edit Row</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
        <form class="add-new-user pt-0" id="addNewUserForm" action="/update-call-content" method="POST" enctype="multipart/form-data">
            @csrf    
            <input type="hidden" id="call-id" name="call_id">
            
            <div class="mb-3">
                <label for="caller_no" class="form-label">Caller Number</label>
                <input type="text" class="form-control" id="caller_no" name="caller_no" required>
            </div>

            <div class="mb-3">
                <label for="caller_name" class="form-label">Caller Name</label>
                <input type="text" class="form-control" id="caller_name" name="caller_name" required>
            </div>

            <div class="mb-3">
                <label for="called_no" class="form-label">Called Number</label>
                <input type="text" class="form-control" id="called_no" name="called_no" required>
            </div>

            <div class="mb-3">
                <label for="called_name" class="form-label">Called Name</label>
                <input type="text" class="form-control" id="called_name" name="called_name" required>
            </div>

            <div class="mb-3">
                <label for="representative_id" class="form-label">Representative ID</label>
                <input type="text" class="form-control" id="representative_id" name="representative_id" required>
            </div>

            <div class="mb-3">
                <label for="call_start_time" class="form-label">Call Start Time</label>
                <input type="text" class="form-control" id="call_start_time" name="call_start_time" required>
            </div>

            <div class="mb-3">
                <label for="call_end_time" class="form-label">Call End Time</label>
                <input type="text" class="form-control" id="call_end_time" name="call_end_time" required>
            </div>

            <div class="mb-3">
                <label for="call_duration" class="form-label">Call Duration</label>
                <input type="text" class="form-control" id="call_duration" name="call_duration" required>
            </div>

            <div class="mb-3">
                <label for="call_type" class="form-label">Call Type</label>
                <select id="call_type" name="call_type" class="form-select" aria-label="Select Call Type">
                    <option value='<span class="badge rounded-pill bg-label-info">Gelen</span>'>Gelen</option>
                    <option value='<span class="badge rounded-pill bg-label-primary">Giden</span>'>Giden</option>
                </select>            
            </div>

            <div class="mb-3">
                <label for="call_reason" class="form-label">Call Reason</label>
                <input type="text" class="form-control" id="call_reason" name="call_reason" required>
            </div>

            <div class="mb-3">
                <label for="call_notes" class="form-label">Call Notes</label>
                <input type="text" class="form-control" id="call_notes" name="call_notes" required>
            </div>

            <div class="mb-3">
                <label for="personel_evaluation" class="form-label">Personnel Evaluation</label>
                <select id="personel_evaluation" name="personel_evaluation" class="form-select" aria-label="Select Evaluation">
                <option value='1'>1 Star</option>
                <option value='2'>2 Star</option>            
                <option value='3'>3 Star</option>            
                <option value='4'>4 Star</option>            
                <option value='5'>5 Star</option>            
            </select>
            </div>

            <div class="mb-3">
                <label for="resolution_status" class="form-label">Resolution Status</label>
                <select id="resolution_status" name="resolution_status" class="form-select" aria-label="Select Call Type">
                    <option value='<span class="badge rounded-pill bg-label-success">Olumlu</span>'>Olumlu</option>
                    <option value='<span class="badge rounded-pill bg-label-danger">Olumsuz</span>'>Olumsuz</option>
                    <option value='<span class="badge rounded-pill bg-label-warning">Meşgul</span>'>Meşgul</option>
                    <option value='<span class="badge rounded-pill bg-label-info">Tekrar Aranacak</span>'>Tekrar Aranacak</option>
                    <option value='<span class="badge rounded-pill bg-label-dark">Numara İptal</span>'>Numara İptal</option>
                    <option value='<span class="badge rounded-pill bg-label-primary">Stabil</span>'>Stabil</option>
                </select>

            </div>
            

            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>


<!-- CORUMLU ROW FINISHHHH-->



<!-- CORUMLU ROW ADD BASLANGİCCCCC -->

<div class="offcanvas offcanvas-end" id="add-new-record">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body flex-grow-1">
  <form class="add-new-record pt-0 row g-3" id="form-add-new-record" action="/addNewRecord" method="POST" enctype="multipart/form-data">
  @csrf    
            <input type="hidden" id="call-id" name="call_id">
            
            <div class="mb-3">
                <label for="caller_no" class="form-label">Caller Number</label>
                <input type="text" class="form-control" id="caller_no" name="caller_no" required>
            </div>


            <div class="mb-3">
                <label for="called_no" class="form-label">Called Number</label>
                <input type="text" class="form-control" id="called_no" name="called_no" required>
            </div>

            <div class="mb-3">
                <label for="representative_id" class="form-label">Representative ID</label>
                <input type="text" class="form-control" id="representative_id" name="representative_id" required>
            </div>

            <div class="mb-3">
                <label for="call_start_time" class="form-label">Call Start Time</label>
                <input type="text" class="form-control" id="call_start_time" name="call_start_time" required>
            </div>

            <div class="mb-3">
                <label for="call_end_time" class="form-label">Call End Time</label>
                <input type="text" class="form-control" id="call_end_time" name="call_end_time" required>
            </div>

            <div class="mb-3">
                <label for="call_duration" class="form-label">Call Duration</label>
                <input type="text" class="form-control" id="call_duration" name="call_duration" required>
            </div>

            <div class="mb-3">
                <label for="call_type" class="form-label">Call Type</label>
                <select id="call_type" name="call_type" class="form-select" aria-label="Select Call Type">
                    <option value='<span class="badge rounded-pill bg-label-info">Gelen</span>'>Gelen</option>
                    <option value='<span class="badge rounded-pill bg-label-primary">Giden</span>'>Giden</option>
                </select>            
            </div>

            <div class="mb-3">
                <label for="call_reason" class="form-label">Call Reason</label>
                <input type="text" class="form-control" id="call_reason" name="call_reason" required>
            </div>

            <div class="mb-3">
                <label for="call_notes" class="form-label">Call Notes</label>
                <input type="text" class="form-control" id="call_notes" name="call_notes" required>
            </div>

            <div class="mb-3">
                <label for="personel_evaluation" class="form-label">Personnel Evaluation</label>
                <select id="personel_evaluation" name="personel_evaluation" class="form-select" aria-label="Select Evaluation">
                <option value='1'>1 Star</option>
                <option value='2'>2 Star</option>            
                <option value='3'>3 Star</option>            
                <option value='4'>4 Star</option>            
                <option value='5'>5 Star</option>            
            </select>
            </div>

            <div class="mb-3">
                <label for="resolution_status" class="form-label">Resolution Status</label>
                <select id="resolution_status" name="resolution_status" class="form-select" aria-label="Select Call Type">
                    <option value='<span class="badge rounded-pill bg-label-success">Olumlu</span>'>Olumlu</option>
                    <option value='<span class="badge rounded-pill bg-label-danger">Olumsuz</span>'>Olumsuz</option>
                    <option value='<span class="badge rounded-pill bg-label-warning">Meşgul</span>'>Meşgul</option>
                    <option value='<span class="badge rounded-pill bg-label-info">Tekrar Aranacak</span>'>Tekrar Aranacak</option>
                    <option value='<span class="badge rounded-pill bg-label-dark">Numara İptal</span>'>Numara İptal</option>
                    <option value='<span class="badge rounded-pill bg-label-primary">Stabil</span>'>Stabil</option>

                </select>

            </div>
            
            
            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="offcanvas">Cancel</button>
    </form>

  </div>
</div>


<!-- GAHRAMAN CCCORUMLU LEBLEBBİ ROW ADD FINISHHH -->


@endsection