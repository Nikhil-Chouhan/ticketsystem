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

class CompanyController extends Controller
{
    //Save Company
    public function registerCompany(Request $request){
        dd($request);
        $data=$request->validate([
            'company_name'=>'required',
            'company_address'=>'required',
            'company_city'=>'required',
            'contactperson_name'=>'required',
            'contactperson_number'=>'required|max:10',
            'contactperson_email'=>'required',
        ]);

        $company_details=new Companymaster;
        $company_details->company_name=$request->company_name;
        $company_details->company_address=$request->company_address;
        $company_details->city=$request->company_city;
        $company_details->gst_number=$request->gst_number;
        
        $company_details->contactperson_name=$request->contactperson_name;
        $company_details->contactperson_number=$request->contactperson_number;
        $company_details->contactperson_email=$request->contactperson_email;
       // dd($company_details);
        $company_details->save();
        return redirect('companyregister')->with('msg','Saved Succesfully');
    }
    
    //Get Company Details
    public function getCompanyDetails(Request $request){
        $companydetails = Companymaster::where('id', $request->companyid)->firstorFail();
        return($companydetails); 
    }

    //Company Master Table
    public function companyMaster(Request $request){
        
        if ($request->ajax()) {
            $data = Companymaster::latest()->get();
            
            return Datatables::of($data)->addIndexColumn()
                // ->addColumn('action', function(){
                //     return  '<button id="btngo" class="btngo btn btn-outline-success">Submit</button>';
                //     //return $btn;
                // })
                // ->rawColumns(['action'])                   
                ->make(true);
        }
    
        return view('company_master');
    }
 
}
