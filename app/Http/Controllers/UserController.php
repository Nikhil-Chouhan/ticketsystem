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
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
     //Register User Form
    public function indexUser(){
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
        // $user = Auth::user();
        // dd($user);
        
        // $ticket_data = Tickets_Admin::get();
        // foreach($ticket_data as $data){
        //     $ticket_lead_id=$data['ticket_lead'];
        //     $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
        //     $data['ticket_lead']=$ticket_lead->id;
        //     $data['ticket_lead_name']=$ticket_lead->name;
           
        // }
        $ticket_lead=User::where('id',20)->firstorFail();
        dd($ticket_lead->id);
            
    }
}
