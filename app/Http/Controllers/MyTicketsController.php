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
use App\Models\Department;
class MyTicketsController extends Controller
{

    //My Department Tickets
    public function myDepartmentTickets(Request $request){
        $user = Auth::user();
        $myTickets=Tickets_Admin::where('department','1')->where('assign_to',null)->where('status','1')->get();
        $assignees=User::where('department','1')->get();
        foreach($myTickets as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
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

            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['ticket_lead']=$ticket_lead->id;
            $data['ticket_lead_name']=$ticket_lead->name;

            $data['department']=$department->department;
            $data['status']=$status->id;
            $data['status_name']=$status->status_name;
        }
        if ($request->ajax()) {
            return Datatables::of($myTickets)->addIndexColumn()
                ->addColumn('ticket_id', function ($myTickets) {
                    return '<a href="ticketdetail/'.$myTickets->ticket_id.'">'.$myTickets->ticket_id.'</a>';
                    
                })
                ->addColumn('ticket_lead', function ($myTickets) {
                    $badge='<span class="badge badge-secondary m-1">'.$myTickets->ticket_lead_name.'</span>';
                    return $badge;
                })
                ->addColumn('department', function ($myTickets) {
                    $badge='<span class="badge badge-info m-1">'.$myTickets->department.'</span>';
                    return $badge;
                })
                ->addColumn('status', function ($myTickets) {
                    $badge='<span class="badge badge-warning m-1">'.$myTickets->status_name.'</span>';
                    return $badge;
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="inprogress btn btn-outline-success btn-sm">In Progress</button>';
                })
                ->addColumn('assign_to', function($ticket_data) use($assignees) {
                    $dropdown='<select id="assign_to" class="assign_to btn btn-info dropdown-toggle">';
                    $dropdown .='<option value="">Assignee</option>';
                        foreach($assignees as $assignee){
                            $dropdown .= '<option value="'.$assignee->id.'">'.$assignee->name.'</option>';
                        }
                        
                    $dropdown .='</select>';
                    return $dropdown;
                })
                
                ->rawColumns(['ticket_id','ticket_lead','update','assign_to','department','status'])                   
                ->editColumn('created_at',function($myTickets){
                    return date('d-M-y', strtotime($myTickets->created_at));
                })
                ->make(true);
        }
        return view('mydepartment');
    }

    //My Open Tickets
    public function getUserOpenTickets(Request $request){
        $user = Auth::user();
        $myTickets=Tickets_Admin::where('assign_to',$user->id)->where('status','1')->get();

        foreach($myTickets as $data){
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
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
            $department=Department::where('id',$department_id)->firstorFail();
            $status=Status::where('id',$status_id)->firstorFail();

            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['assign_to_id']=$assign_to->id;
            $data['assign_to']=$assign_to->name;
            
            $data['ticket_lead']=$ticket_lead->id;
            $data['ticket_lead_name']=$ticket_lead->name;
            $data['department']=$department->department;

            $data['status']=$status->id;
            $data['status_name']=$status->status_name;

        }
        if ($request->ajax()) {
            return Datatables::of($myTickets)->addIndexColumn()
                ->addColumn('ticket_id', function ($myTickets) {
                    return '<a href="ticketdetail/'.$myTickets->ticket_id.'">'.$myTickets->ticket_id.'</a>';
                    
                })
                ->addColumn('department', function ($myTickets) {
                    $badge='<span class="badge badge-info m-1">'.$myTickets->department.'</span>';
                    return $badge;
                })
                ->addColumn('ticket_lead', function ($myTickets) {
                    $badge='<span class="badge badge-secondary m-1">'.$myTickets->ticket_lead_name.'</span>';
                    return $badge;
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update btn btn-outline-success btn-sm">In Progress</button>';
                })
                ->addColumn('assign_to', function($myTickets){
                    $badge='<span class="badge badge-info m-1">'.$myTickets->assign_to.'</span>';
                    return $badge;
                })
                ->addColumn('status', function($myTickets){
                    $badge='<span class="badge badge-warning m-1">'.$myTickets->status_name.'</span>';
                    return $badge;
                })
                ->rawColumns(['ticket_id','ticket_lead','update','assign_to','department','status'])                   
                ->editColumn('created_at',function($myTickets){
                    return date('d-M-y', strtotime($myTickets->created_at));
                })
                ->make(true);
        }
        return view('my_open_tickets');
    }

