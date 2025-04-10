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
use App\Models\OrderReturnStatus;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ordersRequest;
use Carbon\Carbon;
use App\Models\ReserveOrder;

use App\Http\Requests\productSearchReuest;
use App\Models\Reserve;


class ordersController extends Controller
{
    public function store(ordersRequest $request) // STORE NEW ORDER AND UPDATE ORDER_ID IN ORDER DETAILES TABLE  +++++++++++++++++++++++++++++++ DONE
    {
        // return $request;
        if($request->total_price > 0 && isset($request->servant_id))
        {
            DB::beginTransaction();
            $create = Order::create(
                [
                    'status_id'         => 1,
                    'servant_id'        => $request->servant_id,
                    'total_prices'      => $request->total_price,
                ]);

            // CREATE ORDER ID IN ORDER DETAILES TABLE
            $orderDetailes  = OrderDetailes::with('product')->where('order_id',null)->where('user_id',auth()->user()->id)->get();
            $order_id       = $create->id;

                foreach($orderDetailes as $item)
                {
                    $item->update(
                        [
                            'order_id'          => $order_id,
                            'product_status'    => 2,
                        ]);
                }

            // CREATE TOTAL SHIPPING IN ORDER TABLE 
            $updateOrder = $create->update(
                [
                    'total_shipping' => $orderDetailes->sum('shipping_price'),
                ]);
                DB::commit();
                
            return \redirect()->route('orderDetailes.submit_new_order')->with(['success' => 'تم حفظ الاوردر بنجاح']);
        }else
        {
            DB::rollback();
            return \redirect()->route('orderDetailes.submit_new_order')->with(['error' => 'لا يمكن اضافة اوردر جديد بدون اضافة شحنات داخله']);
        }
    }

   public function index() // SHOW ALL ORDERS [ORDERS - RETURNS] ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ DONE
   {
        $orders = Order::with('orders_detailes','status','servant')->whereHas('orders_detailes')->orderBy('created_at', 'desc')->get();
        $servants = Servant::all();
        
        
       return view('admin.orders.index',\compact('orders','servants'));
   }

