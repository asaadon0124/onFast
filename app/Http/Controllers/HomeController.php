<?php

namespace App\Http\Controllers;

use \App\Models\OrderDetailes;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $supplier = Supplier::where('phone',auth()->user()->phone)->first();
        // return $supplier;

        if ($supplier == '')
        {
            $productCompleted   = '';
            $products           = '';
            

            return view('home',compact('productCompleted','products'));
        } else
        {
            $products           = Product::where('supplier_id',$supplier->id)->where('status_id',1)->whereDoesntHave('orders_detailes')->whereBetween('created_at',array('2021-11-01', Carbon::now()))->orderByDesc('created_at')->get()->take(10);
            $productCompleted = OrderDetailes::with('product2')->where('order_id','<>',null)->whereHas('product2',function($q) use($supplier)
            {
                $q->where('supplier_id',$supplier->id);
            })->orderByDesc('id')->get()->take(10);


            // return $productCompleted;
            return view('home',compact('productCompleted','products'));
        }
    }
}
