<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicemaster;
class ServiceController extends Controller
{
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
    
}
