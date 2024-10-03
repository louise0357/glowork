<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
    <div class="modal-content">
      <div class="modal-body p-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="role-title mb-2 pb-0">Add New Role</h4>
          <p>Set role permissions</p>
        </div>
        <!-- Add role form -->
        <form id="addRoleForm" class="row g-3" onsubmit="return false">
          <div class="col-12 mb-3">
            <div class="form-floating form-floating-outline">
              <input type="text" id="modalRoleName" name="modalRoleName" class="form-control" placeholder="Enter a role name" tabindex="-1" />
              <label for="modalRoleName">Role Name</label>
            </div>
          </div>
          <div class="col-12">
            <h5>Role Permissions</h5>
            <!-- Permission table -->
            <div class="table-responsive">
              <table class="table table-flush-spacing">
                <tbody>
                  <tr>
                    <td class="text-nowrap fw-medium">Administrator Access <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i></td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="selectAll" />
                          <label class="form-check-label" for="selectAll">
                            Select All
                          </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap fw-medium">User Management</td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="userManagementRead" />
                          <label class="form-check-label" for="userManagementRead">
                            Read
                          </label>
                        </div>
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="userManagementWrite" />
                          <label class="form-check-label" for="userManagementWrite">
                            Write
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="userManagementCreate" />
                          <label class="form-check-label" for="userManagementCreate">
                            Create
                          </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap fw-medium">Content Management</td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="contentManagementRead" />
                          <label class="form-check-label" for="contentManagementRead">
                            Read
                          </label>
                        </div>
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="contentManagementWrite" />
                          <label class="form-check-label" for="contentManagementWrite">
                            Write
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="contentManagementCreate" />
                          <label class="form-check-label" for="contentManagementCreate">
                            Create
                          </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap fw-medium">Disputes Management</td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="dispManagementRead" />
                          <label class="form-check-label" for="dispManagementRead">
                            Read
                          </label>
                        </div>
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="dispManagementWrite" />
                          <label class="form-check-label" for="dispManagementWrite">
                            Write
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="dispManagementCreate" />
                          <label class="form-check-label" for="dispManagementCreate">
                            Create
                          </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap fw-medium">Database Management</td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="dbManagementRead" />
                          <label class="form-check-label" for="dbManagementRead">
                            Read
                          </label>
                        </div>
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="dbManagementWrite" />
                          <label class="form-check-label" for="dbManagementWrite">
                            Write
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="dbManagementCreate" />
                          <label class="form-check-label" for="dbManagementCreate">
                            Create
                          </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap fw-medium">Financial Management</td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="finManagementRead" />
                          <label class="form-check-label" for="finManagementRead">
                            Read
                          </label>
                        </div>
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="finManagementWrite" />
                          <label class="form-check-label" for="finManagementWrite">
                            Write
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="finManagementCreate" />
                          <label class="form-check-label" for="finManagementCreate">
                            Create
                          </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap fw-medium">Reporting</td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="reportingRead" />
                          <label class="form-check-label" for="reportingRead">
                            Read
                          </label>
                        </div>
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="reportingWrite" />
                          <label class="form-check-label" for="reportingWrite">
                            Write
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="reportingCreate" />
                          <label class="form-check-label" for="reportingCreate">
                            Create
                          </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap fw-medium">API Control</td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="apiRead" />
                          <label class="form-check-label" for="apiRead">
                            Read
                          </label>
                        </div>
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="apiWrite" />
                          <label class="form-check-label" for="apiWrite">
                            Write
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="apiCreate" />
                          <label class="form-check-label" for="apiCreate">
                            Create
                          </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap fw-medium">Repository Management</td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="repoRead" />
                          <label class="form-check-label" for="repoRead">
                            Read
                          </label>
                        </div>
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="repoWrite" />
                          <label class="form-check-label" for="repoWrite">
                            Write
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="repoCreate" />
                          <label class="form-check-label" for="repoCreate">
                            Create
                          </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap fw-medium">Payroll</td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="payrollRead" />
                          <label class="form-check-label" for="payrollRead">
                            Read
                          </label>
                        </div>
                        <div class="form-check me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="payrollWrite" />
                          <label class="form-check-label" for="payrollWrite">
                            Write
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="payrollCreate" />
                          <label class="form-check-label" for="payrollCreate">
                            Create
                          </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- Permission table -->
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-3">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
        <!--/ Add role form -->
      </div>
    </div>
  </div>
</div>
<!--/ Add Role Modal -->
