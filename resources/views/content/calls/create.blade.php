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
  'resources/assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/call_table.js'])
@endsection

@section('content')
<!-- Scrollable -->
<div class="container">
    <h1>Add New Call</h1>
    
    <form action="{{ route('calls.store') }}" method="POST">
        @csrf
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
                <input type="text" class="form-control" id="resolution_status" name="resolution_status" required>
            </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
