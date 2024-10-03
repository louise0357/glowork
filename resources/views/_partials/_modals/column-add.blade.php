<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content">
      <div class="modal-body p-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="mb-2">Add Column</h4>  
          <p class="mb-6">çorum ankara ek açıklama</p>
        </div>
        <form id="editUserForm" class="row g-5" action="{{ route('tables.addColumn', $table) }}" method="POST">
        @csrf
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <input type="text" id="modalEditUserFirstName" name="column" class="form-control" value="" placeholder="" />
              <label for="modalEditUserFirstName">Column Name</label>

            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <select id="type" name="type" class="select2 form-select">
                <option value="">Select</option>
                <option value="text">Text</option>
                <option value="status">Status</option>
                <option value="calls">Calls</option>
                <option value="assigned">Assigned Users</option>
                <option value="File">File</option>

              </select>
              <label for="type">Type</label>
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
<!--/ Edit User Modal -->
