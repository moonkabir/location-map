<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;


class MapController extends Controller
{
    public function admin(Request $request)
    {
        if ($request->ajax()) {
            $dataGrid = DB::table('maps')->get();
            return DataTables::of($dataGrid)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id ="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editData">Edit</a>';
                    $btn .=  ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteData">Delete</a>';
                    return $btn;
                })
                ->editColumn('type', function ($dataGrid) {
                    if ($dataGrid->type == '1')
                        return 'House';
                    if ($dataGrid->type == '2')
                        return 'Hand Pump';
                })
                ->editColumn('status', function ($dataGrid) {
                    if ($dataGrid->status == '1')
                        return 'Active';
                    if ($dataGrid->status == '2')
                        return 'InActive';
                    return 'Cancel';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('map.admin');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        Map::insert([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'type' => $request->type,
            'details' => $request->details,
        ]);        
        return response()->json(['success' => 'Date saved successfully.']);
    }

    public function edit($id)
    {
        $data = Map::where('id', $id)->first();
        return response()->json(['data' => $data]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        Map::where('id', $request->data_id)->update([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'type' => $request->type,
            'details' => $request->details,
            'status' => $request->status,
        ]);
        return response()->json(['success' => 'Date Update successfully.']);
    }


    // public function fileEntry(Request $request)
    // {
    //     return view('map.file');
    // }


    // public function file(Request $request)
    // {
    //     $i = 0;
    //     foreach ($request->temp_emp_id as $emp_id) {
    //         EmpAttendence::insert([
    //             'attendence_date' => $request->temp_entry_date[$i],
    //             'branch_id' => $request->temp_branch_id[$i],
    //             'dept_id' => $request->temp_dept_id[$i],
    //             'section_id' => $request->temp_section_id[$i],
    //             'sub_section_id' => $request->temp_sub_section_id[$i],
    //             'designation_id' => $request->temp_designation_id[$i],
    //             'emp_id' => $emp_id,
    //             'device_id' => $request->temp_device_id[$i],
    //             'in_time' => $request->temp_in_time[$i],
    //             'out_time' => $request->temp_out_time[$i],
    //             'manual_device' => 2,
    //             'created_at' => Carbon::now()
    //         ]);
    //         $i++;
    //     }
    //     return response()->json(['success' => 'Date saved successfully.']);
    // }

    public function delete($id)
    {
        Map::where('id',$id)->delete();
        return response()->json(['success' => 'Date Deleted successfully.']);
    }

    public function view(){
        return view('map.view');
    }
    public function mapData(){
        $data = Map::all();
        return response($data);
    }
    public function viewDetails($id){
        return view('map.view-details',compact('id'));
    }
    public function viewDetailsData($id){
        $data = Map::find($id);
        return response($data);
    }
}
