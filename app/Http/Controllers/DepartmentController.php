<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use DataTables;
class DepartmentController extends Controller
{
    public function saveDepartment(Request $request){

        $department_details=new Department;
        $department_details->department=$request->department_name;
        $department_details->save();
        return redirect('departmentregister')->with('msg','Department Added Succesfully');
    }

    public function departmentMaster(Request $request){
        if ($request->ajax()) {
            $data = Department::get();
            
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    //  return  '<a href="editproduct/'.$data->id.'" class="btn btn-outline-success">Edit</button>';
                        return  '<a href="editdepartment/'.$data->id.'"<i class="ik ik-edit-2 f-16" style="color:green; margin-right:10px"></i></a>
                        <a href="department/delete/'.$data->id.'"<i class="btndelete ik ik-trash-2 f-16" style="color:red;"></i></a>';
                    
                })
                ->rawColumns(['action'])                   
                ->make(true);
        }
    
        return view('departmentmaster');
    }

    public function departmentEdit($id)
    {
        $departmentDetails=Department::where('id',$id)->firstorFail();
        
        return view ('department_form',compact('departmentDetails'));
    }

    public function departmentUpdate(Request $request,$id){
        $updateDepartment=Department::where('id',$id)->update(['department' => $request->department_name]);
        return redirect('departmentmaster')->with('msg','Department Updated Succesfully');
    }

    public function departmentDelete($id){
        // dd($id);
        $delete=Department::where('id',$id)->delete();
        return redirect('departmentmaster')->with('msg','Department Deleted Succesfully');
    }
}
