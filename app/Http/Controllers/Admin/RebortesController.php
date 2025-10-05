<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Status;
use App\Models\Product;
use App\Models\Returns;
use App\Models\Servant;
use App\Models\Supplier;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\OrderDetailes;
use App\Models\ReturnsDetailes;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRebortesRequest;
use App\Http\Requests\servantRebortsRequest;
use App\Http\Requests\supplierRebortsRequest;
use App\Http\Requests\allProductsRebortsRequest;

class RebortesController extends Controller
{

    // ALL PACKAGES
    public function index() // **** //
    {
        $governorates = Governorate::all();
        $servants = Servant::all();
        $suppliers = Supplier::all();
        $orders = Order::all();
        $ordersdetails = OrderDetailes::all();
        $allOrders = OrderDetailes::withTrashed()->with('product')->whereHas('product')->get();
        //  return $allOrders->count();

        // $aalReturns = Returns::withTrashed()->with('returnsDetailes')->whereHas('returnsDetailes')->get();
        $aalReturns = Returns::withTrashed()->with('returnsDetailes')->get();
        // return $aalReturns;

  	  	$sumorderdetails=$ordersdetails->sum('shipping_price');

        return \view('admin.reborts.index',\compact('governorates','servants','suppliers','ordersdetails' , 'orders','sumorderdetails','allOrders','aalReturns'));
    }

    public function setday(allProductsRebortsRequest $request)
    {
        // return $request;

        $from =$request['date'];
        $to =$request['date2'];
        $datas = OrderDetailes::withTrashed()->where('created_at', '>=', $from)->where('created_at', '<=', $to)->get();
        $returns = Returns::withTrashed()->where('created_at', '>=', $from)->where('created_at', '<=', $to)->get();

        $sum=$datas->sum('shipping_price');
        $sum2=$returns->sum('shipping_price');
        return view('admin.reborts.testorder',compact('datas','sum','returns','sum2'));

    }


            // SERVANT METHODS
    public function servantindex()
    {
        $servants       = Servant::all();
        $projects       = Product::with('cities','status','supplier','orders_detailes')->doesntHave('orders_detailes')->where('status_id',1)->orderBy('created_at','desc')->limit(250)->get();
        $returns        = Product::with('cities','status','supplier','orders_detailes')->whereHas('orders_detailes')->orderBy('created_at','desc')->limit(250)->get();

        return \view('admin.reborts.servantindex',\compact('servants','projects','returns'));
    }

    public function servantname(servantRebortsRequest $request)
    {
        $from                   = $request['date1'];
        $to                     = $request['date2'];
        $servant                = Servant::withTrashed()->where('id',$request->date)->get();
        $orders                 = Order::withTrashed()->where('servant_id',$request->date)->whereBetween('created_at',array($from,$to))->with('orders_detailes')->whereHas('orders_detailes')->get();
        // $orderdetailes1         = OrderDetailes::where($orders->id,order_id)->get();
        // return $orders;

        return view('admin.reborts.servantordername',compact('orders','servant'));
    }

    public function showMore($id)
    {
        $products = Order::withTrashed()->with('orders_detailes')->whereHas('orders_detailes')->where('status_id',1)->find($id);
        // return $products;
        return view('admin.reborts.showMore',compact('products'));
    }

    // SUPPLIERS METHODS
    public function getCastomer_index()
    {

        // $suppliers      = Supplier::all();
        // $status         = Status::all();


        // $ordersdetails  = OrderDetailes::all();
        // $sumorderdetails=$ordersdetails->sum('shipping_price');
        // return \view('admin.reborts.castomerIndex',\compact('suppliers','ordersdetails','sumorderdetails','status'));

        return \view('admin.reborts.castomerIndex');
    }

    // public function getCastomer_reborts(supplierRebortsRequest $request)
    // {
    //     // return $request;
    //     $from           = $request['date1'];
    //     $to             = $request['date2'];

    //     $supplier       = Supplier::withTrashed()->where('id',$request->date)->get();
    //     $allStatus      = Status::select('id','name')->where('id','<>',1)->get();

    //     if ($request->date1 != null && $request->date2 != null)
    //     {
    //         $status_id = $request->status_id;
    //         $datas_Orders   = Product::with('orders_detailes')->doesntHave('orders_detailes')->where('supplier_id',$request->date)->where('status_id',$request->status_id)->whereBetween('created_at',array($from,$to))->orderBy('created_at', 'desc')->get();
    //         $datas_Returns  = Product::with('orders_detailes')->whereHas('orders_detailes')->where('supplier_id',$request->date)->where('status_id',$request->status_id)->whereBetween('created_at',array($from,$to))->orderBy('created_at', 'desc')->get();

    //         //  $datas_Orders   = Product::with('orders_detailes')->doesntHave('orders_detailes')->where('supplier_id',$request->date)->where('status_id',$request->status_id)->whereBetween('created_at',array($from,$to))->orderBy('created_at', 'desc')->get();
    //         // $datas_Returns  = Product::with('orders_detailes')->whereHas('orders_detailes')->where('supplier_id',$request->date)->whereBetween('created_at',array($from,$to))->orderBy('created_at', 'desc')->get();

    //         return view('admin.reborts.castomerOrderName',compact('datas_Orders','datas_Returns','supplier','allStatus','status_id'));
    //     } else
    //     {
    //         $products   = Product::with('orders_detailes')->doesntHave('orders_detailes')->where('supplier_id',$request->date)->where('status_id',$request->status_id)->get();
    //         $returns    = Product::with('orders_detailes')->whereHas('orders_detailes')->where('supplier_id',$request->date)->where('status_id',$request->status_id)->get();
    //         $status_id = $request->status_id;

    //         return view('admin.reborts.castomerOrderName',compact('products','returns','supplier','allStatus','status_id'));
    //     }
    // }


    // ORDER NUMBER METHODS
    public function orderNumber_index()
    {
        return \view('admin.reborts.orderNumber');
    }

    public function orderNumber_reborts (OrderRebortesRequest $request)
    {
        if ($request->status == 0)
        {
            $order = Order::withTrashed()->where('id',$request->order_num)->with('orders_detailes')->get();
            // return $order;
            if ($order && $order->count() > 0)
            {
                return view('admin.reborts.showOrderDetailes',compact('order'));

            }else
            {
                return redirect()->back()->with(['error' => 'هذا الاوردر غير موجود']);
            }
        }else
        {
            $returns = Returns::withTrashed()->where('id',$request->order_num)->with('returnsDetailes')->get();
            // return $returns;
            if ($returns && $returns->count() > 0)
            {
                return view('admin.reborts.showOrderDetailes',compact('returns'));

            }else
            {
                return redirect()->back()->with(['error' => 'هذا الاوردر غير موجود']);
            }
        }
    }


    public function allProducts()
    {
        $products = Product::withTrashed()->with('supplier')->get();
        // return $products;
        return view('admin.reborts.products',compact('products'));
    }

    public function completeProduct($id)
    {
        $product = OrderDetailes::withTrashed()->where('id',$id)->first();
        $returns = Returns::withTrashed()->where('id',$id)->first();
        try
        {
            if (condition)
            {
                # code...
            }

        } catch (\Throwable $th)
        {

        }
    }


}
