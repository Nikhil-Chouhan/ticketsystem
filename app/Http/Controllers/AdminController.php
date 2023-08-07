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
use App\Mail\TicketMailTemplate;
use App\Models\ExcelFile;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
        // $getTicketDetails=Tickets::join('image','image.tickets_id','=','tickets.id')->where('tickets.id',$ticketid)->first();
        $getTicketDetails=Tickets::where('id',$ticketid)->first();
        
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
        $getTicketDetails->company_name=$company_details->company_name;
        $getTicketDetails->branch_name=$branch_details->branch_name;
        $getTicketDetails->branch_hero=$branch_details->branch_contactperson_name;
        
        //$images=$getTicketDetails->file;
        
        $getimages=Image::where('tickets_id',$ticketid)->first();
        if($getimages!=null)
        {
            $images=$getimages->file;
            $imageFile=AdminController::getImageAttribute($images);
            return view('ticket-details',compact('getTicketDetails','imageFile'));
        }
    
        else{
            return view('ticket-details',compact('getTicketDetails'));
        }
        
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

    public function getProgress($ticket_id){
       // dd($ticket_id);
        //return($request);
        $progressdata = Progress::where('ticket_id',$ticket_id)->get();
        return view('progress',compact('progressdata'));
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

    public function updateMyTicket(Request $request){
        $openticket=Tickets_Admin::where('ticket_id',$request->ticket_id)->update(['status'=>$request->status]);
        return($openticket);
    }

    public function pushQnA(Request $request){
        $ticket=Tickets_Admin::where('ticket_id',$request->ticket_id)->first();
        $ticket->status=$request->status;
        $ticket->assigned_tester=$request->assigned_tester;
        $ticket->save();
        return($ticket);
    }
    
    public function getdashboard(){
    
        $companydata = Companymaster::get();
        $branchdata = Branchmaster::get();
        $productdata = Productmaster::get();
        $servicedata = Servicemaster::get();
        $userdata = User::with('roles.permissions')->get();
        $ticketdata = Tickets_Admin::get();

        return view('dashboard',compact('companydata','branchdata','productdata','servicedata','userdata','ticketdata'));
    }

    public function downloadExcel($id){
        $excelFiles = ExcelFile::where('tickets_id', $id)->get();
        //dd($excelFiles);
        //$excelData = $excelFile->excel_file;
        foreach($excelFiles as $excelFile) {
            $excelData = gzuncompress($excelFile->excel_file);
            $fileName = $excelFile->excel_name;
            
            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="'. $fileName .'"',
            ];
           // dd($headers);
            return response()->make($excelData, 200, $headers);
        
        }
    }
}
