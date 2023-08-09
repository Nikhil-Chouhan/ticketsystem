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

class ServiceController extends Controller
{
    //Save Service
    public function saveService(Request $request){
        $data=$request->validate([
            'service_name'=>'required',
        ]);

        $service_details=new Servicemaster;
        $service_details->service_name=$request->service_name;
        $service_details->service_description=$request->service_description;
        $service_details->save();
        return redirect('serviceregister')->with('msg','Service Added Succesfully');
        
    }
    
    //Service Master 
    public function serviceMaster(Request $request){
    
        if ($request->ajax()) {
            $data = Servicemaster::get();
            
            return Datatables::of($data)->addIndexColumn()
                 ->addColumn('action', function($data){
                    return  '<a href="editservice/'.$data->id.'"<i class="ik ik-edit-2 f-16" style="color:green; margin-right:10px"></i></a>
                    <a href="servicedelete/'.$data->id.'"<i class="btndelete ik ik-trash-2 f-16" style="color:red;"></i></a>';
                })
                
                ->rawColumns(['action'])                   
                ->make(true);
        }
        return view('service_master');
    }
    
    public function editService($id){
        $serviceDetails=Servicemaster::where('id',$id)->first();

        return view('service_register',compact('serviceDetails'));
    }

    public function updateService(Request $request,$id){
        $updateService=Servicemaster::where('id',$id)->update(['service_name' => $request->service_name,
        'service_description' => $request->service_description,
        ]);
        return redirect('servicemaster')->with('msg','Service Updated Succesfully');
    }

    public function deleteService($id){
        // dd($id);
        $delete=Servicemaster::where('id',$id)->delete();
        return redirect()->back()->with('redalert','Service Deleted Succesfully');
    }
}
