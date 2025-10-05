<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Order;
use App\Models\Status;
use App\Models\Product;
use App\Models\Servant;
use App\Models\Supplier;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\OrderDetailes;
use App\Models\OrderReturnStatus;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\productSearchReuest;

class orderDetailesController extends Controller
{
     public function create()
    {
        $governorates = Governorate::all();
        $servants = Servant::all();

        return view('admin.orderDetailes.create',compact('governorates','servants'));
    }

    public function cities($id)
    {
        $city = City::where('governorate_id',$id)->get();
        return \response()->json($city);
    }

    public function search(productSearchReuest $request)
    {
        // return $request;
        $productsReturend = Product::with('supplier','cities','status')->where('city_id',$request->city_id)->where('type',0)->where('status_id','<>',3)->get();
        return \response()->json($productsReturend);
    }

    public function addToCart(Request $request)     // TO ADD PRODUCT TO ORDER DETAILES PAGE AND DELETE IT FROM PRODUCTS PAGE
    {
        // DELETE ROW FROM PRODUCTS TABLE
        $product_delete = Product::find($request->id);
        $checkPro       = OrderDetailes::where('product_id',$product_delete->id)->first(); 
        
          if (isset($checkPro) && $checkPro->count() > 0) 
          {
                return \response()->json(
              [
                  'status'        => false,
                  'msg'           => 'هذه الشحنة مضافة من قبل',
                  
              ]);
          }else
          {
               DB::beginTransaction();
        $product_delete->update(
            [
                'type'              => 1,
                'status_id'         => 2
            ]);


          // ADD PRODUCT TO ORDER DETAILES TABLE
        $createOrderDetailes = OrderDetailes::create(
        [
            'product_id'        => $product_delete->id,
            'product_status'    => $product_delete->status_id,
            'shipping_price'    => $product_delete->shipping_price,
            'total_price'       => $product_delete->total_price,
            'user_id'           => auth()->user()->id
        ]);

        DB::commit();
        DB::rollback();
        return \response()->json(
            [
                'status'        => true,
                'msg'           => 'تم حزف الشحنة من المخزن بنجاح',
                'id'            => $request->id
            ]);
          }

       
    }

    public function forceDelete($id)      // DELETE ITEMS FROM ORDER DETAILES TABLE IF I DON,T CREATED NEW ORDER
    {
        // GET ITEM FROM ORDER DETAILES TABLE  TO DELETE IT
            $item = OrderDetailes::withTrashed()->find($id);

        // CHECK IF ITEM IN ORDER DETAILES TABLE NOT HAVE ORDER_ID
            if(!$item->order_id == null)
            {
                return \redirect()->back()->with(['error' => 'هذه الشحنة لا يمكن مسحها لانها لدي اوردر']);
            }else
            {


        // CHANGE STATUS OF ITEM RESTORING TO PENDING
            $update = $item->product->update(
                [
                    'status_id' => 1,
                    'type'      => 0,
                ]);

        // FORCE DELETE FOR THIS ITEM FROM ORDER DETAILES TABLE
                $item->forceDelete();
                return \redirect()->back()->with(['success' => 'تم مسح الشحنة بنجاح من الاوردر و اعادتها الي جدول الشحنات']);
            }

    }

    public function submit_new_order() // SHOW DATA IN SUBMET NEW ORDER PAGE
    {
        $orderDetailes = OrderDetailes::with('product')->where('order_id',null)->where('user_id',auth()->user()->id)->get();

        $servants   = Servant::where('deleted_at',null)->get();
        $orders     = Order::get()->last();
        // return $orders;

        $items = OrderDetailes::where('order_id',null)->where('user_id',auth()->user()->id)->get();
        $totalPrice = $items->sum('total_price');
        // return $totalPrice;

        return view('admin.orderDetailes.submit_new_order',\compact('orderDetailes','totalPrice','servants','orders'));
    }



    public function changeShippingPrice(Request $request)  // CHANGE SHIPPING PRICE OF
    {
        // UPDATE CHIPPING PRICE FOR ORDERS
        $price = OrderDetailes::with('product')->find($request->id);

        DB::beginTransaction();
        $price->update(
            [
                'shipping_price' => $request->price
            ]);


        // GET TOTAL PRICE FOR PRODUCT
        $totalPrice = $price->product->product_price + $price->shipping_price;
        // return $totalPrice;

        $price->update(
            [
                'total_price' => $totalPrice
            ]);
            DB::commit();
            DB::rollback();


        return \response()->json(
            [
                'status' => true,
                'msg' => 'تم    التعديل بنجاح',
            ]);




    }


     public function filter(Request $request)
    {
        // $query = $request->results;

        $results        = '';
        $search2        = $_GET['results'];
        $columns        = ['resever_name','resver_phone','supplier_id','id'];

        $query          = Product::select('*')->with('status','cities2','supplier');
        $supplier       = Supplier::where('name',$search2)->orWhere('phone',$search2)->orWhere('phone2',$search2)->first();


        if(isset($supplier) && $supplier->count() > 0)
        {

            $supplier_id =  $supplier->id;

            foreach($columns as $column)
            {
              $query->orWhere($column, '=', $supplier_id);
            }

        }else
        {
            foreach($columns as $column)
            {
              $query->orWhere($column,'LIKE','%'.$search2.'%')->where('type',0);
            }
        }
        $products = $query->get();
        // return $products;

        $total_row = $products->count();
        if ($total_row > 0)
        {
            foreach ($products as $row)
            {
                // return $row->id;

                $results .= '
                <tr class="productRow">
                <td>' . $row->id . '</td>
                <td>' . $row->supplier->name . '</td>
                <td>' . $row->resever_name . '</td>
                <td>' . $row->resver_phone . '</td>
                <td>' . $row->cities->name . '</td>
                <td>' . $row->adress . '</td>
                <td>' . $row->product_price . '</td>
                <td class="statusA'. $row->id .'">' . $row->status->name . '</td>
                <td>
                    <button class="btn btn-success createProductToOrder" id="add" product_id="'. $row->id .'">
                        اضافة
                    </button>
                </td>



                </tr>';
            }
        }else
        {
            $results = '
            <tr>
                <td align="center" colspan="12">لا يوجد شحنات</td>
            </tr>
            ';
        }

        $products = array
        (
            'ahmed' => $results,
        );

        return json_encode($products);
    }


    public function deleteProduct(Request $request)     // TO REFUSED PRODUCT FROM ORDER LIST PAGE AND DELETE IT FROM PRODUCTS PAGE
    {

        // DELETE ROW FROM PRODUCTS TABLE
        $product_delete = Product::with('orders_detailes')->find($request->id);
        $product        =  $product_delete->orders_detailes()->orderBy('created_at', 'desc')->first();

        DB::beginTransaction();
        $product_delete->update(
            [
                'type'              => 0,
                'status_id'         => 3,
                'returns'           => 1,
            ]);

        $product->update(
            [
                'product_status'    => 3,
            ]);

        DB::commit();
        DB::rollback();
        return \response()->json(
            [
                'status'        => true,
                'msg'           => 'تم حزف الشحنة من المخزن بنجاح',
                'id'            => $request->id
            ]);
    }
}
