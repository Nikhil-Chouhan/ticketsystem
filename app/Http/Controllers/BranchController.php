<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companymaster;
use App\Models\Productmaster;
use App\Models\Servicemaster;
use App\Models\Branchmaster;
class BranchController extends Controller
{
     //Branch Register Form
     public function registerBranch(){
        $companydetails = Companymaster::get();
        $productdetails =Productmaster::get();
        $servicedetails =Servicemaster::get();
        return view('branch_register',compact('companydetails','productdetails','servicedetails'));
    }

    //Get Company Details
    public function getCompanyDetails(Request $request){
        $companydetails = Companymaster::where('id', $request->companyid)->firstorFail();
        return($companydetails); 
    }

    //Save Branch
    public function saveBranch(Request $request){
        
        $branchdetails=new Branchmaster;
        $branchdetails->company_id=$request->companyid;
        $branchdetails->branch_name=$request->branch_name;
        $branchdetails->branch_address=$request->branch_address;
        $branchdetails->branch_contactperson_name=$request->branch_contactperson_name;
        $branchdetails->branch_contactperson_number=$request->branch_contactperson_number;
        $branchdetails->branch_contactperson_email=$request->branch_contactperson_email;
        $branchdetails->support_type=$request->support_type;
        $branchdetails->product=$request->product;
        $branchdetails->service=$request->service;
        
        $branchdetails->branch_code=$request->branch_code;

        $branchdetails->save();
        return($branchdetails);
    }

    //Branch Master
    public function masterBranch(Request $request){
        $branchdetails = Branchmaster::get();
        foreach($branchdetails as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            
            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            
            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_id']=$company_details->company_name;
        }
       // dd($company_details);
        if ($request->ajax()) {
        
            return Datatables::of($branchdetails)->addIndexColumn()
                ->addColumn('action', function($branchdetails){
                    return  '<a id="getLink" href="'.config('app.url').'/GetFormLink/'.$branchdetails->branch_code.'"  class="getLink btn btn-outline-success">Get Link</a>';
                    //return $btn;
                })
                ->addColumn('action', function($branchdetails){
                    return  '<a id="getLink" href="'.config('app.url').'/GetFormLink/'.$branchdetails->branch_code.'"  class="getLink btn btn-outline-success">Get Link</a>';
                    //return $btn;
                })
                ->rawColumns(['action'])                   
                ->make(true);
        }
        return view('branch_master');

    }

}
