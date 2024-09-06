<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EmpAttendence;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth ;
use Yajra\DataTables\DataTables;

class EmpAttendenceController extends Controller
{
    public function admin(Request $request)
    {
        if ($request->ajax()) {
            $dataGrid = DB::table('hrm_emp_attendence')
                ->leftJoin('hrm_emp_basic_official', 'hrm_emp_attendence.emp_id', '=', 'hrm_emp_basic_official.id')
                ->leftJoin('hrm_branch', 'hrm_emp_attendence.branch_id', '=', 'hrm_branch.id')
                ->leftJoin('hrm_dept', 'hrm_emp_attendence.dept_id', '=', 'hrm_dept.id')
                ->leftJoin('hrm_section', 'hrm_emp_attendence.section_id', '=', 'hrm_section.id')
                ->leftJoin('hrm_sub_section', 'hrm_emp_attendence.sub_section_id', '=', 'hrm_sub_section.id')
                ->leftJoin('hrm_designation', 'hrm_emp_attendence.designation_id', '=', 'hrm_designation.id')
                ->where('hrm_emp_attendence.is_deleted', 1)
                ->select('hrm_emp_attendence.*', 'hrm_emp_basic_official.full_name as full_name', 'hrm_branch.title as branch', 'hrm_dept.title as dept', 'hrm_section.title as section', 'hrm_sub_section.title as sub_section', 'hrm_designation.title as  designation')
                ->orderBy('hrm_emp_attendence.id', 'desc')->get();
            return DataTables::of($dataGrid)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id ="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editData">Edit</a>';
                    $btn =  ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteData">Delete</a>';
                    return $btn;
                })
                ->editColumn('manual_device', function ($dataGrid) {
                    if ($dataGrid->manual_device == '1')
                        return 'Device';
                    if ($dataGrid->manual_device == '2')
                        return 'Manual';
                    return 'Cancel';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('empAttendence.admin');
    }



    public function create(Request $request)
    {
        $i = 0;
        foreach ($request->attendence as $data) {
            EmpAttendence::insert([
                'attendence_date' => $data['entryDate'],
                'branch_id' => $data['branchId'],
                'dept_id' => $data['deptId'],
                'section_id' => $data['sectionId'],
                'sub_section_id' => $data['subSectionId'],
                'designation_id' => $data['designationId'],
                'emp_id' => $data['empId'],
                'device_id' => $data['deviceId'],
                'in_time' => $data['inTime'],
                'out_time' => $data['outTime'],
                'manual_device' => 2,
                'created_at' => Carbon::now(),
                'created_by' => Auth::user()->id,
            ]);
            $i++;
        }
        return response()->json(['success' => 'Date saved successfully.']);
    }


    public function fileEntry(Request $request)
    {
        return view('empAttendence.file');
    }


    public function file(Request $request)
    {
        $i = 0;
        foreach ($request->temp_emp_id as $emp_id) {
            EmpAttendence::insert([
                'attendence_date' => $request->temp_entry_date[$i],
                'branch_id' => $request->temp_branch_id[$i],
                'dept_id' => $request->temp_dept_id[$i],
                'section_id' => $request->temp_section_id[$i],
                'sub_section_id' => $request->temp_sub_section_id[$i],
                'designation_id' => $request->temp_designation_id[$i],
                'emp_id' => $emp_id,
                'device_id' => $request->temp_device_id[$i],
                'in_time' => $request->temp_in_time[$i],
                'out_time' => $request->temp_out_time[$i],
                'manual_device' => 2,
                'created_at' => Carbon::now()
            ]);
            $i++;
        }
        return response()->json(['success' => 'Date saved successfully.']);
    }



    public function delete($id)
    {
        EmpAttendence::where('id', $id)->update([
            'is_deleted' => 2
        ]);
        return response()->json(['success' => 'Date Deleted successfully.']);
    }
}
