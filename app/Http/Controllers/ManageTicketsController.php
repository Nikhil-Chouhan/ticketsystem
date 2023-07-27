<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets_Admin;
use App\Models\User;
use App\Models\Companymaster;
use App\Models\Productmaster;
use App\Models\Servicemaster;
use App\Models\Branchmaster;
use App\Models\Progress;
use Spatie\Permission\Models\Role;
use DataTables;
class ManageTicketsController extends Controller
{
    public function approveQnA(Request $request){
        $ticket_data = Tickets_Admin::where('status','QnA Pass')->get();
        $users=Role::where('name', 'Developer')->first()->users;
        $testers=Role::where('name', 'Tester')->first()->users;
        $ticketlead=Role::where('name', 'Project Manager')->first()->users;
        foreach($ticket_data as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
            $assign_id=$data['assign_to'];
            $ticket_lead_id=$data['ticket_lead'];
            $tester_id=$data['assigned_tester'];

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
            $tester=User::where('id',$tester_id)->firstorFail();

            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['ticket_lead_id']=$ticket_lead->id;
            $data['ticket_lead']=$ticket_lead->name;
            
            $data['assign_to_id']=$assign_to->id;
            $data['assign_to_name']=$assign_to->name;
            
            $data['assigned_tester']=$tester->id;
            $data['assigned_tester_name']=$tester->name;
        }
        if ($request->ajax()) {
            return Datatables::of($ticket_data)->addIndexColumn()
                ->addColumn('ticket_id', function ($ticket_data) {
                    return '<a href="ticketdetail/'.$ticket_data->ticket_id.'">'.$ticket_data->ticket_id.'</a>';
                    
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update btn btn-outline-success btn-sm">UPDATE</button>';
                })
                ->addColumn('assign_to', function($ticket_data) use($users) {
                    $dropdown='<select class="btn btn-info dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->assign_to_id.'">'.$ticket_data->assign_to_name.'</option>';
                    
                        foreach($users as $user){
                            $dropdown .= '<option value="'.$user->id.'">'.$user->name.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('assigned_tester', function($ticket_data) use($testers) {
                    $dropdown='<select class="btn btn-danger dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->assigned_tester.'">'.$ticket_data->assigned_tester_name.'</option>';
                    
                        foreach($testers as $tester){
                            $dropdown .= '<option value="'.$tester->id.'">'.$tester->name.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->addColumn('ticket_lead', function($ticket_data) use($ticketlead) {
                    $dropdown='<select class="btn btn-secondary dropdown-toggle">';
                    $dropdown .='<option value="'.$ticket_data->ticket_lead_id.'">'.$ticket_data->ticket_lead.'</option>';
                    
                        foreach($ticketlead as $lead){
                            $dropdown .= '<option value="'.$lead->id.'">'.$lead->name.'</option>';
                        }
                    $dropdown .='</select>';
                    return $dropdown;
                })
                ->rawColumns(['ticket_id','update','assign_to','ticket_lead','assigned_tester'])                   
                ->editColumn('created_at',function($ticket_data){
                    return date('d-M-y', strtotime($ticket_data->created_at));
                })
                ->make(true);
        }
        return view('approveQnA');
    }

    public function closeticketAdmin(Request $request){
        $ticket=Tickets_Admin::where('ticket_id',$request->ticket_id)
        ->update(["status" => $request->status,
                "ticket_lead" => $request->ticket_lead,
                "assign_to" => $request->assign_to,
                "assigned_tester" => $request->assigned_tester,
                "priority" => $request->priority,
            ]);
        return ($ticket);

    } 

    public function closeTicket(Request $request){
        $ticketdata = Tickets_Admin::where('status','Close')->get();
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

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $ticket_lead=User::where('id',$ticket_lead_id)->firstorFail();
            $tester=User::where('id',$tester_id)->firstorFail();

            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['ticket_lead_id']=$ticket_lead->id;
            $data['ticket_lead']=$ticket_lead->name;
            
            $data['assign_to_id']=$assign_to->id;
            $data['assign_to_name']=$assign_to->name;
            
            $data['assigned_tester']=$tester->id;
            $data['assigned_tester_name']=$tester->name;
        }
        if ($request->ajax()) {
            return Datatables::of($ticketdata)->addIndexColumn()
                    ->addColumn('ticket_id', function ($ticketdata) {
                        return '<a href="ticketdetail/'.$ticketdata->ticket_id.'">'.$ticketdata->ticket_id.'</a>';
                        
                    })
                    ->addColumn('ticket_lead', function($ticketdata){
                        $badge='<span class="badge badge-secondary m-1">'.$ticketdata->ticket_lead.'</span>';
                        return $badge;
                    })
                    ->addColumn('assign_to', function($ticketdata){
                        $badge='<span class="badge badge-info m-1">'.$ticketdata->assign_to_name.'</span>';
                        return $badge;
                    })
                    ->addColumn('assigned_tester', function($ticketdata){
                        $badge='<span class="badge badge-danger m-1">'.$ticketdata->assigned_tester_name.'</span>';
                        return $badge;
                    })
                    ->addColumn('update', function(){
                        return  '<button id="update" class="update btn btn-outline-warning btn-sm">Update</button>
                        <button id="delete" class="delete btn btn-outline-danger btn-sm">Delete</button>';
                    })
                    ->rawColumns(['ticket_id','update','ticket_lead','assign_to','assigned_tester'])                   
                    ->editColumn('created_at',function($ticketdata){
                        return date('d-M-y', strtotime($ticketdata->created_at));
                    })
                ->make(true);
        }
        return view('close_ticket');
    }
}
