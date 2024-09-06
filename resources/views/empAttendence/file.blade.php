@extends('layouts.master')

@section('header_css')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')

<style>
    #part1 {
        border: 1px solid black;
        width: 612px;
        margin: 25px;
        border-radius: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    @media only screen and (max-width: 768px) {
        #part1 {
            border: 1px solid black;
            width: 320px;
            margin: 5px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    }
</style>

<div id="part_main">
    <div id="part1">
        <form action="">
            <div class="" style="margin:20px;padding:25px; width:250px !important">
                <label class="label"> Date </label>
                <input type="text" name="date" id="entry_date" class="form-control">
            </div>

            <div style="margin-left:20px; padding-left:25px;width:250px !important">
                <label> File </label>
                <input type="file" name="date" id="date" class="form-control">
            </div>
            <button class="btn btn-primary" style="margin: 20px 200px;"> Upload </button>
        </form>
    </div>
</div>
@endsection

@section('footer_js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
            data: $('#dataForm').serialize(),
            url: "{{ url('empAttendence/file') }}",
            type: "POST",
            dataType: 'json',
            success: function(result) {

            },
            error: function(data) {

            }
        });
    });

    $("#entry_date").datepicker({ //timepicker for time only, datepicker for date only
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
    });
</script>

@endsection
