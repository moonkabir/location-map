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
        max-width: 1300px !important;
    }

    .table th,
    .table td {
        padding: 0.75rem 5px;
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
                <div class="card-header text-white bg-info"> <b>View All Employee Attendence Data</b></div>
                <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                    <style>
                        #table_div {
                            height: 100%;
                            overflow-y: auto;
                        }

                        tfoot {
                            display: table-header-group !important;
                        }
                    </style>
                    <div id="table_div">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Branch</th>
                                    <th>Department</th>
                                    <th>Section</th>
                                    <th>Sub-section</th>
                                    <th>Name</th>
                                    <th>Card No</th>
                                    <th>Date</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Device/Manual</th>
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
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display:none"></div>
                <form id="dataForm" name="dataForm" class="form-horizontal">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">

                                <div class="form-group col-sm-3">
                                    <label for="name" class="col-sm-12 control-label">Branch <span class="red"></span> </label>
                                    <div class="col-sm-12">
                                        <select class="form-control select2 select2-container" multiple="" id="branch_id" name="branch_id[]">
                                            @php
                                            //echo App\Models\Branch::getDropDownList('title');
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="name" class="col-sm-12 control-label">Department <span class="red"></span> </label>
                                    <div class="col-sm-12">

                                        <select class="form-control select2 select2-container" multiple="" id="dept_id" name="dept_id[]">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="name" class="col-sm-12 control-label">Section <span class="red"></span> </label>
                                    <div class="col-sm-12">

                                        <select class="form-control select2 select2-container" multiple="" id="section_id" name="section_id[]">

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="name" class="col-sm-12 control-label">Sub-Section <span class="red"></span> </label>
                                    <div class="col-sm-12">

                                        <select class="form-control select2 select2-container" multiple="" id="sub_section_id" name="sub_section_id[]">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">

                                <div class="form-group col-sm-3">
                                    <label for="name" class="col-sm-12 control-label">Date <span class="red">*</span> </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="entry_date" name="entry_date" />
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="name" class="col-sm-12 control-label">In Time <span class="red">*</span> </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="in_time" name="in_time" />
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="name" class="col-sm-12 control-label">Out Time <span class="red">*</span> </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="out_time" name="out_time" />
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="name" class="col-sm-12 control-label"> <span class="red"></span> </label>
                                    <div class="col-sm-12">

                                        <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Add To Grid" class="addToGrid">
                                            <img class="addDownImg" src="{{ url('app_assets') }}/images/add-down.png">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- <table class="table">
                                <thead>
                                    <tr>
                                        <th>Branch</th>
                                        <th>Department</th>
                                        <th>Section</th>
                                        <th>Sub-section</th>
                                        <th>Date <span style="color:red">*</span></th>
                                        <th>In Time <span style="color:red">*</span></th>
                                        <th>Out Time <span style="color:red">*</span></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control" id="branch_id" name="branch_id">
                                                @php
                                                //echo App\Models\Branch::getDropDownList('title');
                                                @endphp
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" id="dept_id" name="dept_id">
                                                @php
                                                //echo App\Models\Department::getDropDownList('title');
                                                @endphp
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" id="section_id" name="section_id">
                                                @php
                                                //echo App\Models\Section::getDropDownList('title');
                                                @endphp
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" id="sub_section_id" name="sub_section_id">
                                                @php
                                                //echo App\Models\SubSection::getDropDownList('title');
                                                @endphp
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="entry_date" name="entry_date" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="in_time" name="in_time" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="out_time" name="out_time" />
                                        </td>
                                        <td style="text-align: right">
                                            <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Add To Grid" class="addToGrid">
                                                <img class="addDownImg" src="{{ url('app_assets') }}/images/add-down.png">
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr> -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:4%">Sl No</th>
                                        <th style="width:5%">ChkBox</th>
                                        <th style="width:11%">Branch</th>
                                        <th style="width:11%">Department</th>
                                        <th style="width:11%">Section</th>
                                        <th style="width:11%">Sub-section</th>
                                        <th style="width:11%">Employee Name</th>
                                        <th style="width:11%">Date</th>
                                        <th style="width:11%">In Time</th>
                                        <th style="width:11%">Out Time</th>
                                    </tr>
                                </thead>
                                <tbody id="addedData">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--- End Create Model--->
<style>
    .toolbar {
        float: right;
        margin-left: 10px
    }
