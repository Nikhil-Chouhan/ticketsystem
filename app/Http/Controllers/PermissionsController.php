<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Tickets_Admin;
use App\Models\Image;
use App\Models\Status;
use App\Models\User;
use App\Models\Progress;
use App\Models\Companymaster;
use App\Models\Productmaster;
use App\Models\Servicemaster;
use App\Models\Branchmaster;
use Public\images;
use Mail;
use DataTables;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{
    public function createPermission(Request $request){
        $permission=new Permission;
        $permission->name=$request->permission_name;
        $permission->save();
        return redirect('permissionmaster')->with('msg','Permission Created! ');
    }
    
    public function masterPermission(Request $request){
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
        return view('permissionmaster');

    }
    //Edit Permission
    public function editPermission($id){
       
        $permissionDetails = Permission::where('id',$id)->firstorFail();
        return view('permission_form',compact('permissionDetails'));    
    }

    public function updatePermission($id,Request $request){
        $permission=Permission::where('id',$id)->update(['name'=>$request->permission_name]);
        return redirect('permissionmaster')->with('msg','Permission Updated!');
    }
}
