<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Image;
use Public\Documents;
use Public\images;

class TicketController extends Controller
{
 
    //Api for storing data.
    public function save(Request $request)
    {

        $images = $request->file('test_image');
        $imagePaths=[];

        foreach($images as $image) {
            $file = $image->getClientOriginalName();
            $image->move('images/', $file);
        
            // $newfile = env('APP_URL').'public/images/' . $file;
            $newfile = config('app.url').'/images/' . $file;
            // dd($newfile);
            $imagePaths[] = $newfile;
        }
        
        $data=new Tickets;
        $image=new Image;

        //Store data in tickets table
        $data->client_id=$request->client_id;
        $data->client_name=$request->client_name;
        $data->project_name=$request->project_name;
        $data->exec_name=$request->exec_name; //new add
        $data->exec_email=$request->exec_email; //new add
        $data->exec_number=$request->exec_number; // new add
        $data->issue_type=$request->issue_type; //new add
        $data->ticket_priority=$request->ticket_priority;
        $data->description=$request->description;
        
        $data->isLive=0; //new
        $data->save();

        //Store Image in Image table
        $image->file = implode(',', $imagePaths);
        //$image->tickets_id=$data->id;
        $data = $data->image()->save($image);
      
        return response()->json([
            'status'=>'success',
            'ticketDetails'=> $data,
            'image'=> $image
        ]);

    }

    //Api for fetching data.

    public function showdetails(string $clientid)
    {
        //$data=Tickets::where('client_id',$clientid)->get();
        //$details = Tickets::with('image')->where('client_id',$clientid)->get();

        //$imageFile=[];
    //    foreach($getTicketDetails as $detail)
    //    {
    //         $images=$detail->file;
           
    //         $imageFile[]=TicketController::getImageAttribute($images);
            
    //         $detail->file=$imageFile;
    //     }
       
        $getTicketDetails=Tickets::join('image','tickets.id', '=','image.tickets_id')->where('tickets.client_id',$clientid)->get();
        $ticketDetails = $getTicketDetails->map(function ($ticket) {
        $ticket->file = explode(',', $ticket->file); // Convert file string to an array
        return $ticket;
        });
       return response()->json([
           'status'=>'success',
           'ticketDetails'=> ["Tickets"=>$ticketDetails]
       ]); 
       
    }
}
