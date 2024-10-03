'use strict';

$(function () {
  var dt_scrollable_table = $('.dt-scrollableTable');

  if (dt_scrollable_table.length) {
    var dt_scrollableTable = dt_scrollable_table.DataTable({
      ajax: '/getcalls',
      columns: [
        { data: '' },
        { data: 'call_id' },
        { data: 'caller_no' },
        { data: 'caller_name' },
        { data: 'called_no' },
        { data: 'called_name' },
        { data: 'representative_id' },
        { data: 'call_start_time' },
        { data: 'call_end_time' },
        { data: 'call_duration' },
        { data: 'call_type' },
        { data: 'call_reason' },
        { data: 'call_notes' },
        { data: 'personel_evaluation' },
        { data: 'resolution_status' },
        { data: '' }
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
              '<a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>' +
              '</div>' +
              '</div>' +
              '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i class="ri-edit-box-line ri-22px"></i></a>'
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

    $(document).on('click', '.delete-record', function () {
      var $row = $(this).closest('tr');
      var rowData = dt_scrollableTable.row($row).data();
  
      Swal.fire({
          title: 'Silmek istediğinize emin misiniz?',
          text: 'Bu işlem geri alınamaz!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Evet, sil!',
          cancelButtonText: 'Hayır, iptal et'
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '/calls/delete',
                  method: 'POST',
                  data: {
                      call_id: rowData.call_id,
                      _token: $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function (response) {
                      if (response.success) {
                          dt_scrollableTable.row($row).remove().draw(false);
                          Swal.fire('Silindi!', 'Kayıt başarıyla silindi.', 'success');
                      } else {
                          Swal.fire('Hata!', response.message, 'error');
                      }
                  },
                  error: function (xhr, status, error) {
                      console.error('Silme hatası:', error);
                      Swal.fire('Hata!', 'Kayıt silinirken bir sorun oluştu.', 'error');
                  }
              });
          }
      });
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



    $(document).on('click', '.item-edit', function() {
        var $row = $(this).closest('tr');
        var rowData = dt_scrollableTable.row($row).data();
        
        $('#call-id').val(rowData.call_id); 
        $('#caller_no').val(rowData.caller_no);
        $('#caller_name').val(rowData.caller_name);
        $('#called_no').val(rowData.called_no);
        $('#called_name').val(rowData.called_name);
        $('#representative_id').val(rowData.representative_id);
        $('#call_start_time').val(rowData.call_start_time);
        $('#call_end_time').val(rowData.call_end_time);
        $('#call_duration').val(rowData.call_duration);
        $('#call_type').val(rowData.call_type);
        $('#call_reason').val(rowData.call_reason);
        $('#call_notes').val(rowData.call_notes);
        $('#personel_evaluation').val(rowData.personel_evaluation);
        $('#resolution_status').val(rowData.resolution_status);

        $('#offcanvasAddUser').offcanvas('show');
    });
  }

  $('#addNewUserForm').on('submit', function(event) {
    event.preventDefault(); 
    
    var formData = new FormData(this);

    $.ajax({
        url: '/update-call-content',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $('#offcanvasAddUser').offcanvas('hide');
            dt_scrollableTable.ajax.reload();
            toastr.succes('Arama Kaydı Başarıyla Güncellendi!');
        },
        error: function(xhr, status, error) {
            console.log("Güncelleme sırasında hata oluştu: ", error);
            toastr.error('Arama kaydedilemedi! Lütfen yönetici ile görüşünüz.')
        }
    });
  });
});