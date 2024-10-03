@extends('layouts/layoutMaster')

@section('title', 'Rule Table')

@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/toastr/toastr.scss',
    'resources/assets/vendor/libs/animate-css/animate.scss',
    'resources/assets/vendor/libs/select2/select2.scss',
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/toastr/toastr.js',
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

@section('page-script')
@vite([
    'resources/assets/js/rule_tables.js',
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
<div id="routes"></div>
<div class="card">
    <h5 class="card-header">Rule Table</h5>
    <div class="card-datatable text-nowrap">
        <table class="dt-scrollableTable table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Rule Name</th>
                    <th>Description</th>
                    <th>Creation Date</th>
                    <th>Last Update</th>
                    <th>Type</th>
                    <th>Threat Level</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Conditions</th>
                    <th>Related</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th>Category</th>
                    <th>Tags</th>
                    <th>Applicability</th>
                    <th>Risk Score</th>
                    <th>Test Status</th>
                    <th>Test Date</th>
                    <th>Tested By</th>
                    <th>Alert Level</th>
                    <th>Documentation</th>
                    <th>Related Policies</th>
                    <th>Audit Log</th>
                    <th>Incident Logs</th>
                    <th>Requirements</th>
                    <th>Priority</th>
                    <th>Related Assets</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>

<!-- EDİT ROW BASLANGİCC -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Edit Row</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 h-100">
        <form class="edit-rule-form pt-0" id="editRuleForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="rule-id" name="rule_id">
            <input type="hidden" id="table-id" name="table_id">

            <div class="mb-3">
                <label for="rule_name" class="form-label">Rule Name</label>
                <input type="text" class="form-control" id="rule_name" name="rule_name" required>
            </div>

            <div class="mb-3">
                <label for="rule_description" class="form-label">Rule Description</label>
                <textarea class="form-control" id="rule_description" name="rule_description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="rule_type" class="form-label">Rule Type</label>
                <input type="text" class="form-control" id="rule_type" name="rule_type" required>
            </div>

            <div class="mb-3">
                <label for="rule_threat_level" class="form-label">Threat Level</label>
                <input type="number" class="form-control" id="rule_threat_level" name="rule_threat_level" required>
            </div>

            <div class="mb-3">
                <label for="rule_source" class="form-label">Source</label>
                <input type="text" class="form-control" id="rule_source" name="rule_source" required>
            </div>

            <div class="mb-3">
                <label for="rule_destination" class="form-label">Destination</label>
                <input type="text" class="form-control" id="rule_destination" name="rule_destination" required>
            </div>

            <div class="mb-3">
                <label for="rule_conditions" class="form-label">Conditions</label>
                <textarea class="form-control" id="rule_conditions" name="rule_conditions" required></textarea>
            </div>

            <div class="mb-3">
                <label for="rule_related" class="form-label">Related</label>
                <textarea class="form-control" id="rule_related" name="rule_related" required></textarea>
            </div>

            <div class="mb-3">
                <label for="rule_status" class="form-label">Rule Status</label>
                <select id="rule_status" name="rule_status" class="form-select" required>
                    <option value="Active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="rule_category" class="form-label">Category</label>
                <input type="text" class="form-control" id="rule_category" name="rule_category" required>
            </div>

            <div class="mb-3">
                <label for="rule_tags" class="form-label">Rule Tags</label>
                <input type="text" class="form-control" id="rule_tags" name="rule_tags" required>
            </div>

            
            <div class="mb-3">
                <label for="rule_applicability" class="form-label">Rule Applicability</label>
                <input type="text" class="form-control" id="rule_applicability" name="rule_applicability" required>
            </div>

            <div class="mb-3">
                <label for="rule_risk_score" class="form-label">Risk Score</label>
                <input type="number" class="form-control" id="rule_risk_score" name="rule_risk_score" required>
            </div>

            <div class="mb-3">
                <label for="rule_test_status" class="form-label">Test Status</label>
                <input type="text" class="form-control" id="rule_test_status" name="rule_test_status" required>
            </div>

            
            <div class="mb-3">
                <label for="rule_test_date" class="form-label">Test Date</label>
                <input type="text" class="form-control" id="rule_test_date" name="rule_test_date" required>
            </div>
                        
            <div class="mb-3">
                <label for="rule_tested_by" class="form-label">Tested By</label>
                <input type="text" class="form-control" id="rule_tested_by" name="rule_tested_by" required>
            </div>

            <div class="mb-3">
                <label for="rule_alert_level" class="form-label">Alert Level</label>
                <input type="text" class="form-control" id="rule_alert_level" name="rule_alert_level" required>
            </div>
            
            <div class="mb-3">
                <label for="rule_documentation" class="form-label">Documentation</label>
                <input type="text" class="form-control" id="rule_documentation" name="rule_documentation" required>
            </div>

            <div class="mb-3">
                <label for="rule_related_policies" class="form-label">Related Policies</label>
                <input type="text" class="form-control" id="rule_related_policies" name="rule_related_policies" required>
            </div>

            <div class="mb-3">
                <label for="rule_audit_log" class="form-label">Audit Log</label>
                <input type="text" class="form-control" id="rule_audit_log" name="rule_audit_log" required>
            </div>

            <div class="mb-3">
                <label for="rule_incident_logs" class="form-label">Incident Logs</label>
                <input type="text" class="form-control" id="rule_incident_logs" name="rule_incident_logs" required>
            </div>

            <div class="mb-3">
                <label for="rule_requirements" class="form-label">Requirements</label>
                <input type="text" class="form-control" id="rule_requirements" name="rule_requirements" required>
            </div>

            <div class="mb-3">
                <label for="rule_priority" class="form-label">Priority</label>
                <input type="text" class="form-control" id="rule_priority" name="rule_priority" required>
            </div>

            <div class="mb-3">
                <label for="rule_related_assets" class="form-label">Related Assets</label>
                <input type="text" class="form-control" id="rule_related_assets" name="rule_related_assets" required>
            </div>


            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
        </div>
    </div>

<!-- EDİT ROW BİTİS -->
</div>
@endsection