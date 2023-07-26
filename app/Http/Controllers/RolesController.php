<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use DataTables;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
class RolesController extends Controller
{
        //Role Form
        public function indexRole(Request $request){
            $permissions=Permission::all();
            return view('role_form',compact('permissions'));
        }  
    
        //Create Role
        public function createRole(Request $request){
            $role=new Role;
            $role->name=$request->role_name;
            $role->syncPermissions($request->permissions);
            $role->save();
            return redirect('registerrole')->with('msg','Role Created!');
        }  
        
        public function roleTable(Request $request){
        if ($request->ajax()) {
            $roles = Role::all();
            return Datatables::of($roles)->addIndexColumn()
                ->addColumn('action', function($roles){
                    return  '<a href="role/edit/'.$roles->id.'"><i style="color:green; margin-right:10px"class="ik ik-edit-2 f-16"></i></a>
                            <a><i style="color:red;"class="ik ik-trash-2 f-16"></i></a>';
                            
                })
                ->addColumn('permission',function($role){
                    $badges='';
                    
                        foreach($role->permissions as $permission){
                            $badges .= '<span class="badge badge-info m-1">' . $permission->name . '</span>';
                        }
                    
                    return $badges;
                })
                ->rawColumns(['action','permission'])                   
                ->make(true);
        }
        return view('role_form');
    }

    public function editRole($id){
        $role=Role::where('id',$id)->firstorFail();
        $permissions=Permission::all();

        return view('edit-role',compact('role','permissions'));
    }
}
