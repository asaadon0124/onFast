<?php

namespace App\Http\Controllers\User;

use App\Models\Status;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\OrderDetailes;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRebortsRequest;

class rebortsController extends Controller
{
    public function index()
    {
        $status = Status::all();
        return view('user.reborts.index',compact('status'));
    }

    public function search(UserRebortsRequest $request)
    {
        $supplier       = Supplier::where('phone', auth()->user()->phone)->first();
        $from           = $request->start_date;
        $to             = $request->end_date;
        // return $request;
       
       
       

        // return $orderDtailes;
        
        
        if($request->status_id == 1)
        {
             $products       = Product::doesntHave('orders_detailes')->where('supplier_id',$supplier->id)->where('status_id',1)->whereBetween('created_at',array($from,$to))->orderBy('created_at', 'desc')->get();
        }else
        {
             $orderDtailes   = OrderDetailes::withTrashed()->where('product_status',$request->status_id)->whereBetween('created_at',array($from,$to))->orderBy('created_at', 'desc')->with('product2')->whereHas('product2',function($q) use($supplier)
            {
                $q->where('supplier_id',$supplier->id);
    
            })->get();
        }
        
        
        if (isset($products) && $products->count() > 0) 
        {
           return view('user.reborts.searchResults',compact('products','from','to'));
        } else 
        {
            return view('user.reborts.searchResults',compact('orderDtailes','from','to'));
        }
        

        // return $orderDtailes;
    }
}