</style>
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
        ajax: '{{ url("empAttendence/admin") }}',
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'branch',
                name: 'branch'
            },
            {
                data: 'dept',
                name: 'dept'
            },
            {
                data: 'section',
                name: 'section'
            },
            {
                data: 'sub_section',
                name: 'sub_section'
            },
            {
                data: 'full_name',
                name: 'full_name'
            },
            {
                data: 'device_id',
                name: 'device_id'
            },
            {
                data: 'attendence_date',
                name: 'attendence_date'
            },
            {
                data: 'in_time',
                name: 'in_time'
            },
            {
                data: 'out_time',
                name: 'out_time'
            },
            {
                data: 'manual_device',
                name: 'manual_device'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],

        initComplete: function() {
            this.api().columns([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]).every(function() {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? val : '', true, false).draw();
                    });
            });
            this.api().columns([10]).every(function() {
                var column = this;
                var select = $('<select><option value=""></option></select>')
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
                    select.append('<option value="Device">' + 'Device' + '</option>')
                    select.append('<option value="Manual">' + 'Manual' + '</option>')
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

    $("#entry_date").datepicker({ //timepicker for time only, datepicker for date only
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
    });
    $("#in_time, #out_time").timepicker({ //timepicker for time only, datepicker for date only
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
    });


    $('#branch_id').on('change', function() {
        var branchId = $(this).val();
        if (branchId) {
            $.ajax({
                url: "{{ url('ajaxSearchDeptByBranchIds') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "branch_ids":branchId
                },
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $('#dept_id').empty();
                        // $('#dept_id').focus;
                        // $('#dept_id').append('<option value="">Select Department</option>');
                        $.each(data, function(key, value) {
                            $('#dept_id').append('<option value="' + value.id + '">' + value.title + '</option>');
                        });
                    }
                }
            });
        }
    });

    $('#dept_id').on('change', function() {
        var dept_id = $(this).val();
        if (dept_id) {
            $.ajax({
                url: "{{ url('ajaxSearchSectionByDeptIds') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "department_ids":dept_id
                },
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $('#section_id').empty();
                        // $('#section_id').focus;
                        // $('#section_id').append('<option value="">Select Section</option>');
                        $.each(data, function(key, value) {
                            $('#section_id').append('<option value="' + value.id + '">' + value.title + '</option>');
                        });
                    }
                }
            });
        }
    });

    $('#section_id').on('change', function() {
        var section_id = $(this).val();
        if (section_id) {
            $.ajax({
                url: "{{ url('ajaxSearchSubSectionBySectionIds') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "section_ids":section_id
                },
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $('#sub_section_id').empty();
                        // $('#sub_section_id').focus;
                        // $('#sub_section_id').append('<option value="">Select Sub Section</option>');
                        $.each(data, function(key, value) {
                            $('#sub_section_id').append('<option value="' + value.id + '">' + value.title + '</option>');
                        });
                    }
                }
            });
        }
    });

    $('body').on('click', '.addToGrid', function() {
        var entry_date = $("#entry_date").val();
        var in_time = $("#in_time").val();
        var out_time = $("#out_time").val();

        if (entry_date == "") {
            alert("Please Enter Date");
            return false;
        }
        if (in_time == "") {
            alert("Please Enter In Time");
            return false;
        }

        if (out_time == "") {
            alert("Please Enter Out Time");
            return false;
        }

        $.ajax({
            data: $('#dataForm').serialize(),
            url: "{{ url('ajaxSearchEmployeeForEmpAttendence') }}",
            type: "POST",
            success: function(data) {
                console.log(data);
                if (data.success) {
                    $('#addedData').html(data.html);
                } else {
                    toastr.error('No data available.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
                console.log(xhr);
                toastr.error('Failed to retrieve data. Please try again.');
            }
        });
        // ----------------------------------
    });



    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        var selectedRows = [];
        $("#addedData tr").each(function() {
            console.log(55);
            var isChecked = $(this).find('.isChecked').prop('checked');
            if (isChecked) {
                var rowData = {
                    branchId: $(this).find('[name="temp_branch_id[]"]').val(),
                    deptId: $(this).find('[name="temp_dept_id[]"]').val(),
                    sectionId: $(this).find('[name="temp_section_id[]"]').val(),
                    subSectionId: $(this).find('[name="temp_sub_section_id[]"]').val(),
                    empId: $(this).find('[name="temp_emp_id[]"]').val(),
                    deviceId: $(this).find('[name="temp_device_id[]"]').val(),
                    designationId: $(this).find('[name="temp_designation_id[]"]').val(),
                    entryDate: $(this).find('[name="temp_entry_date[]"]').val(),
                    inTime: $(this).find('[name="temp_in_time[]"]').val(),
                    outTime: $(this).find('[name="temp_out_time[]"]').val()
                };
                selectedRows.push(rowData);
            }
        });

        $.ajax({
            data: {
                attendence: selectedRows
            },
            url: "{{ url('empAttendence/create') }}",
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
                    location.reload(null, false);
                    $('#saveBtn').html('Save');
                }
            },
            error: function(data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save');
            }
        });
    });

    $('body').on('click', '.deleteData', function() {
        var data_id = $(this).data("id");
        if (confirm("Are You sure want to delete !")) {
            $.ajax({
                type: "GET",
                url: "{{ url('empAttendence/delete') }}" + '/' + data_id,
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