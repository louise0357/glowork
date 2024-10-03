'use strict';

$(function () {
  var dt_scrollable_table = $('.dt-scrollableTable');
  var ruleTableId = window.location.pathname.split('/').pop();
  if (dt_scrollable_table.length) {
    var dt_scrollableTable = dt_scrollable_table.DataTable({
      ajax: '/ruletablej/' + ruleTableId,
      dataSrc: 'data',
      success: function (response) {
        console.log(response);
      },
      columns: [
        { data: 'id' },
        { data: 'rule_name' },
        { data: 'rule_description' },
        { data: 'rule_creation_date' },
        { data: 'rule_last_update' },
        { data: 'rule_type' },
        { data: 'rule_threat_level' },
        { data: 'rule_source' },
        { data: 'rule_destination' },
        { data: 'rule_conditions' },
        { data: 'rule_related' },
        { data: 'rule_status' },
        { data: 'rule_created_by' },
        { data: 'rule_updated_by' },
        { data: 'rule_category' },
        { data: 'rule_tags' },
        { data: 'rule_applicability' },
        { data: 'rule_risk_score' },
        { data: 'rule_test_status' },
        { data: 'rule_test_date' },
        { data: 'rule_tested_by' },
        { data: 'rule_alert_level' },
        { data: 'rule_documentation' },
        { data: 'rule_related_policies' },
        { data: 'rule_audit_log' },
        { data: 'rule_incident_logs' },
        { data: 'rule_requirements' },
        { data: 'rule_priority' },
        { data: 'rule_related_assets' },

        { data: null }
      ],
      
      columnDefs: [
        {
          targets: -2,
          render: function (data, type, full, meta) {
            var $status_number = full['status'];
            var $status = {
              1: { title: 'Current', class: 'bg-label-primary' },
              2: { title: 'Professional', class: ' bg-label-success' },
              3: { title: 'Rejected', class: ' bg-label-danger' },
              4: { title: 'Resigned', class: ' bg-label-warning' },
              5: { title: 'Applied', class: ' bg-label-info' }
            };
            if (typeof $status[$status_number] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $status[$status_number].class +
              '">' +
              $status[$status_number].title +
              '</span>'
            );
          }
        },
        {
          targets: -1,
          title: 'Actions',
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-block">' +
              '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line ri-22px"></i></a>' +
              '<div class="dropdown-menu dropdown-menu-end m-0">' +
              '<a href="javascript:;" class="dropdown-item">Details</a>' +
              '<a href="javascript:;" class="dropdown-item">Archive</a>' +
              '<div class="dropdown-divider"></div>' +
              '<a href="javascript:;" class="dropdown-item text-danger delete-record" data-row-id="' + data.id + '">Delete</a>' +
              '</div>' +
              '</div>' +
              '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit" data-row-id="' + data.id + '"><i class="ri-edit-box-line ri-22px" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"></i></a>'
            );
          }
        },
      ],
      scrollY: '300px',
      scrollX: true,
      dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      initComplete: function (settings, json) {
        dt_scrollable_table.find('tbody tr:first').addClass('border-top-0');
        $('.card-header').after('<hr class="my-0">');
      }

    });

    $(document).on('click', '.delete-record', function() {
      const rowId = $(this).data('row-id');
  
      Swal.fire({
          title: 'Silmek istediğinizden emin misiniz?',
          text: "Bu işlem geri alınamaz!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Evet, sil!',
          cancelButtonText: 'Hayır, iptal et'
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '/ruletable/delete',
                  type: 'POST',
                  data: {
                      row_id: rowId,
                      _token: $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response) {
                      if (response.success) {
                          toastr.success('Satır başarıyla silindi!');
                          dt_scrollableTable.ajax.reload(null, false);
                      } else {
                          toastr.error('Silme işlemi başarısız oldu: ' + response.message);
                          dt_scrollableTable.ajax.reload(null, false);
                      }
                  },
                  error: function(xhr, status, error) {
                      console.error('Silme hatası:', error);
                      toastr.error('Bir hata oluştu. Lütfen tekrar deneyin.');
                  }
              });
          }
      });
  });

      const editForm = document.getElementById('editRuleForm');
  
      editForm.addEventListener('submit', function(event) {
          event.preventDefault();
  
          const formData = new FormData(editForm);
  
          fetch("/ruletable/update", {
              method: 'POST',
              body: formData,
              headers: {
                  'X-Requested-With': 'XMLHttpRequest',
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              }
          })
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  toastr.success("Rule Başarıyla Güncellendi!");
                  dt_scrollableTable.ajax.reload(null, false);
              } else {
                  toastr.error("Bir hata oluştu, Lütfen yönetici ile görüşünüz!"); 
              }
          })
          .catch(error => {
              console.error('Error:', error);
              toastr.error('Bir hata oluştu.');
          });
      });


    $(document).on('click', '.item-edit', function(event) {
      event.preventDefault();
      
      let rowId = $(this).data('row-id');

      var $row = $(this).closest('tr');
      var rowData = dt_scrollableTable.row($row).data();

      $('#rule-id').val(rowId);
      $('#table-id').val(ruleTableId);
      $('#rule_name').val(rowData.rule_name);
      $('#rule_description').val(rowData.rule_description);
      $('#rule_type').val(rowData.rule_type);
      $('#rule_threat_level').val(rowData.rule_threat_level);
      $('#rule_source').val(rowData.rule_source);
      $('#rule_destination').val(rowData.rule_destination);
      $('#rule_conditions').val(rowData.rule_conditions);
      $('#rule_related').val(rowData.rule_related);
      $('#rule_status').val(rowData.rule_status);
      $('#rule_category').val(rowData.rule_category);
      $('#rule_tags').val(rowData.rule_tags);
      $('#rule_risk_score').val(rowData.rule_risk_score);
      $('#rule_test_status').val(rowData.rule_test_status);
      $('#rule_alert_level').val(rowData.rule_alert_level);
      $('#rule_priority').val(rowData.rule_priority);
      $('#rule_applicability').val(rowData.rule_applicability);
      $('#rule_risk_score').val(rowData.rule_risk_score);
      $('#rule_test_status').val(rowData.rule_test_status);
      $('#rule_test_date').val(rowData.rule_test_date);
      $('#rule_tested_by').val(rowData.rule_tested_by);
      $('#rule_alert_level').val(rowData.rule_alert_level);
      $('#rule_documentation').val(rowData.rule_documentation);
      $('#rule_related_policies').val(rowData.rule_related_policies);
      $('#rule_audit_log').val(rowData.rule_audit_log);
      $('#rule_incident_logs').val(rowData.rule_incident_logs);
      $('#rule_requirements').val(rowData.rule_requirements);
      $('#rule_priority').val(rowData.rule_priority);
      $('#rule_related_assets').val(rowData.rule_related_assets);


    });



    $(document).on('click', '.add-row', function () {
      var tr = $(this).closest('tr');
      var row = dt_scrollableTable.row(tr);
      var offcanvasElement = document.getElementById('add-new-record');
      var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
      offcanvas.show();
    
      $('#form-add-new-record').trigger("reset");
    });

    $('#form-add-new-record').on('submit', function(event) {
      event.preventDefault();
    
      var formData = new FormData(this);
    
      $.ajax({
        url: '/addNewRecord',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function () {
          dt_scrollableTable.ajax.reload(null, false);
          
          var offcanvasElement = document.getElementById('add-new-record');
          var offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
          offcanvas.hide();
          
        },
        error: function (error) {
          console.log("Error:", error);
        }
      });
    });







  
  
  }
});