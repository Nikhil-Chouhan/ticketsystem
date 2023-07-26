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


    //Support Bucket
    public function supportBucket(Request $request)
    {
        $ticket_data = Tickets::where('isLive',0)->where('escalate',0)->get();
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
        $users=Role::where('name', 'Developer')->first()->users;
        
        if ($request->ajax()) {
            
            return Datatables::of($ticket_data)
                ->addIndexColumn()
                ->addColumn('id', function ($ticket_data) {
                    return '<a href="ticketdetail/'.$ticket_data->id.'">'.$ticket_data->id.'</a>';
                    
                })
                ->addColumn('action', function(){
                    return  '<button id="btngo" class="btngo btn btn-outline-success">Submit</button>';
                    //return $btn;
                })
                ->addColumn('assign_to', function($ticket_data) use($users ) {
                    $dropdown='<select class="btn btn-info dropdown-toggle assign_to">';
                    $dropdown .='<option value="">Select Assignne</option>';
                    
                        foreach($users as $user){
                            $dropdown .= '<option value="'.$user->id.'">'.$user->name.'</option>';
                        }
                        $dropdown .='</select>';
                    return $dropdown;
                })
                ->rawColumns(['id','action','assign_to'])                   
                ->editColumn('created_at',function($ticket_data){
                    return date('d-M-y', strtotime($ticket_data->created_at));
                })
                ->make(true);
        }
        // return($ticket_data);
        return view('index');
    }
    //Project Management Bucket
    public function pmBucket(Request $request){
        $ticket_data = Tickets::where('escalate',1)->where('isLive',0)->get();
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
                ->addColumn('action', function(){
                    return  '<button id="btngo" class="btngo btn btn-outline-success">Submit</button>';
                    //return $btn;
                })
                ->rawColumns(['id','action'])                   
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
                ->addColumn('action', function(){
                    return  '<button id="btngo" class="btngo btn btn-outline-success">Submit</button>';
                    //return $btn;
                })
                ->rawColumns(['id','action'])                   
                ->editColumn('created_at',function($ticket_data){
                    return date('d-M-y', strtotime($ticket_data->created_at));
                })
                ->make(true);
        }
        // return($ticket_data);
        return view('management_bucket');
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

    //Store Ticket in Admin Table
    public function store(Request $request){
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
   
    public function closeTicket(Request $request){
        if ($request->ajax()) {
            $data = Tickets_Admin::where('status','Close')->get();
        
            return Datatables::of($data)->addIndexColumn()
                    ->addColumn('ticket_id', function ($data) {
                        return '<a href="ticketdetail/'.$data->ticket_id.'">'.$data->ticket_id.'</a>';
                        
                    })
                    ->addColumn('update', function(){
                        return  '<button id="update" class="update btn btn-outline-warning btn-sm">Update</button>
                        <button id="delete" class="delete btn btn-outline-danger btn-sm">Delete</button>';
                    })
                    ->rawColumns(['ticket_id','update'])                   
                    ->editColumn('created_at',function($data){
                        return date('d-M-y', strtotime($data->created_at));
                    })
                ->make(true);
        }
        return view('close_ticket');
    }

    public function getProgress($ticket_id){
       // dd($ticket_id);
        //return($request);
        $progressdata = Progress::where('ticket_id',$ticket_id)->get();
        return view('progress',compact('progressdata'));
    }

    //Save Company
    public function registerCompany(Request $request){
        //dd($request);
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

    //Company Master Table
    public function companyMaster(Request $request){
        
        if ($request->ajax()) {
            $data = Companymaster::get();
            
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
 
    //Product Master 
    public function productMaster(Request $request){
        
        if ($request->ajax()) {
            $data = Productmaster::get();
            
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    //  return  '<a href="editproduct/'.$data->id.'" class="btn btn-outline-success">Edit</button>';
                     return  '<a href="editproduct/'.$data->id.'"<i class="btnedit fas fa-edit"></i></a>';
                    
                })
                ->rawColumns(['action'])                   
                ->make(true);
        }
    
        return view('product_master');
    }

    //Service Master 
    public function serviceMaster(Request $request){
    
        if ($request->ajax()) {
            $data = Servicemaster::get();
            
            return Datatables::of($data)->addIndexColumn()
                // ->addColumn('action', function(){
                //     return  '<button id="btngo" class="btngo btn btn-outline-success">Submit</button>';
                //     //return $btn;
                // })
                // ->rawColumns(['action'])                   
                ->make(true);
        }
        return view('service_master');
    }

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

    //Save Product
    public function saveProduct(Request $request){
        $data=$request->validate([
            'product_name'=>'required',
        ]);

        $product_details=new Productmaster;
        $product_details->product_name=$request->product_name;
        $product_details->product_description=$request->product_description;
        $product_details->save();
        return redirect('productregister')->with('msg','Product Added Succesfully');
    }

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

    public function editProduct($id)
    {
        $productDetails=Productmaster::where('id',$id)->firstorFail();
        
        return view ('product_register',compact('productDetails'));
    }

    public function updateProduct($id,Request $request){
        $updateproduct=ProductMaster::where('id',$id)->first();
        $updateproduct->product_name=$request->product_name;
        $updateproduct->product_description=$request->product_description;
        $updateproduct->save();
        return redirect('productmaster')->with('msg','Updated Succesfully');
        dd($request);
    }

    public function createPermission(Request $request){
       $permission=new Permission;
       $permission->name=$request->permission_name;
       $permission->save();
       return redirect('registerpermission')->with('msg','Permission Created! ');
    } 

    //Role Form
    public function indexRole(Request $request){
        $permissions=Permission::all();
        return view('role_form',compact('permissions'));
    }  

    //Create Role
    public function createRole(Request $request){
        $role=new Role;
        $role->name=$request->role_name;
        $role->syncPermissions($request->permissions);
        $role->save();
        return redirect('registerrole')->with('msg','Role Created!');
    }   

    //Register User Form
    public function indexUser(Request $request){
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
    public function getUser()
    {
        // $user = auth()->user();
        $user = Auth::user();
        dd($user);
    }

    public function permissionTable(Request $request){
        if ($request->ajax()) {
            $permission = Permission::all();
            return Datatables::of($permission)->addIndexColumn()
                ->addColumn('action', function($permission){
                    return  '<a href="permission/edit/'.$permission->id.'"><i style="color:green; margin-right:10px"class="ik ik-edit-2 f-16"></i></a>
                            <a><i style="color:red;"class="ik ik-trash-2 f-16"></i></a>';
                            
                })
                ->rawColumns(['action'])                   
                ->make(true);
        }
        return view('permission_form');

    }
    //Edit Permission
    public function editPermission($id){
       
        $permission = Permission::where('id',$id)->firstorFail();
        return view('edit-permission',compact('permission'));    
    }

    public function updatePermission($id,Request $request){
        $permission=Permission::where('id',$id)->update(['name'=>$request->permission_name]);
        return redirect('registerpermission')->with('msg','Updated!');
    }

    public function roleTable(Request $request){
        if ($request->ajax()) {
            $roles = Role::all();
            return Datatables::of($roles)->addIndexColumn()
                ->addColumn('action', function($roles){
                    return  '<a href="role/edit/'.$roles->id.'"><i style="color:green; margin-right:10px"class="ik ik-edit-2 f-16"></i></a>
                            <a><i style="color:red;"class="ik ik-trash-2 f-16"></i></a>';
                            
                })
                ->addColumn('permission',function($role){
                    $badges='';
                    
                        foreach($role->permissions as $permission){
                            $badges .= '<span class="badge badge-info m-1">' . $permission->name . '</span>';
                        }
                    
                    return $badges;
                })
                ->rawColumns(['action','permission'])                   
                ->make(true);
        }
        return view('role_form');
    }
    public function editRole($id){
        $role=Role::where('id',$id)->firstorFail();
        $permissions=Permission::all();

        return view('edit-role',compact('role','permissions'));
    }
    
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
}
