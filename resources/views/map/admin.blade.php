@extends('layouts.master')
@section('header_css')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<style>
    .page {
        background: #9cc9d1;
        background: -webkit-linear-gradient(to right, #eeeff0, #9cc9d1);
        background: linear-gradient(to right, #eeeff0, #9cc9d1);
    }

    .modal-dialog {
        max-width: 500px !important;
    }

    .modal-dialog .modal-content .modal-body form .form-group {
        margin-bottom: 15px;
        display: flex;
    }

    .table th,
    .table td {
        padding: 0.75rem 5px;
    }
    #table_div {
        height: 100%;
        overflow-y: auto;
    }

    tfoot {
        display: table-header-group !important;
    }

    .toolbar {
        float: right;
        margin-left: 10px
    }

    @media only screen and (max-width: 768px) {
        table tr th {
            font-size: 11px;
        }

        .table th,
        .table td {
            padding: 0rem .10rem !important;
        }

        select.form-control:not([size]):not([multiple]) {
            height: calc(1.75rem + 1px);
        }

        .form-control {
            padding: 0.0rem 0rem !important;
        }

        .addDownImg {
            width: 25px;
        }

        select option {
            font-size: 11px;
        }

        table.added_table tr th {
            background: rgb(245, 225, 199);
            font-weight: 600;
            font-size: 8px;
            padding-left: 0px;
            border: 1px solid gray;
        }

    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-header text-white bg-info"> <b>View All Map Data</b></div>
                <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                    <div id="table_div">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Name</th>
                                    <th>latitude</th>
                                    <th>longitude</th>
                                    <th>details</th>
                                    <th>file</th>
                                    <th>type</th>
                                    <th>status</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th width="100px">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--- Start Create Modal--->
@include('map/_form')
<!--- End Create Model--->
<!--- Start update Modal--->
@include('map/_form2')
<!--- End update Model--->
@endsection

@section('footer_js')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Start View Data
    $('.data-table').DataTable({
        language: {
            paginate: {
                next: '&#8594;', // or '→'
                previous: '&#8592;' // or '←'
            }
        },
        processing: true,
        serverSide: true,
        iDisplayLength: 25,
        aaSorting: [
            ['0', 'desc']
        ],
        dom: '<"toolbar">frtip',
        ajax: '{{ url("map/admin") }}',
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'latitude',
                name: 'latitude'
            },
            {
                data: 'longitude',
                name: 'longitude'
            },
            {
                data: 'details',
                name: 'details'
            },
            {
                data: 'file',
                name: 'file'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],

        initComplete: function() {
            this.api().columns([1, 2, 3, 4]).every(function() {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? val : '', true, false).draw();
                    });
            });
            this.api().columns([6]).every(function() {
                var column = this;
                var select = $('<select><option value="">Select One</option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });
                column.each(function() {
                    select.append('<option value="House">' + 'House' + '</option>')
                    select.append('<option value="Hand Pump">' + 'Hand Pump' + '</option>')
                });
            });
            this.api().columns([7]).every(function() {
                var column = this;
                var select = $('<select><option value="">Select One</option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });
                column.each(function() {
                    select.append('<option value="Active">' + 'Active' + '</option>')
                    select.append('<option value="InActive">' + 'InActive' + '</option>')
                });
            });
            $("div.toolbar").html(
                "<a class='btn btn-success btnAdd' href='javascript:void(0)' onclick='showForm()'> <i class='fas fa-plus'></i></a>"
            );
        }
    });
    // End View Data

    // Start Create Data
    function showForm() {
        $('.alert-danger').hide();
        $('#saveBtn').val("save-data");
        $('#data_id').val('');
        $('#dataForm').trigger("reset");
        $('#modelHeading').html("Create");
        $('#ajaxModel').modal('show');
    }
    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');        
        $.ajax({
            data: $('#dataForm').serialize(),
            url: "{{ url('map/create') }}",
            type: "POST",
            dataType: 'json',
            success: function(result) {
                if (result.errors) {
                    $('#saveBtn').html('Send')
                    $('.alert-danger').html('');
                    $.each(result.errors, function(key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>' + value + '</li>');
                    });
                } else {
                    $('#dataForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    $('#saveBtn').html('Save');
                }
            },
            error: function(data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save');
            }
        });
    });

    // Start Edit Data
    $('body').on('click', '.editData', function() {
        var dataId = $(this).data('id');
        $.get("{{ url('map/edit') }}" + '/' + dataId, function(data) {
            $('#data_id').val(data.data.id);
            $('#modelHeadingUpdate').html("Edit branch");
            $('#ajaxModelUpdate').modal('show');
            $('.alert-danger').hide();
            $('#name2').val(data.data.name);
            $('#latitude2').val(data.data.latitude);
            $('#longitude2').val(data.data.longitude);
            $('#type2').val(data.data.type);
            $('#details2').html(data.data.details);
            $('#file2').val(data.data.file);
            $('#status2').val(data.data.status);
        })
    });

    $('#updateBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Updating..');
        $.ajax({
            data: $('#dataFormUpdate').serialize(),
            url: "{{ url('map/update') }}",
            type: "POST",
            dataType: 'json',
            success: function(result) {
                if (result.errors) {
                    $('#saveBtn').html('Update')
                    $('#updateError').html('');
                    $.each(result.errors, function(key, value) {
                        $('#updateError').show();
                        $('#updateError').append('<li>' + value + '</li>');
                    });
                    $('#updateBtn').html('Update');
                } else {
                    $('#dataFormUpdate').trigger("reset");
                    $('#ajaxModelUpdate').modal('hide');
                    $('.dataTable').DataTable().ajax.reload(null, false);
                    $('#updateBtn').html('Update');
                }
            },
            error: function(data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save');
            }
        });
    });
    // End Edit Data

    // Start Delete Data
    $('body').on('click', '.deleteData', function() {
        var data_id = $(this).data("id");
        if (confirm("Are You sure want to delete !")) {
            $.ajax({
                type: "POST",
                url: "{{ url('map/delete') }}" + '/' + data_id,
                success: function(data) {
                    $('.dataTable').DataTable().ajax.reload(null, false);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }
    });
</script>
@endsection