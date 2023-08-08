<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Image;
use App\Models\Tickets_Admin;
use App\Models\User;
use App\Models\Companymaster;
use App\Models\Productmaster;
use App\Models\Servicemaster;
use App\Models\Branchmaster;
use App\Models\Progress;
use App\Models\Department;
use Spatie\Permission\Models\Role;
use App\Mail\TicketMailTemplate; 
use App\Models\Status;
use DataTables;
use Mail;

class ManageTicketsController extends Controller
{

    public function liveTicketsView(){
        $users=Role::where('name', 'Developer')->first()->users;
        $ticketlead=Role::where('name', 'Project Manager')->first()->users;
        $status=Status::whereIn('id',['1','2'])->get();
        return view('live_tickets',compact('users','ticketlead','status'));
    }

    //Display Live Tickets
    public function liveTickets(Request $request){
        $ticket_data = Tickets_Admin::get();
        
        foreach($ticket_data as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
            $assign_id=$data['assign_to'];
            $ticket_lead_id=$data['ticket_lead'];
            $department_id=$data['department'];
            $status_id=$data['status'];

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
            $department=Department::where('id',$department_id)->firstorFail();
            $status=Status::where('id',$status_id)->firstorFail();

            if($assign_id!=null)
            {
                $assign_to=User::where('id',$assign_id)->firstorFail();
            }
            
            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['assign_to_id']=$assign_to->id;
            $data['assign_to_name']=$assign_to->name;

            $data['ticket_lead']=$ticket_lead->id;
            $data['ticket_lead_name']=$ticket_lead->name;

            $data['department']=$department->id;
            $data['department_name']=$department->department;

            $data['status']=$status->id;
            $data['status_name']=$status->status_name;
        }

        if ($request->ajax()) {
            return Datatables::of($ticket_data)->addIndexColumn()
                ->addColumn('ticket_id', function ($ticket_data) {
                    return '<a href="ticketdetail/'.$ticket_data->ticket_id.'">'.$ticket_data->ticket_id.'</a>';
                    
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update btn btn-outline-success btn-sm">UPDATE</button>';
                })
                ->addColumn('ticket_lead', function($ticket_data) {
                    $dropdown='<select class="btn btn-secondary dropdown-toggle" >';
                    $dropdown .='<option value="'.$ticket_data->ticket_lead.'">'.$ticket_data->ticket_lead_name.'</option>';
                    $ticketleads=Role::where('name', 'Project Manager')->first()->users->whereNotIn('id', [$ticket_data->ticket_lead]);
                        foreach($ticketleads as $lead){
                            $dropdown .= '<option value="'.$lead->id.'">'.$lead->name.'</option>';
                        }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('status', function($ticket_data) {
                    $dropdown='<select class="status btn btn-warning dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->status.'">'.$ticket_data->status_name.'</option>';
                    $allstatus=Status::whereNotIn('id', [$ticket_data->status])->get();
        
                        foreach($allstatus as $status){
                            $dropdown .= '<option value="'.$status->id.'">'.$status->status_name.'</option>';
                        }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('department', function($ticket_data){
                    $dropdown='<select class="btn btn-info dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->department.'">'.$ticket_data->department_name.'</option>';
                    $departments=Department::whereNotIn('id',[$ticket_data->department])->get();
        
                        foreach($departments as $department){
                            $dropdown .= '<option value="'.$department->id.'">'.$department->department.'</option>';
                        }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('assign_to', function($ticket_data) {
                    $dropdown='<select class="btn btn-info dropdown-toggle" name="support_type">';
                    $dropdown .='<option value="'.$ticket_data->assign_to_id.'">'.$ticket_data->assign_to_name.'</option>';
                    $users=Role::where('name', 'Developer')->first()->users->whereNotIn('id', [$ticket_data->assign_to_id]);
        
                        foreach($users as $user){
                            $dropdown .= '<option value="'.$user->id.'">'.$user->name.'</option>';
                        }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                
                ->rawColumns(['ticket_id','update','assign_to','ticket_lead','department','status'])       
                // ->rawColumns(['ticket_id','update','assign_to'])                   
                ->editColumn('created_at',function($ticket_data){
                    return date('d-M-y', strtotime($ticket_data->created_at));
                })
                ->make(true);
        }
        return view('live_tickets');
    }

    //Get Requested Live Tickets
    public function getLiveTickets(Request $request){
        
        if ($request->ajax()) {
            if($request->assign_to!=null && $request->ticket_lead!=null && $request->status!=null)
            {
                $ticket_data = Tickets_Admin::where('assign_to',$request->assign_to)
                ->where('ticket_lead',$request->ticket_lead) 
                ->where('status',$request->status)
                ->get();
            }
            elseif($request->ticket_lead!=null && $request->status!=null){
                $ticket_data = Tickets_Admin::where('ticket_lead',$request->ticket_lead)
                ->where('status',$request->status)->get(); 
            }
            elseif($request->assign_to!=null && $request->ticket_lead!=null){
                $ticket_data = Tickets_Admin::where('assign_to',$request->assign_to)
                ->where('ticket_lead',$request->ticket_lead)->get(); 
            }elseif($request->assign_to!=null && $request->status!=null){
                $ticket_data = Tickets_Admin::where('assign_to',$request->assign_to)
                ->where('status',$request->status)->get(); 
            }
            else{

                $ticket_data = Tickets_Admin::where('assign_to',$request->assign_to)
                ->orWhere('ticket_lead',$request->ticket_lead) 
                ->orWhere('status',$request->status)
                ->get();
            }
            foreach($ticket_data as $data){
                $productDetails=$data['product'];
                $serviceDetails=$data['service'];
                $companyId=$data['company_id'];
                $branchId=$data['branch_id'];
                $assign_id=$data['assign_to'];
                $ticket_lead_id=$data['ticket_lead'];
                $department_id=$data['department'];
                $status_id=$data['status'];

                $productId=explode(',',$productDetails);
                $serviceId=explode(',',$serviceDetails);
                
                $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
                $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
                $company_details=Companymaster::where('id',$companyId)->firstorFail();
                $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            
                $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
                $department=Department::where('id',$department_id)->firstorFail();
                $status=Status::where('id',$status_id)->firstorFail();

                if($assign_id!=null){
                    $assign_to=User::where('id',$assign_id)->firstorFail();
                }
                
                $product_name=$product_name->implode('product_name',',');
                $service_name=$service_name->implode('service_name',',');
                
                $data['product']=$product_name;
                $data['service']=$service_name;
                $data['company_name']=$company_details->company_name;
                $data['branch_name']=$branch_details->branch_name;
                
                $data['assign_to_id']=$assign_to->id;
                $data['assign_to_name']=$assign_to->name;

                $data['ticket_lead']=$ticket_lead->id;
                $data['ticket_lead_name']=$ticket_lead->name;

                $data['department']=$department->id;
                $data['department_name']=$department->department;

                $data['status']=$status->id;
                $data['status_name']=$status->status_name;
            }
            return Datatables::of($ticket_data)->addIndexColumn()   
                ->addColumn('ticket_id', function ($ticket_data) {
                    return '<a href="ticketdetail/'.$ticket_data->ticket_id.'">'.$ticket_data->ticket_id.'</a>';
                    
                })
                ->addColumn('ticket_lead', function($ticket_data){
                    $dropdown='<select class="btn btn-secondary dropdown-toggle" name="support_type">';
                    $dropdown .='<option value="'.$ticket_data->ticket_lead.'">'.$ticket_data->ticket_lead_name.'</option>';
                    $ticketlead=Role::where('name', 'Project Manager')->first()->users->whereNotIn('id', [$ticket_data->ticket_lead]);
                    
                    foreach($ticketlead as $lead){
                        $dropdown .= '<option value="'.$lead->id.'">'.$lead->name.'</option>';
                    }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('department', function($ticket_data) {
                    $dropdown='<select class="btn btn-info dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->department.'">'.$ticket_data->department_name.'</option>';
                    $departments=Department::whereNotIn('id',[$ticket_data->department])->get();
        
                        foreach($departments as $department){
                            $dropdown .= '<option value="'.$department->id.'">'.$department->department.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('assign_to', function($ticket_data) {
                    $dropdown='<select class="btn btn-info dropdown-toggle" name="support_type">';
                    $dropdown .='<option value="'.$ticket_data->assign_to_id.'">'.$ticket_data->assign_to_name.'</option>';
                    $users=Role::where('name', 'Developer')->first()->users->whereNotIn('id', [$ticket_data->assign_to_id]);
        
                    foreach($users as $user){
                        $dropdown .= '<option value="'.$user->id.'">'.$user->name.'</option>';
                    }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('status', function($ticket_data) {
                    $dropdown='<select class="status btn btn-warning dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->status.'">'.$ticket_data->status_name.'</option>';
                    $allstatus=Status::whereNotIn('id', [$ticket_data->status])->get();
        
                        foreach($allstatus as $status){
                            $dropdown .= '<option value="'.$status->id.'">'.$status->status_name.'</option>';
                        }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update1 btn btn-outline-success btn-sm">Update</button>';
                    //return $btn;
                })
                ->rawColumns(['ticket_id','update','ticket_lead','assign_to','department','status'])                   
                ->editColumn('created_at',function($ticket_data){
                    return date('d-M-y', strtotime($ticket_data->created_at));
                })
                ->make(true);
        }
        
        return($ticket_data);
    }

    public function inQnA(Request $request){
        $ticket_data = Tickets_Admin::where('status','3')->get();
      
        foreach($ticket_data as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
            $assign_id=$data['assign_to'];
            $ticket_lead_id=$data['ticket_lead'];
            $tester_id=$data['assigned_tester'];
            $department_id=$data['department'];
            $status_id=$data['status'];

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
            $tester=User::where('id',$tester_id)->firstorFail();
            $department=Department::where('id',$department_id)->firstorFail();
            $status=Status::where('id',$status_id)->firstorFail();
            
            if($assign_id!=null){
                $assign_to=User::where('id',$assign_id)->firstorFail();
            }
            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['ticket_lead']=$ticket_lead->id;
            $data['ticket_lead_name']=$ticket_lead->name;
            
            $data['assign_to_id']=$assign_to->id;
            $data['assign_to_name']=$assign_to->name;
            
            $data['assigned_tester']=$tester->id;
            $data['assigned_tester_name']=$tester->name;

            $data['department']=$department->id;
            $data['department_name']=$department->department;

            $data['status']=$status->id;
            $data['status_name']=$status->status_name;
        }
        if ($request->ajax()) {
            return Datatables::of($ticket_data)->addIndexColumn()
                ->addColumn('ticket_id', function ($ticket_data) {
                    return '<a href="ticketdetail/'.$ticket_data->ticket_id.'">'.$ticket_data->ticket_id.'</a>';
                    
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update btn btn-outline-success btn-sm">UPDATE</button>';
                })
                ->addColumn('ticket_lead', function($ticket_data) {
                    $dropdown='<select class="btn btn-secondary dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->ticket_lead.'">'.$ticket_data->ticket_lead_name.'</option>';
                    $ticketlead=Role::where('name', 'Project Manager')->first()->users->whereNotIn('id', [$ticket_data->ticket_lead]);
                   
                        foreach($ticketlead as $lead){
                            $dropdown .= '<option value="'.$lead->id.'">'.$lead->name.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('department', function($ticket_data) {
                    $dropdown='<select class="btn btn-info dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->department.'">'.$ticket_data->department_name.'</option>';
                    $departments=Department::whereNotIn('id',[$ticket_data->department])->get();
        
                        foreach($departments as $department){
                            $dropdown .= '<option value="'.$department->id.'">'.$department->department.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('assign_to', function($ticket_data){
                    $dropdown='<select class="btn btn-info dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->assign_to_id.'">'.$ticket_data->assign_to_name.'</option>';
                    $users=Role::where('name', 'Developer')->first()->users->whereNotIn('id', [$ticket_data->assign_to_id]);
        
                        foreach($users as $user){
                            $dropdown .= '<option value="'.$user->id.'">'.$user->name.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('assigned_tester', function($ticket_data) {
                    $dropdown='<select class="btn btn-danger dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->assigned_tester.'">'.$ticket_data->assigned_tester_name.'</option>';
                    $testers=Role::where('name', 'Tester')->first()->users->whereNotIn('id',[$ticket_data->assigned_tester]);
                        foreach($testers as $tester){
                            $dropdown .= '<option value="'.$tester->id.'">'.$tester->name.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('status', function($ticket_data) {
                    $dropdown='<select class="status btn btn-warning dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->status.'">'.$ticket_data->status_name.'</option>';
                    $allstatus=Status::whereNotIn('id', [$ticket_data->status])->get();
        
                        foreach($allstatus as $status){
                            $dropdown .= '<option value="'.$status->id.'">'.$status->status_name.'</option>';
                        }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->rawColumns(['ticket_id','update','assign_to','ticket_lead','assigned_tester','department','status'])                   
                ->editColumn('created_at',function($ticket_data){
                    return date('d-M-y', strtotime($ticket_data->created_at));
                })
                ->make(true);
        }
        return view('inQnA');
    }

    public function failedQnA(Request $request){
        
        $ticket_data = Tickets_Admin::where('status','5')->get();
        foreach($ticket_data as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
            $assign_id=$data['assign_to'];
            $ticket_lead_id=$data['ticket_lead'];
            $tester_id=$data['assigned_tester'];
            $department_id=$data['department'];
            $status_id=$data['status'];

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
            $tester=User::where('id',$tester_id)->firstorFail();
            $department=Department::where('id',$department_id)->firstorFail();
            $status=Status::where('id',$status_id)->firstorFail();

            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['ticket_lead']=$ticket_lead->id;
            $data['ticket_lead_name']=$ticket_lead->name;
            
            $data['assign_to_id']=$assign_to->id;
            $data['assign_to_name']=$assign_to->name;
            
            $data['assigned_tester']=$tester->id;
            $data['assigned_tester_name']=$tester->name;

            $data['department']=$department->id;
            $data['department_name']=$department->department;

            $data['status']=$status->id;
            $data['status_name']=$status->status_name;
        }
        if ($request->ajax()) {
            return Datatables::of($ticket_data)->addIndexColumn()
                ->addColumn('ticket_id', function ($ticket_data) {
                    return '<a href="ticketdetail/'.$ticket_data->ticket_id.'">'.$ticket_data->ticket_id.'</a>';
                    
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update btn btn-outline-success btn-sm">UPDATE</button>';
                })
                ->addColumn('ticket_lead', function($ticket_data) {
                    $dropdown='<select class="btn btn-secondary dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->ticket_lead.'">'.$ticket_data->ticket_lead_name.'</option>';
                    $ticketlead=Role::where('name', 'Project Manager')->first()->users->whereNotIn('id', [$ticket_data->ticket_lead]);
                   
                        foreach($ticketlead as $lead){
                            $dropdown .= '<option value="'.$lead->id.'">'.$lead->name.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('department', function($ticket_data) {
                    $dropdown='<select class="btn btn-info dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->department.'">'.$ticket_data->department_name.'</option>';
                    $departments=Department::whereNotIn('id',[$ticket_data->department])->get();
        
                        foreach($departments as $department){
                            $dropdown .= '<option value="'.$department->id.'">'.$department->department.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('assign_to', function($ticket_data){
                    $dropdown='<select class="btn btn-info dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->assign_to_id.'">'.$ticket_data->assign_to_name.'</option>';
                    $users=Role::where('name', 'Developer')->first()->users->whereNotIn('id', [$ticket_data->assign_to_id]);
        
                        foreach($users as $user){
                            $dropdown .= '<option value="'.$user->id.'">'.$user->name.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('assigned_tester', function($ticket_data) {
                    $dropdown='<select class="btn btn-danger dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->assigned_tester.'">'.$ticket_data->assigned_tester_name.'</option>';
                    $testers=Role::where('name', 'Tester')->first()->users->whereNotIn('id',[$ticket_data->assigned_tester]);
                        foreach($testers as $tester){
                            $dropdown .= '<option value="'.$tester->id.'">'.$tester->name.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('status', function($ticket_data) {
                    $dropdown='<select class="status btn btn-warning dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->status.'">'.$ticket_data->status_name.'</option>';
                    $allstatus=Status::whereNotIn('id', [$ticket_data->status])->get();
        
                        foreach($allstatus as $status){
                            $dropdown .= '<option value="'.$status->id.'">'.$status->status_name.'</option>';
                        }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->rawColumns(['ticket_id','update','assign_to','ticket_lead','assigned_tester','department','status'])                   
                ->editColumn('created_at',function($ticket_data){
                    return date('d-M-y', strtotime($ticket_data->created_at));
                })
                ->make(true);
        }
        return view('failQnA');
    }

    public function approveQnA(Request $request){
        $ticket_data = Tickets_Admin::where('status','4')->get();

        foreach($ticket_data as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
            $assign_id=$data['assign_to'];
            $ticket_lead_id=$data['ticket_lead'];
            $tester_id=$data['assigned_tester'];
            $department_id=$data['department'];
            $status_id=$data['status'];

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
            $tester=User::where('id',$tester_id)->firstorFail();
            $department=Department::where('id',$department_id)->firstorFail();
            $status=Status::where('id',$status_id)->firstorFail();


            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['ticket_lead']=$ticket_lead->id;
            $data['ticket_lead_name']=$ticket_lead->name;
            
            $data['assign_to_id']=$assign_to->id;
            $data['assign_to_name']=$assign_to->name;
            
            $data['assigned_tester']=$tester->id;
            $data['assigned_tester_name']=$tester->name;

            $data['department']=$department->id;
            $data['department_name']=$department->department;

            $data['status']=$status->id;
            $data['status_name']=$status->status_name;

        }
        if ($request->ajax()) {
            return Datatables::of($ticket_data)->addIndexColumn()
                ->addColumn('ticket_id', function ($ticket_data) {
                    return '<a href="ticketdetail/'.$ticket_data->ticket_id.'">'.$ticket_data->ticket_id.'</a>';
                    
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update btn btn-outline-success btn-sm">UPDATE</button>';
                })
                ->addColumn('ticket_lead', function($ticket_data) {
                    $dropdown='<select class="btn btn-secondary dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->ticket_lead.'">'.$ticket_data->ticket_lead_name.'</option>';
                    $ticketlead=Role::where('name', 'Project Manager')->first()->users->whereNotIn('id', [$ticket_data->ticket_lead]);
                   
                        foreach($ticketlead as $lead){
                            $dropdown .= '<option value="'.$lead->id.'">'.$lead->name.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('department', function($ticket_data) {
                    $dropdown='<select class="btn btn-info dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->department.'">'.$ticket_data->department_name.'</option>';
                    $departments=Department::whereNotIn('id',[$ticket_data->department])->get();
        
                        foreach($departments as $department){
                            $dropdown .= '<option value="'.$department->id.'">'.$department->department.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('assign_to', function($ticket_data){
                    $dropdown='<select class="btn btn-info dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->assign_to_id.'">'.$ticket_data->assign_to_name.'</option>';
                    $users=Role::where('name', 'Developer')->first()->users->whereNotIn('id', [$ticket_data->assign_to_id]);
        
                        foreach($users as $user){
                            $dropdown .= '<option value="'.$user->id.'">'.$user->name.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('assigned_tester', function($ticket_data) {
                    $dropdown='<select class="btn btn-danger dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->assigned_tester.'">'.$ticket_data->assigned_tester_name.'</option>';
                    $testers=Role::where('name', 'Tester')->first()->users->whereNotIn('id',[$ticket_data->assigned_tester]);
                        foreach($testers as $tester){
                            $dropdown .= '<option value="'.$tester->id.'">'.$tester->name.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('status', function($ticket_data) {
                    $dropdown='<select class="status btn btn-warning dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->status.'">'.$ticket_data->status_name.'</option>';
                    $allstatus=Status::whereNotIn('id', [$ticket_data->status])->get();
        
                        foreach($allstatus as $status){
                            $dropdown .= '<option value="'.$status->id.'">'.$status->status_name.'</option>';
                        }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->rawColumns(['ticket_id','update','assign_to','ticket_lead','assigned_tester','status'])                   
                ->editColumn('created_at',function($ticket_data){
                    return date('d-M-y', strtotime($ticket_data->created_at));
                })
                ->make(true);
        }
        return view('approveQnA');
    }


    public function closeTicket(Request $request){
        $ticketdata = Tickets_Admin::where('status','6')->get();
        $users=Role::where('name', 'Developer')->first()->users;
        $testers=Role::where('name', 'Tester')->first()->users;
        $ticketlead=Role::where('name', 'Project Manager')->first()->users;
        foreach($ticketdata as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
            $assign_id=$data['assign_to'];
            $ticket_lead_id=$data['ticket_lead'];
            $tester_id=$data['assigned_tester'];
            $department_id=$data['department'];
            $status_id=$data['status'];

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
            $tester=User::where('id',$tester_id)->firstorFail();
            $department=Department::where('id',$department_id)->firstorFail();
            $status=Status::where('id',$status_id)->firstorFail();

            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['ticket_lead']=$ticket_lead->id;
            $data['ticket_lead_name']=$ticket_lead->name;
            
            $data['assign_to_id']=$assign_to->id;
            $data['assign_to_name']=$assign_to->name;
            
            $data['assigned_tester_id']=$tester->id;
            $data['assigned_tester_name']=$tester->name;

            $data['department']=$department->id;
            $data['department_name']=$department->department;

            $data['status']=$status->id;
            $data['status_name']=$status->status_name;
                        
        }
        if ($request->ajax()) {
            return Datatables::of($ticketdata)->addIndexColumn()
                    ->addColumn('ticket_id', function ($ticketdata) {
                        return '<a href="ticketdetail/'.$ticketdata->ticket_id.'">'.$ticketdata->ticket_id.'</a>';
                        
                    })
                    ->addColumn('ticket_lead_name', function($ticketdata){
                        $badge='<span class="badge badge-secondary m-1">'.$ticketdata->ticket_lead_name.'</span>';
                        return $badge;
                    })
                    ->addColumn('department_name', function($ticketdata){
                        $badge='<span class="badge badge-info m-1">'.$ticketdata->department_name.'</span>';
                        return $badge;
                    })
                    ->addColumn('assign_to', function($ticketdata){
                        $badge='<span class="badge badge-info m-1">'.$ticketdata->assign_to_name.'</span>';
                        return $badge;
                    })
                    ->addColumn('status', function($ticketdata){
                        $badge='<span class="badge badge-warning m-1">'.$ticketdata->status_name.'</span>';
                        return $badge;
                    })
                    ->addColumn('assigned_tester', function($ticketdata){
                        $badge='<span class="badge badge-danger m-1">'.$ticketdata->assigned_tester_name.'</span>';
                        return $badge;
                    })
                    ->addColumn('update', function(){
                        return  '<button id="reopen" class="update btn btn-outline-success btn-sm">ReOpen</button>';
                    })
                    ->rawColumns(['ticket_id','ticket_lead_name','assign_to','assigned_tester','update','department_name','status'])                   
                    ->editColumn('created_at',function($ticketdata){
                        return date('d-M-y', strtotime($ticketdata->created_at));
                    })
                ->make(true);
        }
        return view('close_ticket');
    }


    public function updateTicket(Request $request){
        $ticket=Tickets_Admin::where('ticket_id',$request->ticket_id)
        ->update(["status" => $request->status,
                "ticket_lead" => $request->ticket_lead,
                "assign_to" => $request->assign_to,
                "assigned_tester" => $request->assigned_tester,
                "priority" => $request->priority,
            ]);
        return ($ticket);

    } 

   
    // //Get Open Tickets
    // public function openTicket(Request $request){
    //     $ticket_data = Tickets_Admin::where('status','Open')->get();
    //     $users=Role::where('name', 'Developer')->first()->users;
    //     $ticketlead=Role::where('name', 'Project Manager')->first()->users;

    //     if ($request->ajax()) {
    //         return Datatables::of($ticket_data)->addIndexColumn()
    //             ->addColumn('ticket_id', function ($ticket_data) {
    //                 return '<a href="ticketdetail/'.$ticket_data->ticket_id.'">'.$ticket_data->ticket_id.'</a>';
                    
    //             })
    //             ->addColumn('update', function(){
    //                 return  '<button id="update" class="update btn btn-outline-warning btn-sm">Update</button>';
    //                 //return $btn;
    //             })
    //             ->rawColumns(['ticket_id','update'])                   
    //             ->editColumn('created_at',function($ticket_data){
    //                 return date('d-M-y', strtotime($ticket_data->created_at));
    //             })
    //             ->make(true);
    //     }
    //     return view('open_ticket');
    // }

    //Work in Progress
    // public function workinprogress(Request $request){
    //     if ($request->ajax()) {
    //         $data = Tickets_Admin::where('status','Work in Progress')->get();
        
    //         return Datatables::of($data)->addIndexColumn()
    //             ->addColumn('ticket_id', function ($data) {
    //                 return '<a href="ticketdetail/'.$data->ticket_id.'">'.$data->ticket_id.'</a>';
                    
    //             })
    //             ->addColumn('action', function(){
    //                 return  '<button id="update" class="update btn btn-outline-warning btn-sm">Update</button>
    //                  <button id="progress" class="ticketprogress btn btn-outline-success btn-sm">Progress</button>';
                
    //             })
    //             // ->addColumn('progress', function(){
    //             //     return '<button id="progress" class="ticketprogress btn btn-outline-success btn-sm">Progress</button>';
                
    //             //})
    //             ->rawColumns(['ticket_id','action'])                   
    //             ->editColumn('created_at',function($data){
    //                 return date('d-M-y', strtotime($data->created_at));
    //             })
    //             ->make(true);
    //     }
        
    //     return view('work_in_progress');
    // }
}
