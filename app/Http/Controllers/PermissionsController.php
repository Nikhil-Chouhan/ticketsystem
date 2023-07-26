<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
class PermissionsController extends Controller
{
    public function createPermission(Request $request){
        $permission=new Permission;
        $permission->name=$request->permission_name;
        $permission->save();
        return redirect('registerpermission')->with('msg','Permission Created! ');
    }
    
    public function permissionTable(Request $request){
        if ($request->ajax()) {
            $permission = Permission::all();
            return Datatables::of($permission)->addIndexColumn()
                ->addColumn('action', function($permission){
                    return  '<a href="permission/edit/'.$permission->id.'"><i style="color:green; margin-right:10px"class="ik ik-edit-2 f-16"></i></a>
                            <a><i style="color:red;"class="ik ik-trash-2 f-16"></i></a>';
                            
                })
                ->rawColumns(['action'])                   
                ->make(true);
        }
        return view('permission_form');

    }
    //Edit Permission
    public function editPermission($id){
       
        $permission = Permission::where('id',$id)->firstorFail();
        return view('edit-permission',compact('permission'));    
    }

    public function updatePermission($id,Request $request){
        $permission=Permission::where('id',$id)->update(['name'=>$request->permission_name]);
        return redirect('registerpermission')->with('msg','Updated!');
    }
}
