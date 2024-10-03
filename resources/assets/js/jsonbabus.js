'use strict';

$(function () {
    var dt_scrollable_table = $('.dt-scrollableTable');

    $('#uploadButton').on('click', function () {
        var fileInput = document.getElementById('jsonFile');
        var file = fileInput.files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var csvContent = e.target.result;
                processData(csvContent);
            };

            reader.readAsText(file);
        } else {
            alert('Lütfen bir CSV dosyası seçiniz.');
        }
    });

    function processData(csvContent) {
        if (dt_scrollable_table.length) {
            var lines = csvContent.split('\n');
            var columns = [];
            var data = [];

            var headers = lines[0].split(',');

            headers.forEach(function (header) {
                columns.push({ title: header.trim(), data: header.trim() });
            });

            for (var i = 1; i < lines.length; i++) {
                var rowData = {};
                var currentLine = lines[i].split(',');

                headers.forEach(function (header, index) {
                    rowData[header.trim()] = currentLine[index] ? currentLine[index].trim() : '';
                });

                data.push(rowData);
            }

            if ($.fn.DataTable.isDataTable('.dt-scrollableTable')) {
                dt_scrollable_table.DataTable().destroy();
                dt_scrollable_table.empty();
            }

            dt_scrollable_table.DataTable({
                data: data,
                columns: columns,
                scrollY: '300px',
                scrollX: true,
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                initComplete: function (settings, json) {
                    dt_scrollable_table.find('tbody tr:first').addClass('border-top-0');
                    $('.card-header').after('<hr class="my-0">');
                },
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/tr.json'
                }
            });
        } else {
            alert('Tablo elementi bulunamadı.');
        }
    }
});
