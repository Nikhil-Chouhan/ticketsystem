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

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //Display Live Tickets
    public function liveTickets(Request $request){
        $ticket_data = Tickets_Admin::get();
        
        $users=Role::where('name', 'Developer')->first()->users;

        foreach($ticket_data as $data){
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
            return Datatables::of($ticket_data)->addIndexColumn()
                ->addColumn('ticket_id', function ($ticket_data) {
                    return '<a href="ticketdetail/'.$ticket_data->ticket_id.'">'.$ticket_data->ticket_id.'</a>';
                    
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update btn btn-outline-success btn-sm">UPDATE</button>';
                })
                ->addColumn('assign_to', function($ticket_data) use($users) {
                    $dropdown='<select class="btn btn-info dropdown-toggle" name="support_type">';
                    $dropdown .='<option value="'.$ticket_data->assign_to_id.'">'.$ticket_data->assign_to_name.'</option>';
                    
                        foreach($users as $user){
                            $dropdown .= '<option value="'.$user->id.'">'.$user->name.'</option>';
                        }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->rawColumns(['ticket_id','update','assign_to'])                   
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
            if($request->assign_to!=null && $request->ticket_lead!=null)
            {
                $ticket_data = Tickets_Admin::where('assign_to',$request->assign_to)
                ->where('ticket_lead',$request->ticket_lead) 
                ->get();
            }
            else{

                $ticket_data = Tickets_Admin::where('assign_to',$request->assign_to)
                ->orWhere('ticket_lead',$request->ticket_lead) 
                ->get();
            }
            foreach($ticket_data as $data){
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
            return Datatables::of($ticket_data)->addIndexColumn()
                ->addColumn('ticket_id1', function ($ticket_data) {
                    return '<a href="ticketdetail/'.$ticket_data->ticket_id.'">'.$ticket_data->ticket_id.'</a>';
                    
                })
                ->addColumn('update1', function(){
                    return  '<button id="update" class="update1 btn btn-outline-warning btn-sm">Update</button>';
                    //return $btn;
                })
                ->rawColumns(['ticket_id1','update1'])                   
                ->editColumn('created_at1',function($ticket_data){
                    return date('d-M-y', strtotime($ticket_data->created_at));
                })
                ->make(true);
        }
        
    //   return view('live_tickets');
      return($ticket_data);
    }

    //ExplodeImage Function
    public function getImageAttribute($value)
    {
        if(empty($value)) return [];
        return explode(',', $value);
    }

    //Ticket Details Page
    public function ticketDetail($ticketid){
        //$getTicketDetails=Tickets::with('image')->where('id',$ticketid)->firstOrfail();
        $getTicketDetails=Tickets::join('image','image.tickets_id','=','tickets.id')->where('tickets.id',$ticketid)->first();
     
        $productDetails=$getTicketDetails->product;
        $serviceDetails=$getTicketDetails->service;
        $companyId=$getTicketDetails->company_id;
        $branchId=$getTicketDetails->branch_id;

        $productId=explode(',',$productDetails);
        $serviceId=explode(',',$serviceDetails);
        
        $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
        $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
        $company_details=Companymaster::where('id',$companyId)->firstorFail();
        $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
    
        $product_name=$product_name->implode('product_name',',');
        $service_name=$service_name->implode('service_name',',');
        
        $getTicketDetails->product=$product_name;
        $getTicketDetails->service=$service_name;
        $getTicketDetails->company_id=$company_details->company_name;
        $getTicketDetails->branch_id=$branch_details->branch_name;
        // dd($getTicketDetails);
        $images=$getTicketDetails->file;
        
        $imageFile=AdminController::getImageAttribute($images);

        return view('ticket-details',compact('getTicketDetails','imageFile'));
    }

    //Email Trigger 
    public function send_email() {
        $data = array('name'=>"Virat Gandhi");
     
        Mail::send(['text'=>'mail'], $data, function($message) {
           $message->to('thomasshelby077@gmail.com', 'Hello there')->subject
              ('Laravel Basic Testing Mail');
           $message->from('prathamdharawat123@gmail.com','Hi hi');
        });
        echo "Basic Email Sent. Check your inbox.";
    }

    //Get Open Tickets
    public function openTicket(Request $request){
        if ($request->ajax()) {
            $data = Tickets_Admin::where('status','Open')->get();
        
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('ticket_id', function ($data) {
                    return '<a href="ticketdetail/'.$data->ticket_id.'">'.$data->ticket_id.'</a>';
                    
                })
                ->addColumn('update', function(){
                    return  '<button id="update" class="update btn btn-outline-warning btn-sm">Update</button>';
                    //return $btn;
                })
                ->rawColumns(['ticket_id','update'])                   
                ->editColumn('created_at',function($data){
                    return date('d-M-y', strtotime($data->created_at));
                })
                ->make(true);
        }
        return view('open_ticket');
    }

    // Update Tickets
   public function updateTicket(Request $request) 
   {
        $openticket=Tickets_Admin::where('ticket_id',$request->ticket_id)->first();
        $openticket->ticket_lead=$request->ticket_lead;
        $openticket->assign_to=$request->assign_to;
        $openticket->status=$request->status;
        $openticket->priority=$request->priority;
        $openticket->save();

        $progress=new Progress;
        $progress->ticket_id=$request->ticket_id;
        $progress->ticket_lead=$request->ticket_lead;
        $progress->ticket_assignee=$request->assign_to;
        $progress->status=$request->status;
        $progress->save();
        
        return ($openticket);
    }

   
    public function workinprogress(Request $request){
        if ($request->ajax()) {
            $data = Tickets_Admin::where('status','Work in Progress')->get();
        
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('ticket_id', function ($data) {
                    return '<a href="ticketdetail/'.$data->ticket_id.'">'.$data->ticket_id.'</a>';
                    
                })
                ->addColumn('action', function(){
                    return  '<button id="update" class="update btn btn-outline-warning btn-sm">Update</button>
                     <button id="progress" class="ticketprogress btn btn-outline-success btn-sm">Progress</button>';
                
                })
                // ->addColumn('progress', function(){
                //     return '<button id="progress" class="ticketprogress btn btn-outline-success btn-sm">Progress</button>';
                
                //})
                ->rawColumns(['ticket_id','action'])                   
                ->editColumn('created_at',function($data){
                    return date('d-M-y', strtotime($data->created_at));
                })
                ->make(true);
        }
        
        return view('work_in_progress');
    }
   

    public function getProgress($ticket_id){
       // dd($ticket_id);
        //return($request);
        $progressdata = Progress::where('ticket_id',$ticket_id)->get();
        return view('progress',compact('progressdata'));
    }

    //generating form link
    public function getFormLink ($branch_code){
        $branchCode=Branchmaster::where('branch_code',$branch_code)->firstorFail();

        // if($branchCode==null)
        // {
        //     dd("not exists");
        // } 
        return view('ticketForm',compact('branch_code'));
    }

    //Submit Ticket
    public function ticketSubmit(Request $request){
        $branch_details=Branchmaster::where('branch_code',$request->branch_code)->firstorFail();
        $company_details=Companymaster::where('id',$branch_details->company_id)->firstorFail();   
        
        $imagePaths=[];
        $images = $request->ticket_image;
        if($images != null)
        {
            foreach($images as $image) {
                $file = $image->getClientOriginalName();
                $image->move('images/', $file);
            
                // $newfile = env('APP_URL').'public/images/' . $file;
                $newfile = config('app.url').'/images/' . $file;
                $imagePaths[] = $newfile;
            }
        }

        $ticket_details=new Tickets;
        $image=new Image;

        $ticket_details->isLive=0;
        $ticket_details->escalate=0;

        $ticket_details->company_id=$branch_details->company_id;
        $ticket_details->branch_id=$branch_details->id;
        // $ticket_details->branch_name=$branch_details->branch_name;
        // $ticket_details->company_name=$company_details->company_name;
        
        $ticket_details->product=$branch_details->product;
        $ticket_details->service=$branch_details->service;
        $ticket_details->support_type=$branch_details->support_type;

        $ticket_details->exec_name=$branch_details->branch_contactperson_name;
        $ticket_details->exec_number=$branch_details->branch_contactperson_number;
        $ticket_details->exec_email=$branch_details->branch_contactperson_email;
       
        $ticket_details->branch_code=$request->branch_code;
        $ticket_details->ticket_title=$request->ticket_title;
        $ticket_details->ticket_description=$request->ticket_description;
        // dd($ticket_details); 

        $ticket_details->save();

        //Store Image in Image table
        $image->file = implode(',', $imagePaths);
        // dd($image->file);
        $ticket_details = $ticket_details->image()->save($image);
        $branch_code=$request->branch_code;
        //return view('ticketForm',compact('branch_code'))->with('msg','Ticket Raised Succesfully');
        return redirect('GetFormLink/'.$branch_code)->with('msg','Ticket Raised Succesfully');
    }

    public function getRolePermission(Request $request){
        $role=Role::where('id',$request->id)->firstorFail();
        $permissions=[];
        foreach($role->permissions as $permission)
        {
            $permissions[]=$permission->id;
        }
        return($permissions);
    }

    public function getUserOpenTickets(Request $request){
       
        $user = Auth::user();
        $myTickets=Tickets_Admin::where('assign_to',$user->id)->where('status','Open')->get();
        
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
            $data['assign_to']=$assign_to->name;
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
                    $badge='<span class="badge badge-info m-1">'.$myTickets->assign_to.'</span>';
                    return $badge;
                })
                ->rawColumns(['ticket_id','update','assign_to'])                   
                ->editColumn('created_at',function($myTickets){
                    return date('d-M-y', strtotime($myTickets->created_at));
                })
                ->make(true);
        }
        return view('my_open_tickets');
    }
    
    public function updateMyTicket(Request $request){
        $openticket=Tickets_Admin::where('ticket_id',$request->ticket_id)->update(['status'=>$request->status]);
        return($openticket);
    }

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

    public function pushQnA(Request $request){
        $ticket=Tickets_Admin::where('ticket_id',$request->ticket_id)->first();
        $ticket->status=$request->status;
        $ticket->assigned_tester=$request->assigned_tester;
        $ticket->save();
        return($ticket);
    }

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

    public function getAssignedQnATickets(Request $request)
    {
        $user = Auth::user();
        $myTickets=Tickets_Admin::where('assigned_tester','18')->where('status','QnA')->get();
        
        foreach($myTickets as $data){
            $productDetails=$data['product'];
            $serviceDetails=$data['service'];
            $companyId=$data['company_id'];
            $branchId=$data['branch_id'];
            $assign_id=$data['assign_to'];
            $assigned_tester_id=$data['assigned_tester'];

            $productId=explode(',',$productDetails);
            $serviceId=explode(',',$serviceDetails);
            
            $product_name=Productmaster::select('product_name')->whereIn('id',$productId)->get();
            $service_name=Servicemaster::select('service_name')->whereIn('id',$serviceId)->get();
            $company_details=Companymaster::where('id',$companyId)->firstorFail();
            $branch_details=Branchmaster::where('id',$branchId)->firstorFail();
            $assign_to=User::where('id',$assign_id)->firstorFail();
            $assigned_tester=User::where('id',$assigned_tester_id)->firstorFail();
            

            $product_name=$product_name->implode('product_name',',');
            $service_name=$service_name->implode('service_name',',');
            
            $data['product']=$product_name;
            $data['service']=$service_name;
            $data['company_name']=$company_details->company_name;
            $data['branch_name']=$branch_details->branch_name;

            $data['assign_to_id']=$assign_to->id;
            $data['assign_to']=$assign_to->name;
            $data['assigned_tester_id']=$assigned_tester->id;
            $data['assigned_tester']=$assigned_tester->name;
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
                    $badge='<span class="badge badge-info m-1">'.$myTickets->assign_to.'</span>';
                    return $badge;
                })
                ->addColumn('assigned_tester', function($myTickets){
                    $badge='<span class="badge badge-danger m-1">'.$myTickets->assigned_tester.'</span>';
                    return $badge;
                })
                ->rawColumns(['ticket_id','update','assign_to','assigned_tester'])                   
                ->editColumn('created_at',function($myTickets){
                    return date('d-M-y', strtotime($myTickets->created_at));
                })
                ->make(true);
        }
        return view('tester_QnA_tickets');
    }

    public function getFailedQna(Request $request){
        $user = Auth::user();
        $myTickets=Tickets_Admin::where('assign_to', '16')->where('status','QnA Fail')->get();
        
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