   public function edit($id) // UPDATE ORDER STATUS TO COMPLETED  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ DONE
   {
        try
        {
            $order = Order::find($id);
            if(!$order)
            {
                return \redirect()->route('orders.index')->with(['error' => 'هذا العنصر غير موجود']);

            }else
            {
               $order->delete();
               return redirect()->route('orders.index')->with(['success' => 'تم تغير حالة خط السير بنجاح']);
            }
        }catch (\Throwable $th)
        {
            return $th;
            return \redirect()->route('orders.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
   }


    public function show($id) // SHOW ORDER DETAILES DATA +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ DONE
    {
        try
        {
            $order = Order::with('orders_detailes')->find($id);
          
            
            if(!$order)
            {
                return \redirect()->route('orders.index')->with(['error' => 'هذا العنصر غير موجود']);

            }else
            {
                $allStatus      = Status::where('deleted_at',null)->where('id','<>',1)->where('id','<>',7)->select('name','id')->get();

                return \view('admin.orders.show',\compact('order','allStatus'));
            }
        }catch (\Throwable $th)
        {
            return $th;
            return \redirect()->route('orders.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

   


    public function softDelete()   // TO SHOW ALL ORDERS HAS COMPLETED +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ DONE
    {
        try
        {
            $from = '2024-12-01';
            $to = \Carbon\Carbon::now();
            $orders = Order::onlyTrashed()->with('orders_detailes')->orderBy('created_at', 'desc')->whereBetween('created_at', [$from, $to])->get();
           
            if($orders)
            {
                return \view('admin.orders.softDelete',\compact('orders'));
            }else
            {
                return \redirect()->route('orders.index')->with(['error' => 'لا يوجد اوردرات محزوفة ']);
            }
        }catch (\Throwable $th)
        {

            return $th;
            return \redirect()->route('orders.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    

    public function restore(Request $request)  // RESTORE ORDER TO ORDER UNCOMPLEATED   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ DONE
    {
        $order_restore = Order::withTrashed()->with('orders_detailes')->where('id',$request->id)->first();

        // RESTORE ORDER
        $order_restore->restore();

        // CHANGE ORDER STATUS TO PENDING
        $order_restore->update(
            [
                'status_id' => 1
            ]);

        return \response()->json(
            [
                'status' => true,
                'msg' => 'تم التفعيل بنجاح',
                'id' => $request->id
            ]);
    }

   

    public function show_order_detailes($id)  // TO SHOW ORDER DETAILES IN ORDER COMPLEATED PAGE +++++++++++++++++++++++++++++++++++++++++++++++++++++ DONE
    {
       $order = Order::withTrashed()->with('orders_detailes')->whereHas('orders_detailes')->find($id);
   
        return view('admin.orders.show_order_detailes',compact('order'));  
    }

    public function productNote(Request $request,$id)       // UPDATE NOTE TO PRODUCT IN ORDER DETAILES TABLE  ++++++++++++++++++++++++++++++++++++++++ DONE
    {

        try
        {
            $product = OrderDetailes::withTrashed()->find($id);
            $update = $product->update(
                [
                    'notes' => $request->notes
                ]);
                
           
                return redirect()->back()->with(['success' => 'تم التعديل بنجاح']);


        } catch (\Throwable $th)
        {
            return redirect()->route('orders.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    // ADD NEW PRODUCT TO OLD ORDER  ***************************************************** // 

    public function addProduct($id)  // SHOW ADD NEW PRODUCT TO ORDER  PAGE +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ DONE
    {
        $order          = Order::find($id);
        $governorates   = Governorate::all();
        return view('admin.orders.addProduct',compact('governorates','order'));
    }

    public function StoreProduct(Request $request) // UPDATE NEW PRODUCT TO ORDER PAGE ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ DONE
    {
        $product = Product::where('id',$request->id)->first();
        $order = Order::find($request->order_id);
            $checkPro   = OrderDetailes::where('product_id',$product->id)->first(); 
            
             if (isset($checkPro) && $checkPro->count() > 0) 
             {
                 return \response()->json(
                [
                    'status'    => false,
                    'msg'       => 'هذه الشحنة مسجلة من قبل',
                    
               ]);
             }else
             {
                   // UPDATE TOTAL PRICE IN ORDERS TABLE
           $order->total_prices     = $order->total_prices + $product->total_price;
           $order->total_shipping   = $order->total_shipping + $product->shipping_price;
           $order->save();

        $product->update(
            [
                'status_id'     => 2,
                'type'          => 1
            ]);

          // ADD PRODUCT TO ORDER DETAILES TABLE
        $createOrderDetailes = OrderDetailes::create(
        [
            'product_id'        => $product->id,
            'product_status'    => 2,
            'shipping_price'    => $product->shipping_price,
            'total_price'       => $product->total_price,
            'order_id'          => $order->id,
        ]);

        return \response()->json(
            [
                'status'    => true,
                'msg'       => 'تم اضافة الشحنة لخط السير بنجاح',
                'id'        =>   $product->id  
           ]);
             }


         
    }

    public function forceDeleteItem($id)  // DELETE ITEM FROM ORDER AND RETURN IT TO PRODUCTS TABLE  [AS A ORDER DETAILES] +++++++++++++++++++++++ DONE
    {
       
       try 
       {
            $product = OrderDetailes::withTrashed()->with('product','order')->where('id',$id)->first();

            DB::beginTransaction();

            // UPDATE ORDERS TABLE  
            if ($product->product_status == 3) 
            {
                 // UPDATE PRODUCT IN PRODUCTS TABLE 
                $product->product->update(
                [
                    'status_id' => 1,
                    'returns'   => 0,
                    'type'      => 0
                ]);
                $product->order->update(
                    [
                        
                        'total_prices'      => $product->order->total_prices - $product->total_price,
                        'total_shipping'    => $product->order->total_shipping - $product->shipping_price,
                        'total_profits'     => $product->order->total_profits - $product->profit,
                    ]);

                // UPDATE PRODUCT IN ORDERDETAILES TABLE 
                $product->forceDelete();
            }elseif($product->product_status == 4)
            {
                 // UPDATE PRODUCT IN PRODUCTS TABLE 
                $product->product->update(
                    [
                        'status_id' => 1,
                        'returns'   => 0,
                        'type'      => 0
                    ]);
                // UPDATE PRODUCT IN ORDERDETAILES TABLE 
                $product->forceDelete();
            }else
            {
                 // UPDATE PRODUCT IN PRODUCTS TABLE 
                 $product->product->update(
                    [
                        'status_id' => 1,
                        'returns'   => 0,
                        'type'      => 0
                    ]);
                    $product->order->update(
                        [
                            'total_prices'      => $product->order->total_prices - $product->total_price,
                            'total_shipping'    => $product->order->total_shipping - $product->shipping_price,
                            'total_profits'     => $product->order->total_profits - $product->profit,
                        ]);
    
                    // UPDATE PRODUCT IN ORDERDETAILES TABLE 
                    $product->forceDelete();
            }

           

            DB::commit();
            return redirect()->back()->with(['success' => 'تم حزف الشحنة بنجاح']); 
       } catch (\Throwable $th) 
       {
           DB::rollback();
            return $th;
            return \redirect()->route('orders.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
       }  
        
    }

    // EDIT ITEM DETAILES IN  ORDER ******************************************************** //
    public function editOrderItem($id)   // TO SHOW EDIT ORDER DETAILES PAGE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  DONE
    {
        // return $id;
        $product    = OrderDetailes::withTrashed()->with('product','order')->find($id);
       
        $servants   = Servant::all();
        $allStatus  = Status::where('id','<>',1)->where('id','<>',7)->get();
        
        return view('admin.orders.editOrderItem',compact('product','servants','allStatus'));
    }




    public function deleteOrder($id)  // DELETE ORDER FORM ORDERS TABLE AND DELETE ORDER DETAILES AND RETURNS AND RETURN PRODUCT TO PRODUCTS TABLE ++ DONE
    {
        $order = Order::with('orders_detailes')->find($id);

        // IF ORDER HAVE ORDER DETAILES AND NO RETURNS 
        if ($order->orders_detailes && $order->orders_detailes->count() > 0) 
        {
            
           foreach ($order->orders_detailes as $detailes) 
           {
            
            $update = $detailes->product->update(
                [
                    'type'          => 0,
                    'returns'       => 0,
                    'status_id'     => 1,
                ]);

                $detailes->forceDelete();
           }

        $order->forceDelete();
        return redirect()->route('orders.index')->with(['success' => 'تم حزف خط السير بنجاح']);
        }
        
    }

    public function changeServant($id,Request $request) // CHANGE SERVANT ID IN ORDERS TABLE   ++++++++++++++++++++++++++++++++++++++++++++++++++++++ DONE
    {
        $order = Order::withTrashed()->select('id','servant_id')->find($id);
        $order->update(
            [
                'servant_id' => $request->servant_id
            ]);
            return redirect()->route('orders.index')->with(['success' => "تم تعديل المندوب بنجاح"]);
        // return $order;
    }

    public function profit(Request $request)    // CREATE PROFIT ITEM  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ DONE
    {
        $product            = OrderDetailes::withTrashed()->whereHas('order')->where('id',$request->id)->first();
        $product->update(
            [
                'profit'    => $request->price
            ]);
        
        $product->order->update(
            [
                'total_profits' => $product->order->orders_detailes()->sum('profit')
            ]);

        return \response()->json(
            [
                'status'        => true,
                'msg'           => 'تم تعديل ربح الشركة بنجاح',
           ]);
    }

    public function restoreReturns(Request $request)     // RESTORE ITEM WHEN OT RETURNS TO STATUS == 2 +++++++++++++++++++++++++++++++++++++++++++++ DONE
    {
        $orderDetailes_id       = $request->id;
        $orderDetailes_status   = $request->product_status;
        $orderDetailes          = OrderDetailes::withTrashed()->with('product','order')->where('id',$orderDetailes_id)->first();
       
        

        if($orderDetailes->product_status  == 2 && $orderDetailes_status == 3)                         // 2 TO 3 
        {
            //  return "2 to 3";

            //   UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => $orderDetailes_status,
                ]);
            $orderDetailes->delete();

            // UPDATE ORDER TABLE 
            $orderDetailes->order->update(
                [
                    'total_prices'      => $orderDetailes->order->total_prices - $orderDetailes->total_price,
                    'total_shipping'    => $orderDetailes->order->total_shipping - $orderDetailes->shipping_price,
                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 0,
                    'returns'   => 1,
                    'status_id' => $orderDetailes_status
                ]);

            return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 2 && $orderDetailes_status == 4)                   // 2 TO 4 
        {
            //  return "2 to 4";

            //   UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => $orderDetailes_status,
                ]);
            $orderDetailes->delete();

            // UPDATE ORDER TABLE 
            $orderDetailes->order->update(
                [
                    'total_prices'      => $orderDetailes->order->total_prices - $orderDetailes->total_price,
                    'total_shipping'    => $orderDetailes->order->total_shipping - $orderDetailes->shipping_price,

                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 0,
                    'returns'   => 1,
                    'status_id' => $orderDetailes_status
                ]);

            return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 2 && $orderDetailes_status == 5)                   // 2 TO 5 
        {
             // return "2 to 5";
             //   UPDATE ORDER DETAILES TABLE 
             $orderDetailes->update(
                [
                    'product_status' => 5,
                ]);
            $orderDetailes->delete();

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 1,
                    'returns'   => 0,
                    'status_id' => 5
                ]);
             return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);

        }elseif($orderDetailes->product_status  == 2 && $orderDetailes_status == 6)                   // 2 TO 6 
        {
              // return "2 to 6";
              $reserves = Reserve::where('supplier_id',$orderDetailes->product->supplier_id)->whereDate('created_at', Carbon::now())->first();

            if (isset($reserves) && $reserves->count() > 0) 
            {
                // return "yes";
                 $checkDetailes = $reserves->reservesDetailes->where('product_id',$orderDetailes->product->id)->first();
                if (isset($checkDetailes) && $checkDetailes->count() > 0) 
                {
                    return $checkDetailes;
                    return \response()->json(
                        [
                            'status'                => false,     
                            'msg'                   => 'يجب اختيار الحالة بشكل صحيح',
                        ]);
                }else
                {
                    // return "no";
                    $createReserveDetailes = ReserveOrder::create(
                        [
                            'product_id'    => $orderDetailes->product->id,
                            'status_id'     => 6,
                            'reserve_id'    => $reserves->id
                        ]);
                }

                
            }else
            {
                // return "no";
                $createReserve = Reserve::create(
                    [
                        'supplier_id' => $orderDetailes->product->supplier_id
                    ]) ;

                $createReserveDetailes = ReserveOrder::create(
                    [
                        'product_id'    => $orderDetailes->product->id,
                        'status_id'     => 6,
                        'reserve_id'    => $createReserve->id
                    ]);
                
            }
             //   UPDATE ORDER DETAILES TABLE 
             $orderDetailes->update(
                [
                    'product_status' => $orderDetailes_status,
                ]);
            $orderDetailes->delete();

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 1,
                    'returns'   => 0,
                    'status_id' => $orderDetailes_status
                ]);
             return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 2 && $orderDetailes_status == 7)                   // 2 TO 7
        {
            //  return "2 to 7";

            //   UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => $orderDetailes_status,
                ]);
            $orderDetailes->delete();

            // UPDATE ORDER TABLE 
            $orderDetailes->order->update(
                [
                    'total_prices'      => $orderDetailes->order->total_prices - $orderDetailes->total_price,
                    'total_shipping'    => $orderDetailes->order->total_shipping - $orderDetailes->shipping_price,
                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 2,
                    'returns'   => 1,
                    'status_id' => $orderDetailes_status
                ]);

           return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 3 && $orderDetailes_status == 2)                   // 3 TO 2 
        {
            //  return "3 to 2";

            //   UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => $orderDetailes_status,
                ]);
            $orderDetailes->restore();

            // UPDATE ORDER TABLE 
            $orderDetailes->order->update(
                [
                    'total_prices'      => $orderDetailes->order->total_prices + $orderDetailes->total_price, 
                    'total_prices'      => $orderDetailes->order->total_shipping  + $orderDetailes->shipping_price, 
                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 1,
                    'returns'   => 0,
                    'status_id' => $orderDetailes_status
                ]);
            $orderDetailes->product->restore();

           return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);

        }elseif ($orderDetailes->product_status      == 3 && $orderDetailes_status == 4)             // 3 TO 4
        {
            //  return "3 to 4";
         
            // UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => 4,
                    'profit'         => 0,
                ]);
            $orderDetailes->delete();

            // UPDATE ORDER TABLE 
            // $orderDetailes->order->update(
            //     [
            //         'total_prices'      => $orderDetailes->order->total_prices - $orderDetailes->shipping_price,
            //         'total_shipping'    => $orderDetailes->order->total_shipping - $orderDetailes->shipping_price,
            //     ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 0,
                    'returns'   => 1,
                    'status_id' => 4
                ]);
                 return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);

        } elseif($orderDetailes->product_status == 3 && $orderDetailes_status == 5)                  // 3 TO 5
        {
            //  return "3 to 5";

            //   UPDATE ORDER DETAILES TABLE 
                $orderDetailes->update(
                    [
                        'product_status' => $orderDetailes_status,
                    ]);

                // UPDATE ORDER TABLE 
                $orderDetailes->order->update(
                    [
                        'total_prices'      => $orderDetailes->order->total_prices + $orderDetailes->total_price, 
                        'total_prices'      => $orderDetailes->order->total_shipping  + $orderDetailes->shipping_price, 
                    ]);

                // UPDATE PRODUCT TABLE 
                $orderDetailes->product->update(
                    [
                        'type'      => 1,
                        'returns'   => 0,
                        'status_id' => $orderDetailes_status
                    ]);
                 return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);

        }elseif($orderDetailes->product_status  == 3 && $orderDetailes_status == 6)                  // 3 TO 6
        {
            // return "3 to 6";
            
            
                          $reserves = Reserve::with('reservesDetailes')->where('supplier_id',$orderDetailes->product->supplier_id)->whereDate('created_at', Carbon::today()->toDateString())->first();
            // return $reserves;
            if ($reserves && $reserves->count() > 0) 
            {
                $checkDetailes = $reserves->reservesDetailes->where('product_id',$orderDetailes->product->id)->first();
                if (isset($checkDetailes) && $checkDetailes->count() > 0) 
                {
                    return \response()->json(
                        [
                            'status'                => false,     
                            'msg'                   => 'تم تعديل حالة الشحنة من قبل',
                        ]);
                }else
                {
                    $createReserveDetailes = ReserveOrder::create(
                        [
                            'product_id'    => $orderDetailes->product->id,
                            'status_id'     => 6,
                            'reserve_id'    => $reserves->id
                        ]);
                }
                
            }else
            {
                // $checkDetailes = $reserves->reservesDetailes->where('product_id',$orderDetailes->product->id)->first();
                $product = ReserveOrder::where('product_id',$orderDetailes->product->id)->where('created_at',Carbon::today()->toDateString())->first();
                if (isset($product) && $product->count() > 0) 
                {
                    return \response()->json(
                        [
                            'status'                => false,     
                            'msg'                   => 'تم تعديل حالة الشحنة من قبل',
                        ]);
                } else 
                {
                    $createReserve = Reserve::create(
                        [
                            'supplier_id' => $orderDetailes->product->supplier_id
                        ]) ;
    
                    $createReserveDetailes = ReserveOrder::create(
                        [
                            'product_id'    => $orderDetailes->product->id,
                            'status_id'     => 6,
                            'reserve_id'    => $createReserve->id
                        ]);
                }
                // return "no";
            }

            //   UPDATE ORDER DETAILES TABLE 
                $orderDetailes->update(
                    [
                        'product_status' => $orderDetailes_status,
                    ]);

                // UPDATE ORDER TABLE 
                $orderDetailes->order->update(
                    [
                        'total_prices'      => $orderDetailes->order->total_prices + $orderDetailes->total_price, 
                        'total_prices'      => $orderDetailes->order->total_shipping  + $orderDetailes->shipping_price, 
                    ]);

                // UPDATE PRODUCT TABLE 
                $orderDetailes->product->update(
                    [
                        'type'      => 1,
                        'returns'   => 0,
                        'status_id' => $orderDetailes_status
                    ]);
                 return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 3 && $orderDetailes_status == 7)                  // 3 TO 7 
        {
             // return "3 to 7";

            // UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => 7,
                ]);
            $orderDetailes->delete();

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 2,
                    'returns'   => 1,
                    'status_id' => 7
                ]);
                 return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 4 && $orderDetailes_status == 2)                 // 4 TO 2      
        {
            // return "4 to 2";
            //   UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => $orderDetailes_status,
                ]);
            $orderDetailes->restore();
                
            // UPDATE ORDER TABLE 
            $orderDetailes->order->update(
                [
                    'total_prices'      => $orderDetailes->order->total_prices + $orderDetailes->total_price,
                    'total_shipping'    => $orderDetailes->order->total_shipping + $orderDetailes->shipping_price,
                ]);
 
            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 1,
                    'returns'   => 0,
                    'status_id' => $orderDetailes_status
                ]);
             return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 4 && $orderDetailes_status == 3)                  // 4 TO 3                                                                
        {
            // return "4 to 3";

            // UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => 3,
                ]);
            $orderDetailes->delete();

            // UPDATE ORDER TABLE 
            // $orderDetailes->order->update(
            //     [
            //         'total_prices'      => $orderDetailes->order->total_prices + $orderDetailes->shipping_price,
            //         'total_shipping'    => $orderDetailes->order->total_shipping + $orderDetailes->shipping_price,
            //     ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 0,
                    'returns'   => 1,
                    'status_id' => 3
                ]);
                 return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);

        }elseif($orderDetailes->product_status  == 4 && $orderDetailes_status == 5)                  // 4 TO 5
        {
            // return "4 to 5";
             //   UPDATE ORDER DETAILES TABLE 
             $orderDetailes->update(
                [
                    'product_status' => $orderDetailes_status,
                ]);

            // UPDATE ORDER TABLE 
            $orderDetailes->order->update(
                [
                    'total_prices'      => $orderDetailes->order->total_prices + $orderDetailes->total_price,
                    'total_shipping'      => $orderDetailes->order->total_shipping + $orderDetailes->shipping_price,
                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 1,
                    'returns'   => 0,
                    'status_id' => $orderDetailes_status
                ]);
             return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);

        }elseif($orderDetailes->product_status  == 4 && $orderDetailes_status == 6)                  // 4 TO 6
        {
            // return "4 to 6";
            
            
                         
             $reserves = Reserve::with('reservesDetailes')->where('supplier_id',$orderDetailes->product->supplier_id)->whereDate('created_at', Carbon::today()->toDateString())->first();
            // return $reserves;
            if ($reserves && $reserves->count() > 0) 
            {
                $checkDetailes = $reserves->reservesDetailes->where('product_id',$orderDetailes->product->id)->first();
                if (isset($checkDetailes) && $checkDetailes->count() > 0) 
                {
                    return \response()->json(
                        [
                            'status'                => false,     
                            'msg'                   => 'تم تعديل حالة الشحنة من قبل',
                        ]);
                }else
                {
                    $createReserveDetailes = ReserveOrder::create(
                        [
                            'product_id'    => $orderDetailes->product->id,
                            'status_id'     => 6,
                            'reserve_id'    => $reserves->id
                        ]);
                }
                
            }else
            {
                // $checkDetailes = $reserves->reservesDetailes->where('product_id',$orderDetailes->product->id)->first();
                $product = ReserveOrder::where('product_id',$orderDetailes->product->id)->where('created_at',Carbon::today()->toDateString())->first();
                if (isset($product) && $product->count() > 0) 
                {
                    return \response()->json(
                        [
                            'status'                => false,     
                            'msg'                   => 'تم تعديل حالة الشحنة من قبل',
                        ]);
                } else 
                {
                    $createReserve = Reserve::create(
                        [
                            'supplier_id' => $orderDetailes->product->supplier_id
                        ]) ;
    
                    $createReserveDetailes = ReserveOrder::create(
                        [
                            'product_id'    => $orderDetailes->product->id,
                            'status_id'     => 6,
                            'reserve_id'    => $createReserve->id
                        ]);
                }
                // return "no";
            }
            
            //   UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
               [
                   'product_status' => $orderDetailes_status,
               ]);

           // UPDATE ORDER TABLE 
           $orderDetailes->order->update(
               [
                   'total_prices'      => $orderDetailes->order->total_prices + $orderDetailes->total_price,
                   'total_shipping'      => $orderDetailes->order->total_shipping + $orderDetailes->shipping_price,
               ]);

           // UPDATE PRODUCT TABLE 
           $orderDetailes->product->update(
               [
                   'type'      => 1,
                   'returns'   => 0,
                   'status_id' => $orderDetailes_status
               ]);
               return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 4 && $orderDetailes_status == 7)                  // 4 TO 7      
        {
            // return "4 to 7";
            //   UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => $orderDetailes_status,
                ]);
 
            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 2,
                    'returns'   => 1,
                    'status_id' => $orderDetailes_status
                ]);

                 // UPDATE ORDER TABLE 
            // $orderDetailes->order->update(
            //     [
            //         'total_prices'      => $orderDetailes->order->total_prices + $orderDetailes->shipping_price,
            //         'total_shipping'      => $orderDetailes->order->total_shipping + $orderDetailes->shipping_price,
                   
            //     ]);
             return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 5 && $orderDetailes_status == 2)                  // 5 TO 2
        {
            //  return "5 to 2";

             //   UPDATE ORDER DETAILES TABLE 
             $orderDetailes->update(
                [
                    'product_status' => 2,
                ]);
            $orderDetailes->restore();

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 1,
                    'returns'   => 0,
                    'status_id' => 2
                ]);
             return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 5 && $orderDetailes_status == 3)                  // 5 TO 3      
        {
            // return "5 to 3";

             //   UPDATE ORDER DETAILES TABLE 
             $orderDetailes->update(
                [
                    'product_status' => 3,
                ]);

            // UPDATE ORDER TABLE 
            $orderDetailes->order->update(
                [
                    'total_prices'      => $orderDetailes->order->total_prices - $orderDetailes->total_price,
                    'total_shipping'    => $orderDetailes->order->total_shipping - $orderDetailes->shipping_price,
                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 0,
                    'returns'   => 1,
                    'status_id' => 3
                ]);
             return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);

        }elseif($orderDetailes->product_status  == 5 && $orderDetailes_status == 4)                  // 5 TO 4 
        {
            // return "5 to 4";

            //   UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
               [
                   'product_status' => 4,
               ]);

           // UPDATE ORDER TABLE 
           $orderDetailes->order->update(
               [
                   'total_prices'      => $orderDetailes->order->total_prices - $orderDetailes->total_price,
                   'total_shipping'    => $orderDetailes->order->total_shipping - $orderDetailes->shipping_price,
               ]);

           // UPDATE PRODUCT TABLE 
           $orderDetailes->product->update(
               [
                   'type'      => 0,
                   'returns'   => 1,
                   'status_id' => 4
               ]);
               return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 5 && $orderDetailes_status == 6)                  // 5 TO 6 
        {
            //  return "5 to 6";
            
             $reserves = Reserve::with('reservesDetailes')->where('supplier_id',$orderDetailes->product->supplier_id)->whereDate('created_at', Carbon::today()->toDateString())->first();
            // return $reserves;
            if (isset($reserves) && $reserves->count() > 0) 
            {
                $checkDetailes = $reserves->reservesDetailes->where('product_id',$orderDetailes->product->id)->first();
                if (isset($checkDetailes) && $checkDetailes->count() > 0) 
                {
                    return \response()->json(
                        [
                            'status'                => false,     
                            'msg'                   => 'تم تعديل حالة الشحنة من قبل',
                        ]);
                }else
                {
                    $createReserveDetailes = ReserveOrder::create(
                        [
                            'product_id'    => $orderDetailes->product->id,
                            'status_id'     => 6,
                            'reserve_id'    => $reserves->id
                        ]);
                }
                
            }else
            {
                // $checkDetailes = $reserves->reservesDetailes->where('product_id',$orderDetailes->product->id)->first();
                $product = ReserveOrder::where('product_id',$orderDetailes->product->id)->where('created_at',Carbon::today()->toDateString())->first();
                if (isset($product) && $product->count() > 0) 
                {
                    return \response()->json(
                        [
                            'status'                => false,     
                            'msg'                   => 'تم تعديل حالة الشحنة من قبل',
                        ]);
                } else 
                {
                    $createReserve = Reserve::create(
                        [
                            'supplier_id' => $orderDetailes->product->supplier_id
                        ]) ;
    
                    $createReserveDetailes = ReserveOrder::create(
                        [
                            'product_id'    => $orderDetailes->product->id,
                            'status_id'     => 6,
                            'reserve_id'    => $createReserve->id
                        ]);
                }
                // return "no";
            }
            

             //   UPDATE ORDER DETAILES TABLE 
             $orderDetailes->update(
                [
                    'product_status' => 6,
                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 1,
                    'returns'   => 0,
                    'status_id' => 6
                ]);
             return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 5 && $orderDetailes_status == 7)                  // 5 TO 7      
        {
            // return "5 to 7";

             //   UPDATE ORDER DETAILES TABLE 
             $orderDetailes->update(
                [
                    'product_status' => 7,
                ]);

            // UPDATE ORDER TABLE 
            $orderDetailes->order->update(
                [
                    'total_prices'      => $orderDetailes->order->total_prices - $orderDetailes->total_price,
                    'total_shipping'    => $orderDetailes->order->total_shipping - $orderDetailes->shipping_price,
                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 2,
                    'returns'   => 1,
                    'status_id' => 7
                ]);
             return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 6 && $orderDetailes_status == 2)                  // 6 TO 2
        {
            //  return "6 to 2";

             //   UPDATE ORDER DETAILES TABLE 
             $orderDetailes->update(
                [
                    'product_status' => 2,
                ]);
            $orderDetailes->restore();

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 1,
                    'returns'   => 0,
                    'status_id' => 2
                ]);
            return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 6 && $orderDetailes_status == 3)                  // 6 TO 3      
        {
            // return "6 to 3";

             //   UPDATE ORDER DETAILES TABLE 
             $orderDetailes->update(
                [
                    'product_status' => 3,
                ]);

            // UPDATE ORDER TABLE 
            $orderDetailes->order->update(
                [
                    
                   'total_prices'      => $orderDetailes->order->total_prices - $orderDetailes->total_price,
                   'total_shipping'    => $orderDetailes->order->total_shipping - $orderDetailes->shipping_price,
                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 0,
                    'returns'   => 1,
                    'status_id' => 3
                ]);
            return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);

        }elseif($orderDetailes->product_status  == 6 && $orderDetailes_status == 4)                  // 6 TO 4 
        {
            // return "6 to 4";

            //   UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
               [
                   'product_status' => 4,
               ]);

           // UPDATE ORDER TABLE 
           $orderDetailes->order->update(
               [
                   'total_prices'      => $orderDetailes->order->total_prices - $orderDetailes->total_price,
                   'total_shipping'    => $orderDetailes->order->total_shipping - $orderDetailes->shipping_price,
               ]);

           // UPDATE PRODUCT TABLE 
           $orderDetailes->product->update(
               [
                   'type'      => 0,
                   'returns'   => 1,
                   'status_id' => 4
               ]);
               return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 6 && $orderDetailes_status == 5)                  // 6 TO 5 
        {
            //  return "6 to 5";

             //   UPDATE ORDER DETAILES TABLE 
             $orderDetailes->update(
                [
                    'product_status' => 5,
                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 1,
                    'returns'   => 0,
                    'status_id' => 5
                ]);
            return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 6 && $orderDetailes_status == 7)                  // 6 TO 7      
        {
            // return "6 to 7";

             //   UPDATE ORDER DETAILES TABLE 
             $orderDetailes->update(
                [
                    'product_status' => 7,
                ]);

            // UPDATE ORDER TABLE 
            $orderDetailes->order->update(
                [
                    'total_prices'      => $orderDetailes->order->total_prices - $orderDetailes->total_price,
                   'total_shipping'    => $orderDetailes->order->total_shipping - $orderDetailes->shipping_price,
                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 2,
                    'returns'   => 1,
                    'status_id' => 7
                ]);
            return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 7 && $orderDetailes_status == 3)                  // 7 TO 3 
        {
             // return "7 to 3";

            // UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => 3,
                ]);
            $orderDetailes->delete();

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 0,
                    'returns'   => 1,
                    'status_id' => 3
                ]);
                return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 7 && $orderDetailes_status == 4)                 // 7 TO 4 
        {
             //  return "7 to 4";
         
            // UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => 4,
                    'profit'         => 0,
                ]);
            $orderDetailes->delete();

           

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 0,
                    'returns'   => 1,
                    'status_id' => 4
                ]);
                return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 7 && $orderDetailes_status == 5)                 // 7 TO 5 
        {
            //  return "7 to 5";

            //   UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => $orderDetailes_status,
                ]);

            // UPDATE ORDER TABLE 
            $orderDetailes->order->update(
                [
                    'total_prices'      => $orderDetailes->order->total_prices + $orderDetailes->total_price,
                   'total_shipping'    => $orderDetailes->order->total_shipping + $orderDetailes->shipping_price,
                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 1,
                    'returns'   => 0,
                    'status_id' => $orderDetailes_status
                ]);
           return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 7 && $orderDetailes_status == 6)                 // 7 TO 6 
        {
            //  return "7 to 6";
            
            
                         $reserves = Reserve::with('reservesDetailes')->where('supplier_id',$orderDetailes->product->supplier_id)->whereDate('created_at', Carbon::today()->toDateString())->first();
            // return $reserves;
            if ($reserves && $reserves->count() > 0) 
            {
                $checkDetailes = $reserves->reservesDetailes->where('product_id',$orderDetailes->product->id)->first();
                if (isset($checkDetailes) && $checkDetailes->count() > 0) 
                {
                    return \response()->json(
                        [
                            'status'                => false,     
                            'msg'                   => 'تم تعديل حالة الشحنة من قبل',
                        ]);
                }else
                {
                    $createReserveDetailes = ReserveOrder::create(
                        [
                            'product_id'    => $orderDetailes->product->id,
                            'status_id'     => 6,
                            'reserve_id'    => $reserves->id
                        ]);
                }
                
            }else
            {
                // $checkDetailes = $reserves->reservesDetailes->where('product_id',$orderDetailes->product->id)->first();
                $product = ReserveOrder::where('product_id',$orderDetailes->product->id)->where('created_at',Carbon::today()->toDateString())->first();
                if (isset($product) && $product->count() > 0) 
                {
                    return \response()->json(
                        [
                            'status'                => false,     
                            'msg'                   => 'تم تعديل حالة الشحنة من قبل',
                        ]);
                } else 
                {
                    $createReserve = Reserve::create(
                        [
                            'supplier_id' => $orderDetailes->product->supplier_id
                        ]) ;
    
                    $createReserveDetailes = ReserveOrder::create(
                        [
                            'product_id'    => $orderDetailes->product->id,
                            'status_id'     => 6,
                            'reserve_id'    => $createReserve->id
                        ]);
                }
                // return "no";
            }
            

            //   UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => $orderDetailes_status,
                ]);

            // UPDATE ORDER TABLE 
            $orderDetailes->order->update(
                [
                    'total_prices'      => $orderDetailes->order->total_prices + $orderDetailes->total_price,
                    'total_shipping'    => $orderDetailes->order->total_shipping + $orderDetailes->shipping_price,
                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 1,
                    'returns'   => 0,
                    'status_id' => $orderDetailes_status
                ]);
           return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }elseif($orderDetailes->product_status  == 7 && $orderDetailes_status == 2)                 // 7 TO 2 
        {
            //  return "7 to 2";

            //   UPDATE ORDER DETAILES TABLE 
            $orderDetailes->update(
                [
                    'product_status' => $orderDetailes_status,
                ]);
            $orderDetailes->restore();

            // UPDATE ORDER TABLE 
            $orderDetailes->order->update(
                [
                    'total_prices'      => $orderDetailes->order->total_prices + $orderDetailes->total_price,
                   'total_shipping'    => $orderDetailes->order->total_shipping + $orderDetailes->shipping_price,
                ]);

            // UPDATE PRODUCT TABLE 
            $orderDetailes->product->update(
                [
                    'type'      => 1,
                    'returns'   => 0,
                    'status_id' => $orderDetailes_status
                ]);

            return \response()->json(
                [
                    'status'                => true,
                    'status_name'           => $orderDetailes->status->name,
                    'status_date_update'    => $orderDetailes->updated_at,
                    'msg'                   => 'تم تعديل حالة الشحنة بنجاح',
                ]);
        }else
        {
            return \response()->json(
                [
                    'status'                => false,     
                    'msg'                   => 'يجب اختيار الحالة بشكل صحيح',
                ]);
        }

       
    }
    
    
    
     public function updateOrderItem($id,Request $request) // TO UPDATE ORDER DETAILES DATA
    {
    
        $product = OrderDetailes::withTrashed()->with('product','order')->find($id);
        $total      = $product->total_price;
        $shipping   = $product->shipping_price;
       
        // CHECK IF ORDER DETAILES IS FOUND 
        if (isset($product)) 
        {
            DB::beginTransaction();
          
               // CHECK IF TOTAL PRICES IN REQUEST HAS CHANGED 
            if ($request->total_price == $product->total_price) 
            {
                $orderDetailes = $product->update(
                    [
                        'total_price'       => $request->total_price,
                        'shipping_price'    => $request->shipping_price,
                        'notes'             => $request->notes,
                    ]);
    
                $products = $product->product->update(
                    [
                        'total_price'       => $request->total_price,
                        'shipping_price'    => $request->shipping_price,
                        'product_price'     => $request->product_price,
                        'resever_name'      => $request->resever_name,
                        'resver_phone'      => $request->resver_phone,
                        'notes'             => $request->notes,
                    ]);

                DB::commit();
            }else
            {
                $orderDetailes = $product->update(
                    [
                        'total_price'       => $request->total_price,
                        'shipping_price'    => $request->shipping_price,
                        'notes'             => $request->notes,
                    ]);
    
                $products = $product->product->update(
                    [
                        'total_price'       => $request->total_price,
                        'shipping_price'    => $request->shipping_price,
                        'product_price'     => $request->product_price,
                        'resever_name'      => $request->resever_name,
                        'resver_phone'      => $request->resver_phone,
                        'notes'             => $request->notes,
                    ]);
                
                // if ($product->product_status == 3 || $product->product_status == 4) 
                // {
                //     $order = $product->order->update(
                //         [
                //             'total_prices'  => ($product->order->total_prices + $request->shipping_price) - $shipping,
                //         ]);
                // } else 
                // {

                //     $order = $product->order->update(
                //         [
                //             'total_prices'  => ($product->order->total_prices + $request->total_price) - $total,
                //         ]);
                       
                // }
                DB::commit();

            }
            return redirect()->route('orders.show',$product->order->id)->with(['success' => 'تم تعديل بيانات الشحنة بنجاح ']);
            DB::rollback();

        } else 
        {
            return \redirect()->route('orders.index')->with(['error' => 'لا يوجد شحنات ']);
            DB::rollback();
        } 
    }

}

