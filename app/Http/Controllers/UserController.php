<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
     //Register User Form
     public function indexUser(Request $request){
        $roles=Role::all();
        return view('register_user',compact('roles'));
    } 

    //Create User
    public function createUser(Request $request){
        //dd($request);
        $data = new User;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=$request->password;
        $data->syncRoles($request->roles);
        $data->save();
        
        return redirect('registeruser')->with('msg','User Created Succesfully');
    }

    //User Table
    public function userTable(Request $request){
        if ($request->ajax()) {
            $users = User::with('roles.permissions')->get();
            
            return Datatables::of($users)->addIndexColumn()
                ->addColumn('action', function($users){
                    return  '<a href="role/edit/'.$users->id.'"><i style="color:green; margin-right:10px"class="ik ik-edit-2 f-16"></i></a>
                            <a><i style="color:red;"class="ik ik-trash-2 f-16"></i></a>';
                            
                })
                ->addColumn('role',function($user){
                    $badges='';
                    
                        foreach($user->roles as $role){
                            $badges .= '<span class="badge badge-info m-1">' . $role->name . '</span>';
                        }
                    
                    return $badges;
                })
                ->rawColumns(['action','role'])                   
                ->make(true);
        }
        return view('user_master');
    }

    public function getUser()
    {
        // $user = auth()->user();
        $user = Auth::user();
        dd($user);
    }
}
