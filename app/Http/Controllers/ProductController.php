<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productmaster;

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
                    //  return  '<a href="editproduct/'.$data->id.'" class="btn btn-outline-success">Edit</button>';
                        return  '<a href="editproduct/'.$data->id.'"<i class="btnedit fas fa-edit"></i></a>';
                    
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
        $updateproduct=ProductMaster::where('id',$id)->first();
        $updateproduct->product_name=$request->product_name;
        $updateproduct->product_description=$request->product_description;
        $updateproduct->save();
        return redirect('productmaster')->with('msg','Updated Succesfully');
        dd($request);
    }

}
