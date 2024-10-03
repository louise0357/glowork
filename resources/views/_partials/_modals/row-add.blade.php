<!-- Edit User Modal -->
<div class="modal fade" id="RowAddModal" tabindex="-1" aria-labelledby="RowAddModal" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content">
      <div class="modal-body p-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="mb-2">Add Row</h4>
          <p class="mb-6">çorum ankara ek açıklama</p>
        </div>
        <form id="editUserForm" class="row g-5" action="{{ route('tables.addRow', $table) }}" method="POST">
    @csrf
    <input type="hidden" id="row-id" name="row_id" value="{{ $rowId ?? '' }}">
    <input type="hidden" id="table-id" name="table_id" value="{{ $table->id }}">

    @foreach ($columns as $column)
        <div class="form-floating form-floating-outline mb-5">
            @if ($column->type === 'calls')
                <select name="add_calls_{{ $column->id }}[]" class="select2 form-select"
                    id="addinputGroupSelect02-{{ $column->id }}" placeholder="{{ $column->name }}" multiple>
                    @foreach($calls as $call)
                        <option value="{{ $call->call_id }}">{{ $call->call_reason }}</option>
                    @endforeach
                </select>
                <label for="addinputGroupSelect02-{{ $column->id }}">{{ $column->name }}</label>

            @elseif ($column->type === 'text')
                <input type="text" class="form-control"
                    id="addadd-{{ \Illuminate\Support\Str::slug($column->name, '-') }}"
                    placeholder="{{ $column->name }}" name="add_column_{{ $column->id }}"
                    data-column-id="{{ $column->id }}" aria-label="{{ $column->name }}" />
                <label for="addadd-{{ \Illuminate\Support\Str::slug($column->name, '-') }}">{{ $column->name }}</label>

            @elseif ($column->type === 'status')
                <input type="hidden" name="add_status_columns[]" value="{{ $column->id }}">
                <select name="add_status_ids_{{ $column->id }}[]" class="select2 form-select"
                    id="addselect2Primary-{{ $column->id }}" multiple>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->status }}</option>
                    @endforeach
                </select>
                <label for="addselect2Primary-{{ $column->id }}">{{ $column->name }}</label>
                <small class="mb-2"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#onboardHorizontalImageModal">Tablonuza özel status eklemek için tıklayın!</a></small>

            @elseif ($column->type === 'assigned')
                <input type="hidden" name="add_assigned_columns[]" value="{{ $column->id }}">
                <select name="add_assigned_ids_{{ $column->id }}[]" class="select2 form-select"
                    id="addselect2Primary-{{ $column->id }}" multiple>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <label for="addselect2Primary-{{ $column->id }}">{{ $column->name }}</label>

            @endif
        </div>
    @endforeach

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
