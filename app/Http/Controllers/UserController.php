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
use Public\Documents;
use Public\images;
use Mail;
use DataTables;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Department;

class UserController extends Controller
{
     //Register User Form
    public function indexUser(){
        $roles=Role::all();
        $departments=Department::all();
        return view('register_user',compact('roles','departments'));
    } 

    //Create User
    public function createUser(Request $request){
        // dd($request);
        $data = new User;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=$request->password;
        $data->department=$request->department_id;
        $data->syncRoles($request->roles);
        $data->save();
        
        return redirect('registeruser')->with('msg','User Created Succesfully!');
    }

    //User Table
    public function userTable(Request $request){
        if ($request->ajax()) {
            $users = User::with('roles.permissions')->get();
            
            return Datatables::of($users)->addIndexColumn()
                ->addColumn('action', function($users){
                    return  '<a href="user/edit/'.$users->id.'"><i style="color:green; margin-right:10px"class="ik ik-edit-2 f-16"></i></a>
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

    public function editUser($id){
        $roles=Role::all();
        $departments=Department::all();
        $userDetails=User::where('id',$id)->firstorFail();
        return view('register_user',compact('userDetails','departments','roles'));
    }

    public function updateUser(Request $request, $id){
        
        $user=User::where('id',$id)->update(['name'=>$request->name,
        'email'=>$request->email,'password'=>$request->password,
        'department'=>$request->department_id
        ]);
        
        return redirect('users')->with('msg','User Updated!');
    }
    public function getUser()
    {
        // $user = auth()->user();
        // $user = Auth::user();
        // dd($user);
        
        // $ticket_data = Tickets_Admin::get();
        // foreach($ticket_data as $data){
        //     $ticket_lead_id=$data['ticket_lead'];
        //     $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
        //     $data['ticket_lead']=$ticket_lead->id;
        //     $data['ticket_lead_name']=$ticket_lead->name;
           
        // }
        $user=Auth::user();
        $mytickets=Tickets_Admin::where('assign_to',$user->id)->where('status','Open')->get();
        $allroles = '';
        foreach($user->roles as $role){
            $allroles .= $role->name . ' | ';
        }
        return view('userdetails', compact('user','mytickets','allroles'));

    }
 
}