    //User In Progress Tickets
    public function getUserInProgressTickets(Request $request){
        $user = Auth::user();
        $myTickets=Tickets_Admin::where('assign_to',$user->id)->where('status','2')->get();
        $testers=Role::where('name', 'Tester')->first()->users;
        foreach($myTickets as $data){
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
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
            $department=Department::where('id',$department_id)->firstorFail();
            $status=Status::where('id',$status_id)->firstorFail();

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
            $data['department']=$department->department;
            $data['status']=$status->id;
            $data['status_name']=$status->status_name;

        }
        if ($request->ajax()) {
            return Datatables::of($myTickets)->addIndexColumn()
                ->addColumn('ticket_id', function ($myTickets) {
                    return '<a href="ticketdetail/'.$myTickets->ticket_id.'">'.$myTickets->ticket_id.'</a>';
                    
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update btn btn-outline-success btn-sm">In QnA</button>';
                })
                ->addColumn('ticket_lead', function ($myTickets) {
                    $badge='<span class="badge badge-secondary m-1">'.$myTickets->ticket_lead_name.'</span>';
                    return $badge;
                })
                ->addColumn('department', function ($myTickets) {
                    $badge='<span class="badge badge-info m-1">'.$myTickets->department.'</span>';
                    return $badge;
                })
                ->addColumn('assign_to', function($myTickets){
                    $badge='<span class="badge badge-info m-1">'.$myTickets->assign_to_name.'</span>';
                    return $badge;
                })
                ->addColumn('status', function($myTickets){
                    $badge='<span class="badge badge-warning m-1">'.$myTickets->status_name.'</span>';
                    return $badge;
                })
                ->addColumn('push_to', function($ticket_data) use($testers ) {
                    $dropdown='<select class="btn btn-danger dropdown-toggle push_to">';
                    $dropdown .='<option value="">Select Tester</option>';
                    
                        foreach($testers as $tester){
                            $dropdown .= '<option value="'.$tester->id.'">'.$tester->name.'</option>';
                        }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->rawColumns(['ticket_id','update','assign_to','push_to','ticket_lead','department','status'])                   
                ->editColumn('created_at',function($myTickets){
                    return date('d-M-y', strtotime($myTickets->created_at));
                })
                ->make(true);
        }
        return view('my_inprogress_tickets');
    }

    //User QnA Tickets
    public function getUserQnATickets(Request $request){
        $user = Auth::user();
        $myTickets=Tickets_Admin::where('assign_to', $user->id)->where('status','4')->get();
        foreach($myTickets as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
            $assign_id=$data['assign_to'];
            $tester_id=$data['assigned_tester'];
            $ticket_lead_id=$data['ticket_lead'];
            $department_id=$data['department'];
            $status_id=$data['status'];

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $assign_tester_name=User::where('id',$tester_id)->firstorFail();
            $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
            $department=Department::where('id',$department_id)->firstorFail();
            $status=Status::where('id',$status_id)->firstorFail();

            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['assign_to_id']=$assign_to->id;
            $data['assign_to_name']=$assign_to->name;
            $data['assigned_tester']=$assign_tester_name->name;

            $data['ticket_lead']=$ticket_lead->id;
            $data['ticket_lead_name']=$ticket_lead->name;
            $data['department']=$department->department;

            $data['status']=$status->id;
            $data['status_name']=$status->status_name;
        }
        if ($request->ajax()) {
            return Datatables::of($myTickets)->addIndexColumn()
                ->addColumn('ticket_id', function ($myTickets) {
                    return '<a href="ticketdetail/'.$myTickets->ticket_id.'">'.$myTickets->ticket_id.'</a>';
                    
                })

                ->addColumn('ticket_lead', function ($myTickets) {
                    $badge='<span class="badge badge-secondary m-1">'.$myTickets->ticket_lead_name.'</span>';
                    return $badge;
                })
                ->addColumn('department', function ($myTickets) {
                    $badge='<span class="badge badge-info m-1">'.$myTickets->department.'</span>';
                    return $badge;
                })
                ->addColumn('assign_to', function($myTickets){
                    $badge='<span class="badge badge-info m-1">'.$myTickets->assign_to_name.'</span>';
                    return $badge;
                })
                ->addColumn('assigned_tester', function($myTickets){
                    $badge='<span class="badge badge-danger m-1">'.$myTickets->assigned_tester.'</span>';
                    return $badge;
                })
                ->addColumn('status', function($myTickets){
                    $badge='<span class="badge badge-warning m-1">'.$myTickets->status_name.'</span>';
                    return $badge;
                })
                ->rawColumns(['ticket_id','assign_to','assigned_tester','ticket_lead','department','status'])                   
                ->editColumn('created_at',function($myTickets){
                    return date('d-M-y', strtotime($myTickets->created_at));
                })
                ->make(true);
        }
        return view('my_QnA_tickets');
    }

    public function getFailedQna(Request $request){
        $user = Auth::user();
        $myTickets=Tickets_Admin::where('assign_to', $user->id)->where('status','5')->get();
        
        foreach($myTickets as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
            $assign_id=$data['assign_to'];
            $tester_id=$data['assigned_tester'];
            $ticket_lead_id=$data['ticket_lead'];
            $department_id=$data['department'];
            $status_id=$data['status'];


            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $assign_tester_name=User::where('id',$tester_id)->firstorFail();
            $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
            $department=Department::where('id',$department_id)->firstorFail();
            $status=Status::where('id',$status_id)->firstorFail();

            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['assign_to_id']=$assign_to->id;
            $data['assign_to_name']=$assign_to->name;
            $data['assigned_tester']=$assign_tester_name->name;
            $data['ticket_lead']=$ticket_lead->id;
            $data['ticket_lead_name']=$ticket_lead->name;
            $data['department']=$department->department;

            $data['status']=$status->id;
            $data['status_name']=$status->status_name;

        }
        if ($request->ajax()) {
            return Datatables::of($myTickets)->addIndexColumn()
                ->addColumn('ticket_id', function ($myTickets) {
                    return '<a href="ticketdetail/'.$myTickets->ticket_id.'">'.$myTickets->ticket_id.'</a>';
                    
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update btn btn-outline-success btn-sm">In QnA</button>';
                })
                ->addColumn('ticket_lead', function ($myTickets) {
                    $badge='<span class="badge badge-secondary m-1">'.$myTickets->ticket_lead_name.'</span>';
                    return $badge;
                })
                ->addColumn('department', function ($myTickets) {
                    $badge='<span class="badge badge-info m-1">'.$myTickets->department.'</span>';
                    return $badge;
                })
                ->addColumn('assign_to', function($myTickets){
                    $badge='<span class="badge badge-info m-1">'.$myTickets->assign_to_name.'</span>';
                    return $badge;
                })
                ->addColumn('assigned_tester', function($myTickets){
                    $badge='<span class="badge badge-danger m-1">'.$myTickets->assigned_tester.'</span>';
                    return $badge;
                })
                ->addColumn('status', function($myTickets){
                    $badge='<span class="badge badge-warning m-1">'.$myTickets->status_name.'</span>';
                    return $badge;
                })
                ->rawColumns(['ticket_id','ticket_lead','department','assign_to','assigned_tester','update','status'])                   
                ->editColumn('created_at',function($myTickets){
                    return date('d-M-y', strtotime($myTickets->created_at));
                })
                ->make(true);
        }
        return view('my_FailedQnA_tickets');
    } 

    public function updateMydepartment(Request $request){
        $departmentticket=Tickets_Admin::where('ticket_id',$request->ticket_id)->update(['assign_to'=>$request->assign_to,'status'=>$request->status]);
        return($request);
    }
}
