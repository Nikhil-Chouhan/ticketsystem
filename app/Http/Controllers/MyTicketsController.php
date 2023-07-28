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
class MyTicketsController extends Controller
{
    //User Open Tickets
    public function getUserOpenTickets(Request $request){
       
        $user = Auth::user();
        $myTickets=Tickets_Admin::where('assign_to',$user->id)->where('status','Open')->get();
        
        foreach($myTickets as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
            $assign_id=$data['assign_to'];
            $ticket_lead_id=$data['ticket_lead'];

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();

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
        }
        if ($request->ajax()) {
            return Datatables::of($myTickets)->addIndexColumn()
                ->addColumn('ticket_lead', function ($myTickets) {
                    $badge='<span class="badge badge-info m-1">'.$myTickets->ticket_lead_name.'</span>';
                    return $badge;
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update btn btn-outline-success btn-sm">UPDATE</button>';
                })
                ->addColumn('assign_to', function($myTickets){
                    $badge='<span class="badge badge-info m-1">'.$myTickets->assign_to.'</span>';
                    return $badge;
                })
                ->rawColumns(['ticket_lead','update','assign_to'])                   
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
        $myTickets=Tickets_Admin::where('assign_to',$user->id)->where('status','Work In Progress')->get();
        $testers=Role::where('name', 'Tester')->first()->users;
        foreach($myTickets as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
            $assign_id=$data['assign_to'];

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();

            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['assign_to_id']=$assign_to->id;
            $data['assign_to_name']=$assign_to->name;
        }
        if ($request->ajax()) {
            return Datatables::of($myTickets)->addIndexColumn()
                ->addColumn('ticket_id', function ($myTickets) {
                    return '<a href="ticketdetail/'.$myTickets->ticket_id.'">'.$myTickets->ticket_id.'</a>';
                    
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update btn btn-outline-success btn-sm">UPDATE</button>';
                })
                ->addColumn('assign_to', function($myTickets){
                    $badge='<span class="badge badge-info m-1">'.$myTickets->assign_to_name.'</span>';
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
                ->rawColumns(['ticket_id','update','assign_to','push_to'])                   
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
        $myTickets=Tickets_Admin::where('assign_to', $user->id)->where('status','QnA')->get();
        foreach($myTickets as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
            $assign_id=$data['assign_to'];
            $tester_id=$data['assigned_tester'];

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $assign_tester_name=User::where('id',$tester_id)->firstorFail();
            

            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['assign_to_id']=$assign_to->id;
            $data['assign_to_name']=$assign_to->name;
            $data['assigned_tester']=$assign_tester_name->name;
        }
        if ($request->ajax()) {
            return Datatables::of($myTickets)->addIndexColumn()
                ->addColumn('ticket_id', function ($myTickets) {
                    return '<a href="ticketdetail/'.$myTickets->ticket_id.'">'.$myTickets->ticket_id.'</a>';
                    
                })
                // ->addColumn('update', function(){
                //     return  '<button id="update" class="update btn btn-outline-success btn-sm">UPDATE</button>';
                // })
                ->addColumn('assign_to', function($myTickets){
                    $badge='<span class="badge badge-info m-1">'.$myTickets->assign_to_name.'</span>';
                    return $badge;
                })
                ->addColumn('assigned_tester', function($myTickets){
                    $badge='<span class="badge badge-danger m-1">'.$myTickets->assigned_tester.'</span>';
                    return $badge;
                })
                ->rawColumns(['ticket_id','assign_to','assigned_tester'])                   
                ->editColumn('created_at',function($myTickets){
                    return date('d-M-y', strtotime($myTickets->created_at));
                })
                ->make(true);
        }
        return view('my_QnA_tickets');
    }

    public function getFailedQna(Request $request){
        $user = Auth::user();
        $myTickets=Tickets_Admin::where('assign_to', $user->id)->where('status','QnA Fail')->get();
        
        foreach($myTickets as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
            $assign_id=$data['assign_to'];
            $tester_id=$data['assigned_tester'];

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $assign_tester_name=User::where('id',$tester_id)->firstorFail();
            

            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['assign_to_id']=$assign_to->id;
            $data['assign_to_name']=$assign_to->name;
            $data['assigned_tester']=$assign_tester_name->name;
        }
        if ($request->ajax()) {
            return Datatables::of($myTickets)->addIndexColumn()
                ->addColumn('ticket_id', function ($myTickets) {
                    return '<a href="ticketdetail/'.$myTickets->ticket_id.'">'.$myTickets->ticket_id.'</a>';
                    
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update btn btn-outline-success btn-sm">UPDATE</button>';
                })
                ->addColumn('assign_to', function($myTickets){
                    $badge='<span class="badge badge-info m-1">'.$myTickets->assign_to_name.'</span>';
                    return $badge;
                })
                ->addColumn('assigned_tester', function($myTickets){
                    $badge='<span class="badge badge-danger m-1">'.$myTickets->assigned_tester.'</span>';
                    return $badge;
                })
                ->rawColumns(['ticket_id','assign_to','assigned_tester','update'])                   
                ->editColumn('created_at',function($myTickets){
                    return date('d-M-y', strtotime($myTickets->created_at));
                })
                ->make(true);
        }
        return view('my_FailedQnA_tickets');
    } 
}
