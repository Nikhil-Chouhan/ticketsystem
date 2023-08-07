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
use App\Events\NewTicketRaised;
use App\Models\ExcelFile;
use Maatwebsite\Excel\Facades\Excel;

class TicketController extends Controller
{
    //generating form link
    public function getFormLink ($branch_code){
        $branchdetails=Branchmaster::where('branch_code',$branch_code)->firstorFail();

        $productDetails=$branchdetails['product'];
        $serviceDetails=$branchdetails['service'];

        $productId=explode(',',$productDetails);
        $serviceId=explode(',',$serviceDetails);
        
        $productInfo = Productmaster::whereIn('id', $productId)->pluck('product_name', 'id');
        $serviceInfo = Servicemaster::whereIn('id', $serviceId)->pluck('service_name', 'id');

        $branchdetails['product'] = $productInfo;
        $branchdetails['service'] = $serviceInfo;

        // dd($branchdetails);
        return view('ticketForm',compact('branchdetails'));
    }

    //Get Product & Service
    public function get_ProductService(Request $request){
        $branchdetails = Branchmaster::where('id', $request->branchid)->first();
        
        $productDetails=$branchdetails['product'];
        $serviceDetails=$branchdetails['service'];

        $productId=explode(',',$productDetails);
        $serviceId=explode(',',$serviceDetails);
        
        $productInfo = Productmaster::whereIn('id', $productId)->pluck('product_name', 'id');
        $serviceInfo = Servicemaster::whereIn('id', $serviceId)->pluck('service_name', 'id');

        $branchdetails['product'] = $productInfo;
        $branchdetails['service'] = $serviceInfo;
        return ($branchdetails);
    }

    //Get Branch Details
    public function getBranchDetails(Request $request){
        $branchdetails = Branchmaster::where('company_id', $request->companyid)->get();
        return($branchdetails); 
    }

    //Submit Ticket
    public function ticketSubmit(Request $request)
    {
       // dd($request);
        $branch_details=Branchmaster::where('branch_code',$request->branch_code)->firstorFail();
        // $company_details=Companymaster::where('id',$branch_details->company_id)->firstorFail();   
        
        // if($excels != null)
        // {
        //     foreach($excels as $excel) {
            
        //         // Convert the Excel file to binary data
        //         $binaryData = file_get_contents($excel->getRealPath());
 
        //         // Save the binary data in the database
                
        //         $excel->excel_name = $excel->getClientOriginalName();
        //         $excel->excel_file = $binaryData;
        //         $excelFiles[]=$excel;
                
        //     }
        // }
        $ticket_details=new Tickets;
        
        $ticket_details->isLive=0;
        $ticket_details->escalate=0;

        $ticket_details->company_id=$branch_details->company_id;
        $ticket_details->branch_id=$branch_details->id;
        
        $ticket_details->product=$request->product_id;
        $ticket_details->service=$request->service_id;
        $ticket_details->branch_code=$request->branch_code;
        $ticket_details->ticket_title=$request->ticket_title;
        $ticket_details->ticket_description=$request->ticket_description;
        
        $ticket_details->support_type=$branch_details->support_type;
        $ticket_details->exec_name=$branch_details->branch_contactperson_name;
        $ticket_details->exec_number=$branch_details->branch_contactperson_number;
        $ticket_details->exec_email=$branch_details->branch_contactperson_email;
        
        $ticket_details->save();

        //$excelFile = new ExcelFile;
        // $excelFiles=[];
        $excels = $request->ticket_excel;
        if($excels!=null)
        {
            foreach ($excels as $excel) {
                $excelFile = new ExcelFile;
                $excelFile->excel_name = $excel->getClientOriginalName();
                $excelFile->excel_file =gzcompress(file_get_contents($excel->getRealPath())); 

                $ticket_details->excel()->save($excelFile);  
            }
        }

        $image=new Image;
        $imagePaths=[];
        $images = $request->ticket_image;
        if($images != null)
        {
            foreach($images as $image) {
                $file = $image->getClientOriginalName();
                $image->move('uploadedimages/', $file);
            
                // $newfile = env('APP_URL').'public/images/' . $file;
                $newfile = config('app.url').'/uploadedimages/' . $file;
                $imagePaths[] = $newfile;
            }
            //Store Image in Image table
            $image->file = implode(',', $imagePaths);
            // Save image
            $ticket_details->image()->save($image);
        }

        $branch_code=$request->branch_code;
            
        // $this->send_email($branch_details->branch_contactperson_name,$ticket_details->id);

        event(new NewTicketRaised( $ticket_details));

        return redirect('GetFormLink/'.$branch_code)->with('msg','Worry no more! Your ticket has been successfully raised and will be addressed promptly :)<hr> Your Ticket ID is '.$ticket_details->id.'');
        
    }

    public function generateTicketForm(){
        $companydetails = Companymaster::get();
        return view('raiseticketform',compact('companydetails'));    
    }

    public function generateTicket(Request $request){
        //dd($request);
        $branch_details=Branchmaster::where('id',$request->branch_id)->firstorFail();
        // dd($branch_details);
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
        $ticket_details->branch_code=$branch_details->branch_code;
        
        $ticket_details->product=$request->product;
        $ticket_details->service=$request->service;
        $ticket_details->ticket_title=$request->ticket_title;
        $ticket_details->ticket_description=$request->ticket_description;
   
        $ticket_details->support_type=$branch_details->support_type;
        $ticket_details->exec_name=$branch_details->branch_contactperson_name;
        $ticket_details->exec_number=$branch_details->branch_contactperson_number;
        $ticket_details->exec_email=$branch_details->branch_contactperson_email;
        
        $ticket_details->save();

        //Store Image in Image table
        $image->file = implode(',', $imagePaths);
        // dd($image->file);
        $ticket_details = $ticket_details->image()->save($image);
        $branch_code=$request->branch_code;
        //return view('ticketForm',compact('branch_code'))->with('msg','Ticket Raised Succesfully');
        // $this->send_email($branch_details->branch_contactperson_name,$ticket_details->id);

        return redirect('generateticket')->with('msg','Worry no more! Your ticket has been successfully raised and will be addressed promptly :)<hr> Your Ticket ID is '.$ticket_details->id.'');
    }

    //Email Trigger 
    public function send_email($name,$id) {
    
        $data = array('name'=>$name,'id'=>$id);

        Mail::to('thomasshelby077@gmail.com')->send(new TicketMailTemplate($data));

        return "Email sent successfully!";
        // Mail::send(['text'=>'mail'], $data, function($message) {
        //    $message->to('thomasshelby077@gmail.com', 'Hello there')->subject
        //       ('Laravel Basic Testing Mail');
        //    $message->from('prathamdharawat123@gmail.com','Hi hi');
        // });
        // echo "Basic Email Sent. Check your inbox.";
    }
    
}
