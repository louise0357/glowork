'use strict';
import SwalPlugin from 'sweetalert2/dist/sweetalert2';
const Swal = SwalPlugin.mixin({
    buttonsStyling: false,
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-outline-danger',
      denyButton: 'btn btn-outline-secondary'
    }
  });
  
  try {
    window.Swal = Swal;
  } catch (e) {}
  
  export { Swal };
$(function () {
    var dt_scrollable_table = $('.dt-scrollableTable');

    const endpoint = $('#routes').data('my-endpoint');
    const tableId = $('#routes').data('table-id');

    if (dt_scrollable_table.length) {
        $.ajax({
            url: endpoint,
            type: 'GET',
            data: { table_id: tableId },
            success: function (response) {
                if (response.success) {
                    let columns = [
                        { 
                            title: '<i class="ri-add-line" data-bs-target="#editUser" data-bs-toggle="modal"></i>', 
                            orderable: false, 
                            searchable: false, 
                            width: '20px',
                            render: function(data, type, full, meta) {
                                return `<input type="checkbox" class="row-select" data-row-id="${full.row_id}">`;
                            }
                          },
                        { title: 'ID', data: 'row_id' }
                    ];
                    let columnDefs = [];
                    let dataGrouped = {};

                    response.data.forEach(row => {
                        if (!dataGrouped[row.table_rows_id]) {
                            dataGrouped[row.table_rows_id] = {};
                        }
                        dataGrouped[row.table_rows_id][row.column_id] = row.contents;
                        dataGrouped[row.table_rows_id]['position_id'] = row.position_id;
                    });

                    let data = Object.keys(dataGrouped).map(key => {
                        dataGrouped[key]['row_id'] = key;
                        return dataGrouped[key];
                    });

                    response.columns.forEach((column, index) => {
                        columns.push({ title: column.name, data: column.id });

                        if (column.type === 'status') {
                            columnDefs.push({
                                targets: index + 2,
                                render: function (data, type, full, meta) {
                                    let statuses = response.statuses.filter(status => status.row_id.includes(full.row_id) && status.column_id == column.id);

                                    return statuses.map(status => `<span class="badge rounded-pill ${status.class}">${status.status}</span>`).join('');

                                }
                            });
                        } else if (column.type === 'calls') {
                            columnDefs.push({
                                targets: index + 2,
                                render: function (data, type, full, meta) {
                                    if (data) {
                                        let callIds = data.split(',');
                                        let callDetails = callIds.map(id => {
                                            let call = response.calls.find(call => call.call_id == id);
                                            return call ? `id: ${call.call_id}` : 'Bilinmeyen Çağrı';
                                        });
                            
                                        let callCount = callDetails.length;
                                        return `Bu hücrede ${callCount} arama kayıtlıdır.`;
                                    }
                                    return '<span style="color: #6d65a3">Çağrı Yok</span>';
                                }
                            });
                            
                        } else if (column.type === 'assigned') {
                            columnDefs.push({
                                targets: index + 2,
                                render: function (data, type, full, meta) {
                                    if (data) {
                                        let assignedIds = data.split(',');
                                        let assignedDetailsPromises = assignedIds.map(id => $.getJSON('/get-username/' + id));

                                        let cell = '<span class="loading">Yükleniyor...</span>';
                                        Promise.all(assignedDetailsPromises).then(responses => {
                                            cell = responses.map(response => `<span class="badge rounded-pill bg-label-primary">${response.username}</span>`).join(', ');
                                            $(meta.settings.aoData[meta.row].anCells[meta.col]).html(cell);
                                        }).catch(() => {
                                            cell = '<span class="badge rounded-pill bg-label-primary">Bilinmeyen Kullanıcı</span>';
                                            $(meta.settings.aoData[meta.row].anCells[meta.col]).html(cell);
                                        });

                                        return cell;
                                    }
                                    return 'Atanmış Kullanıcı Yok';
                                }
                            });
                        } else if (column.type === 'file') {
                            columnDefs.push({
                                targets: index + 2,
                                render: function (data, type, full, meta) {
                                    let filesForRow = response.files.filter(file => file.includes(`uploads/${full.row_id}`));
                                    let fileLinks = filesForRow.length ? filesForRow.map(file => `
                                        <a href="/storage/${file}" target="_blank">${file.split('/').pop()}</a>
                                        <i class="ri-close-fill ri-13px" style="color: #cf0000; cursor: pointer;" 
                                        data-file="${file.split('/').pop()}" 
                                        data-rowid="${full.row_id}"></i>`).join(', ') : 'Dosya Yok';
                        
                                    $(meta.settings.aoData[meta.row].anCells[meta.col]).html(fileLinks);
                        
                                    $(meta.settings.aoData[meta.row].anCells[meta.col]).find('i[data-file]').on('click', function () {
                                        let fileName = $(this).data('file');
                                        let rowId = $(this).data('rowid');
                        
                                        Swal.fire({
                                            title: 'Bu dosyayı silmek istediğinize emin misiniz?',
                                            text: "Bu işlemi geri alamazsınız!",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Evet, sil!',
                                            cancelButtonText: 'Hayır'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.ajax({
                                                    url: window.fileDeleteRoute,
                                                    type: 'POST',
                                                    data: {
                                                        fileName: fileName,
                                                        _token: window.csrfToken
                                                    },
                                                    success: function(response) {
                                                        Swal.fire(
                                                            'Silindi!',
                                                            'Dosya başarıyla silindi.',
                                                            'success'
                                                        );
                                                        setTimeout(() => {
                                                            window.location.reload();
                                                        }, 1500);
                                                    },
                                                    error: function(xhr) {
                                                        Swal.fire(
                                                            'Hata!',
                                                            xhr.responseJSON.error,
                                                            'error'
                                                        );
                                                    }
                                                });
                                            }
                                        });
                                    });
                        
                                    return fileLinks;
                                }
                            });
                        }
                        
                    });

                    columns.push({ title: 'Actions', data: null, orderable: false, searchable: false });

                    
    
                    columnDefs.push({
                        targets: columns.length - 1,
                        render: function (data, type, full, meta) {
                            return (
                                '<div class="d-inline-block">' +
                                '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line ri-22px"></i></a>' +
                                '<div class="dropdown-menu dropdown-menu-end m-0">' +
                                '<a href="javascript:;" class="dropdown-item item-comments" data-row-id="' + data.row_id + '">View Comments</a>' +
                                '<a href="javascript:;" class="dropdown-item add-item-comments"  data-row-id="' + data.row_id + '">Add Comments</a>' +
                                '<div class="dropdown-divider"></div>' +
                                '<a href="javascript:;" class="dropdown-item text-danger delete-record" data-row-id="' + data.row_id + '">Delete</a>' +
                                '</div>' +
                                '</div>' +
                                '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit" data-row-id="' + data.row_id + '"><i class="ri-edit-box-line ri-22px" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"></i></a>' +
                                '<a href="javascript:;" class="btn btn-sm btn-text-primary rounded-pill btn-icon item-upload" data-bs-toggle="modal" data-bs-target="#fileUploadModal" data-row-id="' + data.row_id + '"><i class="ri-upload-line ri-22px"></i></a>'
                            );
                        }
                    });

                    // ONCLICK OLAYLARI;;



                    document.querySelector('.status-form-submit').addEventListener('click', function (e) {
                        e.preventDefault();
                    
                        var formData = {
                            table_id: document.getElementById('table_id_st').value,
                            name: document.getElementById('nameEx7').value,
                            color: document.getElementById('roleEx7').value,
                            _token: document.querySelector('input[name="_token"]').value
                        };
                    
                        fetch("/tables/addstatus", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': formData._token
                            },
                            body: JSON.stringify(formData)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                toastr.success('Status başarıyla eklendi!');
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                    
                            } else {
                                toastr.error('Bir hata oluştu. Lütfen tekrar deneyin.');
                            }
                        })
                        .catch(error => {
                            toastr.error('Bir hata oluştu. Lütfen tekrar deneyin.');
                            console.error('Hata:', error);
                        });
                    });
                    


                    $(document).on('click', '.item-upload', function() {
                        let rowId = $(this).data('row-id');
                        $('#fileUploadModal').find('#row-id').val(rowId);
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
                                    url: '/tables/delete-row',
                                    type: 'POST',
                                    data: {
                                        row_id: rowId,
                                        _token: $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            toastr.success('Satır başarıyla silindi!');
                                            setTimeout(() => {
                                                window.location.reload();
                                            }, 1500);
                                        } else {
                                            toastr.error('Silme işlemi başarısız oldu: ' + response.message);
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
                    

                    $(document).on('click', '.item-edit', function() {
                        event.preventDefault();

                        let rowId = $(this).data('row-id');
                        $('#row-id').val(rowId);
                        $('#table-id').val(tableId);

                });

                $('#addNewUserForm').on('submit', function(event) {
    
                    var formData = new FormData(this);
                  
                    $.ajax({
                      url: '/update-cell-content',
                      method: 'POST',
                      data: formData,
                      processData: false,
                      contentType: false,
                      success: function () {
                            location.reload();
                                                
                        var offcanvasElement = document.getElementById('offcanvasAddUser');
                        var offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
                        offcanvas.hide();
                        
                      },
                      error: function (error) {
                        console.log("Error:", error);
                      }
                    });
                });

                    $(document).ready(function() {
                        $('#uploadFileForm').on('submit', function(event) {
                            event.preventDefault();
                            
                            let formData = new FormData(this);
                            let rowId = $('#fileUploadModal').find('#row-id').val();
                            
                            formData.getAll('file[]').forEach((file, index) => {
                                let newFileName = rowId + '_' + file.name;
                                let renamedFile = new File([file], newFileName, { type: file.type });
                                formData.set('file[]', renamedFile, index);
                            });

                            $.ajax({
                                url: '/upload-file',
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    $('#responseMessage').html('<div class="alert alert-success">File uploaded successfully: ' + response.filePath + '</div>');
                                    toastr.success('Dosya Sisteme Başarıyla Yüklendi!' + response.filePath);
                                    
                                },
                                error: function(xhr, status, error) {
                                    let errorMessage = xhr.responseJSON.message || 'An error occurred';
                                    $('#responseMessage').html('<div class="alert alert-danger">' + errorMessage + '</div>');
                                }
                            });
                        });
                    });



                    function loadComments(rowId) {
                        $.ajax({
                            url: `/comments/${rowId}`,
                            type: 'GET',
                            success: function(response) {
                                let currentUser = response.um;
                                let commentsHtml = response.comments.map(comment => 
                                    `<div class="comment">
                                        <strong>${comment.user.username}:</strong> ${comment.comment}
                                        <br>
                                        ${currentUser === comment.user.username 
                                            ? `<i class="ri-delete-bin-7-line ri-13px" data-comment-id="${comment.id}"></i>`
                                            : ''}
                                    </div>`
                                ).join('<br>');
                                $('#comments-container').html(commentsHtml);
                    
                                $('#comments-container').on('click', '.ri-delete-bin-7-line', function() {
                                    let commentId = $(this).data('comment-id'); // commentId'yi al
                    
                                    Swal.fire({
                                        title: 'Yorumu silmek istediğinize emin misiniz?',
                                        text: "Bu işlem geri alınamaz!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Evet, sil!',
                                        cancelButtonText: 'Hayır, iptal et!'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                url: `/comments/delete`,
                                                type: 'POST',
                                                contentType: 'application/json',
                                                data: JSON.stringify({
                                                    comment_id: commentId,
                                                    _token: $('meta[name="csrf-token"]').attr('content')
                                                }),
                                                success: function(response) {
                                                    if (response.success) {
                                                        Swal.fire(
                                                            'Silindi!',
                                                            'Yorum başarıyla silindi.',
                                                            'success'
                                                        );
                                                        loadComments(rowId); 
                                                    } else {
                                                        Swal.fire(
                                                            'Hata!',
                                                            response.message,
                                                            'error'
                                                        );
                                                    }
                                                },
                                                error: function(xhr, status, error) {
                                                    Swal.fire(
                                                        'Hata!',
                                                        'Yorum silinirken bir hata oluştu.',
                                                        'error'
                                                    );
                                                }
                                            });
                                        }
                                    });
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                                $('#comments-container').html('<p class="text-danger">Failed to load comments.</p>');
                            }
                        });
                    }
                    
                    
                    $(document).on('change', '.row-select', function() {
                        let selectedCount = $('.row-select:checked').length;
                    
                        if (selectedCount > 0) {
                            $('#action-bar').removeClass('d-none').addClass('d-flex');
                        } else {
                            $('#action-bar').removeClass('d-flex').addClass('d-none');
                        }
                    });
                    
                    $('#action-submit').on('click', function() {
                        let selectedRows = $('.row-select:checked').map(function() {
                            return $(this).data('row-id');
                        }).get();
                    
                        console.log('Selected Row IDs:', selectedRows);
                        const thirdSelect = document.getElementById('kanban-list-selectt');
                        const selectedThirdValue = thirdSelect.value;

                        if (!selectedThirdValue) {
                            alert('Lütfen üçüncü seçenekten bir değer seçin!');
                            return;
                        }

                        fetch('/api/send-to-kanban', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify({
                                 list_id: selectedThirdValue,
                                 selectedRows: selectedRows 
                                })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Ağ yanıtı başarılı olmadı');
                            }
                            return response.json();
                        })
                        .then(data => {
                            toastr.success("İşlem başarıyla gerçekleşti!", "Başarılı!")
                        })
                        .catch(error => {
                            console.error('Kanban\'a gönderme hatası:', error);
                            toastr.error("Bir hata oluştu, lütfen tekrar deneyin veya yönetici ile görüşün!", "Hata!")
                        });
                    });
                    
                        $(document).on('click', '.item-edit', function() {
                            const rowId = $(this).data('row-id');
                            const endpoint = $('#routes').data('my-endpoint');
                        
                            $.ajax({
                                url: endpoint,
                                type: 'GET',
                                data: { table_id: $('#routes').data('table-id'), row_id: rowId },
                                success: function(response) {
                                    if (response.success) {
                                        const data = response.data;
                                        const columns = response.columns;
                                        const statuses = response.statuses;
                                        const calls = response.data;
                                        const texts = response.data;
                                        const assignedUsers = response.data;
                        
                                        const form = $('#addNewUserForm');
                        
                                        form.find('input[type="text"]').val('');
                                        form.find('select').val(null).trigger('change');
                        
                                        data.forEach(function(item) {
                                            const column = columns.find(c => c.id === item.column_id);
                                            
                                            if (column) {
                                                const input = form.find(`[name="column_${item.column_id}"]`);
                                                
                                                if (column.type === 'text') {
                                                    input.val(item.contents);
                                                    //console.log(input);
                                                } else if (column.type === 'calls') {
                                                    

                                                } else if (column.type === 'assigned') {
                                                    const assignedIds = item.contents.split(',').map(Number);
                                                    input.val(assignedIds).trigger('change');
                                                } else if (column.type === 'datetime') {
                                                    input.val(item.contents);
                                                    const datePickerid = document.querySelector('#due-date_' + column.id);

                                                    datePickerid.flatpickr({
                                                        enableTime: true,
                                                        time_24hr: true,
                                                        altInput: true,
                                                        altFormat: 'j F, Y H:i',
                                                        dateFormat: 'Y-m-d H:i:S',
                                                        defaultHour: 12,
                                                        defaultMinute: 0,
                                                        defaultDate: item.contents 
                                                    });
                                                }
                                                const datePicker = form.find(`[id="due-date_"`);
                                                if (datePicker) {
                                                    console.log(datePicker);
                                                datePicker.flatpickr({
                                                    enableTime: true,
                                                    time_24hr: true,
                                                    altInput: true,
                                                    altFormat: 'j F, Y H:i',
                                                    dateFormat: 'Y-m-d H:i:S',
                                                    defaultHour: 12,
                                                    defaultMinute: 0,
                                                });
                                            }
                                            }
                                        });

                        
                                        const statusInputs = form.find('select[name^="status_ids_"]');
                                        statusInputs.each(function() {
                                            const name = $(this).attr('name');
                                            const columnId = name.match(/status_ids_(\d+)/)[1];
                                            const statusIds = statuses
                                                .filter(status => status.row_id == rowId && status.column_id == columnId)
                                                .map(status => status.status_id);
                                            $(this).val(statusIds).trigger('change');
                                        });
                        

                                        const callInput = form.find('select[name^="calls_"]');
                                        callInput.each(function() {
                                            const name = $(this).attr('name');
                                            const columnId = name.match(/calls_(\d+)/)[1];
                                            
                                            const callIds = calls
                                                .filter(call => call.table_rows_id == rowId && call.column_id == columnId)
                                                .flatMap(call => call.contents.split(',').map(Number));
                                        
                                        
                                            $(this).val(callIds).trigger('change');

                                        });



                                        const textInput = form.find('input[name^="column_"]');
                                        textInput.each(function() {
                                            const name = $(this).attr('name');
                                            const columnId = name.match(/column_(\d+)/)[1];
                                            const textIds = texts
                                                .filter(text => text.table_rows_id == rowId && text.column_id == columnId)
                                                .flatMap(text => text.contents);
                                        
                                            $(this).val(textIds).trigger('change');

                                        });
                                        


                                    
                        
                                        const assignedInput = form.find('select[name^="assigned_ids_"]');
                                        assignedInput.each(function() {
                                            const name = $(this).attr('name');
                                            const columnId = name.match(/assigned_ids_(\d+)/)[1];
                                            const assignedIds = assignedUsers
                                                .filter(assigned => assigned.table_rows_id == rowId && assigned.column_id == columnId)
                                                .flatMap(assigned => assigned.contents.split(',').map(Number));
                                            console.log(assignedIds);
                                            $(this).val(assignedIds).trigger('change');

                                        });
                                    }
                                },
                                error: function(xhr) {
                                    console.error('Bir hata oluştu:', xhr);
                                }
                            });
                        });
                        
                        


                        $(document).on('click', '.item-comments', function() {
                            let rowId = $(this).data('row-id');
                            $('#commentsModal').modal('show');
                            loadComments(rowId);
                            //console.log('Tıklandı');
                           //console.log(rowId);
                        });

                        $(document).on('click', '.add-item-comments', function() {
                            let rowId = $(this).data('row-id');
                            
                            $('#commentModal').modal('show');
                            
                            $('#comment-row-id').val(rowId);

                            //console.log('Add comment clicked');
                            //console.log('Row ID:', rowId);
                        });

                        $(document).on('click', '.add-item-comments', function() {
                            let rowId = $(this).data('row-id');
                            
                            $('#commentModal').modal('show');
                            
                            $('#comment-row-id').val(rowId);

                            //console.log('Add comment clicked');
                            //console.log('Row ID:', rowId);
                        });



                            $('#commentForm').on('submit', function(event) {
                                event.preventDefault();
                                let formData = $(this).serialize();
                                toastr.success('Yorumunuz Başarıyla Eklendi!');

                                $.ajax({
                                    url: $(this).attr('action'),
                                    type: 'POST',
                                    data: formData,
                                    success: function(response) {
                                        $('#commentModal').modal('hide');
                                        updateCommentsList(rowId);

                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error:', error);
                                        toastr.error('Yorumunuz Eklenemedi.');

                                    }
                                });
                            });



                        function updateCommentsList(rowId) {
                            $.ajax({
                                url: `/comments/${rowId}`,
                                type: 'GET',
                                success: function(response) {
                                    let commentsHtml = response.comments.map(comment => 
                                        `<div class="comment"><strong>${comment.user.name}:</strong> ${comment.comment}</div>`
                                    ).join('');
                                    $('#comments-container').html(commentsHtml);
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error:', error);
                                }
                            });
                        }

                        columns.push({ title: '<i class="ri-add-line" data-bs-toggle="modal" data-bs-target="#RowAddModal"></i>', data: '', orderable: false, searchable: false });

                    
                    var dt_scrollableTable = dt_scrollable_table.DataTable({
                        data: data,
                        columns: columns,
                        columnDefs: columnDefs,
                        scrollY: '300px',
                        scrollX: true,
                        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                        createdRow: function(row, data, dataIndex) {
                            $(row).attr('data-row-id', data.row_id);
                        },
                        initComplete: function (settings, json) {
                            dt_scrollable_table.find('tbody tr:first').addClass('border-top-0');
                        }
                    });
                    
                } else {
                    console.error('Error:', response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Ajax error:', error);
            }
        });
    }
});
