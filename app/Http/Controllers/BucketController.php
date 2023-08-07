<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Tickets_Admin;
use App\Models\Progress;
use App\Models\Companymaster;
use App\Models\Productmaster;
use App\Models\Servicemaster;
use App\Models\Branchmaster;
use App\Models\User;
use App\Models\Department;
use Spatie\Permission\Models\Role;
use DataTables;
class BucketController extends Controller
{
    //Support Bucket
    public function supportBucket(Request $request)
    {
        $ticket_data = Tickets::where('isLive',0)->where('escalate',0)->get();
        $users=Role::where('name', 'Developer')->first()->users;
        $ticketlead=Role::where('name', 'Project Manager')->first()->users;
        $departments=Department::get();
        foreach($ticket_data as $data){
            $data['product_id']=$data['product'];
            $data['service_id']=$data['service'];

            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];

            // $productId = str_contains($productDetails, ',') ? explode(',',$productDetails) : $productDetails;
            // $serviceId = str_contains($serviceDetails, ',') ? explode(',',$serviceDetails) : $serviceDetails;
            // if (str_contains($productDetails, ',')) { 
            // }
            // if (str_contains($serviceDetails, ',')) { 
            // }
            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
        
            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;
            
        }

        if ($request->ajax()) {
            
            return Datatables::of($ticket_data)
                ->addIndexColumn()
                ->addColumn('id', function ($ticket_data) {
                    return '<a href="ticketdetail/'.$ticket_data->id.'">'.$ticket_data->id.'</a>';
                    
                })
                ->addColumn('ticket_lead', function($ticket_data) use($ticketlead ) {
                    $dropdown='<div class="basic-dropdown">';
                    $dropdown.='<select class="ticket_lead btn btn-secondary dropdown-toggle">';
                    $dropdown .='<option value="">Ticket Lead</option>';
                    
                        foreach($ticketlead as $lead){
                            $dropdown .= '<option value="'.$lead->id.'">'.$lead->name.'</option>';
                        }
                        $dropdown .='</select>';
                        $dropdown .='</div>';
                    return $dropdown;
                })
                ->addColumn('assign_to', function($ticket_data) {
                    $dropdown='<select id="assign_to" class="assign_to btn btn-info dropdown-toggle ">';
                    $dropdown .='<option value="">Assignee</option>';
                        // foreach($users as $user){
                        //     $dropdown .= '<option value="'.$user->id.'">'.$user->name.'</option>';
                        // }
                        
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('department', function($ticket_data) use($departments) {
                    $dropdown='<select class="btn btn-info dropdown-toggle department">';
                    $dropdown .='<option value="">Department</option>';
                    
                        foreach($departments as $department){
                            $dropdown .= '<option value="'.$department->id.'">'.$department->department.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('action', function(){
                    return  '<button id="btnsave" class="btnsave btn btn-outline-success">Open Ticket</button>';
                    //return $btn;
                })
                ->rawColumns(['id','action','ticket_lead','assign_to','department'])                   
                ->editColumn('created_at',function($ticket_data){
                    return date('d-M-y', strtotime($ticket_data->created_at));
                })
                ->make(true);
        }
        // return($ticket_data);
        return view('support_bucket');
    }

    //Project Management Bucket
    public function pmBucket(Request $request){
        $ticket_data = Tickets::where('escalate',1)->where('isLive',0)->get();
        $users=Role::where('name', 'Developer')->first()->users;
        $ticketlead=Role::where('name', 'Project Manager')->first()->users;
        $departments=Department::get();

        foreach($ticket_data as $data){
            $data['product_id']=$data['product'];
            $data['service_id']=$data['service'];

            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
        
            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
        
            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;
            
        }
        if ($request->ajax()) {
            
            return Datatables::of($ticket_data)->addIndexColumn()
                ->addColumn('id', function ($ticket_data) {
                    return '<a href="ticketdetail/'.$ticket_data->id.'">'.$ticket_data->id.'</a>';
                    
                })
                ->addColumn('assign_to', function($ticket_data) use($users) {
                    $dropdown='<select id="assign_to" class="btn btn-info dropdown-toggle assign_to">';
                    $dropdown .='<option value="">Assignne</option>';
                    
                        // foreach($users as $user){
                        //     $dropdown .= '<option value="'.$user->id.'">'.$user->name.'</option>';
                        // }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('ticket_lead', function($ticket_data) use($ticketlead ) {
                    $dropdown='<select class="ticket_lead btn btn-secondary dropdown-toggle">';
                    $dropdown .='<option value="">Ticket Lead</option>';
                    
                        foreach($ticketlead as $lead){
                            $dropdown .= '<option value="'.$lead->id.'">'.$lead->name.'</option>';
                        }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('department', function($ticket_data) use($departments) {
                    $dropdown='<select class="btn btn-info dropdown-toggle department">';
                    $dropdown .='<option value="">Department</option>';
                    
                        foreach($departments as $department){
                            $dropdown .= '<option value="'.$department->id.'">'.$department->department.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('action', function(){
                    return  '<button id="btnsave" class="btnsave btn btn-outline-success">Open Ticket</button>';
                    //return $btn;
                })
                ->rawColumns(['id','assign_to','ticket_lead','action','department'])                   
                ->editColumn('created_at',function($ticket_data){
                    return date('d-M-y', strtotime($ticket_data->created_at));
                })
                ->make(true);
        }
        // return($ticket_data);
        return view('pm_bucket');
    }

    //Management Bucket
    public function managementBucket(Request $request){
        $ticket_data = Tickets::where('escalate',2)->where('isLive',0)->get();
        $users=Role::where('name', 'Developer')->first()->users;
        $ticketlead=Role::where('name', 'Project Manager')->first()->users;
        $departments=Department::get();
        foreach($ticket_data as $data){
            $data['product_id']=$data['product'];
            $data['service_id']=$data['service'];

            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
        
            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;
            
        }

        if ($request->ajax()) {
            
            return Datatables::of($ticket_data)->addIndexColumn()
                ->addColumn('id', function ($ticket_data) {
                    return '<a href="ticketdetail/'.$ticket_data->id.'">'.$ticket_data->id.'</a>';
                    
                })
                ->addColumn('assign_to', function($ticket_data) use($users) {
                    $dropdown='<select id="assign_to" class="btn btn-info dropdown-toggle assign_to">';
                    $dropdown .='<option value="">Assignne</option>';
                    
                        // foreach($users as $user){
                        //     $dropdown .= '<option value="'.$user->id.'">'.$user->name.'</option>';
                        // }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('ticket_lead', function($ticket_data) use($ticketlead ) {
                    $dropdown='<select class="ticket_lead btn btn-secondary dropdown-toggle">';
                    $dropdown .='<option value="">Ticket Lead</option>';
                    
                        foreach($ticketlead as $lead){
                            $dropdown .= '<option value="'.$lead->id.'">'.$lead->name.'</option>';
                        }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('department', function($ticket_data) use($departments) {
                    $dropdown='<select class="btn btn-info dropdown-toggle department">';
                    $dropdown .='<option value="">Department</option>';
                    
                        foreach($departments as $department){
                            $dropdown .= '<option value="'.$department->id.'">'.$department->department.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('action', function(){
                    return  '<button id="btnsave" class="btnsave btn btn-outline-success">Open Ticket</button>';
                    //return $btn;
                })
                ->rawColumns(['id','action','ticket_lead','assign_to','department'])                   
                ->editColumn('created_at',function($ticket_data){
                    return date('d-M-y', strtotime($ticket_data->created_at));
                })
                ->make(true);
        }
        // return($ticket_data);
        return view('management_bucket');
    }


    //Store Ticket in Admin Table
    public function ticketStore(Request $request){
    // DB::beginTransaction();
        
        $details=new Tickets_Admin;
        
        $details->ticket_id=$request->ticket_id;
        $details->company_id=$request->company_id;
        $details->branch_id=$request->branch_id;
        $details->branch_code=$request->branch_code;
        $details->product=$request->product;
        $details->service=$request->service;
        $details->support_type=$request->support_type;
        $details->exec_name=$request->exec_name; //new add
        $details->exec_email=$request->exec_email; //new add
        $details->exec_number=$request->exec_number; // new add
        // $details->issue_type=$request->issue_type; //new add
        $details->ticket_lead=$request->ticket_lead;
        $details->ticket_raised=$request->ticket_raised;
        $details->assign_to=$request->assign_to;
        $details->status=$request->status;
        $details->priority=$request->priority;
        $details->department=$request->department;
        $details->save(); 

        $progress=new Progress;
        $progress->ticket_id=$request->ticket_id;
        $progress->ticket_lead=$request->ticket_lead;
        $progress->ticket_assignee=$request->assign_to;
        $progress->status=$request->status;
        $progress->save();
        
        if (isset($details)) {
            $data=Tickets::where('id',$request->ticket_id)->update(['isLive'=>1]);  

        }
        return($progress);
        //DB::commit();
        
    }

    public function getDepartmentUsers(Request $request){
       
        $users=User::where('department',$request->department_id)->get();
        return($users);
    }
    
}
