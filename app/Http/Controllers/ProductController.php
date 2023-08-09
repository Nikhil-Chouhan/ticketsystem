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

class ProductController extends Controller
{
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

    //Product Master 
    public function productMaster(Request $request){
    
        if ($request->ajax()) {
            $data = Productmaster::get();
            
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                        return  '<a href="editproduct/'.$data->id.'"<i class="ik ik-edit-2 f-16" style="color:green; margin-right:10px"></i></a>
                        <a href="deleteproduct/'.$data->id.'"<i class="btndelete ik ik-trash-2 f-16" style="color:red;"></i></a>';
                })
                ->rawColumns(['action'])                   
                ->make(true);
        }
    
        return view('product_master');
    }

    public function editProduct($id)
    {
        $productDetails=Productmaster::where('id',$id)->firstorFail();
        
        return view ('product_register',compact('productDetails'));
    }

    public function updateProduct($id,Request $request){
       
        $updateProduct=Productmaster::where('id',$id)->update(['product_name' => $request->product_name,
        'product_description' => $request->product_description,
        ]);
        return redirect('productmaster')->with('msg','Product Updated Succesfully');
    }

    public function deleteProduct($id){
        // dd($id);
        $delete=Productmaster::where('id',$id)->delete();
        return redirect()->back()->with('redalert','Product Deleted Succesfully');
    }
}
