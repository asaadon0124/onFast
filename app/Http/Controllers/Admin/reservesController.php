<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Reserve;
use App\Models\Supplier;
use App\Models\ReserveOrder;
use Illuminate\Http\Request;
use App\Models\OrderDetailes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class reservesController extends Controller
{
    public function index()
    {
        $to = Carbon::now();
        $reserves = Reserve::whereBetween('created_at',array('2024-12-01',$to))->orderBy('created_at', 'desc')->limit(300)->get();
        return view('admin.reserves.index',compact('reserves'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('admin.reserves.create',compact('suppliers'));
    }

    public function search(Request $request)
    {
        // return $request;
        $productsReturend = Product::with('supplier','cities','status')->where('supplier_id',$request->supplier_id)->where('type',2)->where('status_id',7)->get();
        return \response()->json($productsReturend);
    }


    // public function addToCart(Request $request)     // TO ADD PRODUCT TO FILE DETAILES PAGE AND DELETE IT FROM PRODUCTS PAGE
    // {
    //     $validated = $request->validate([
    //         'sup_id' => 'required',
    //     ]);

    //     $product_delete = Product::find($request->id);
    //     $product_order  = OrderDetailes::withTrashed()->where('product_id',$request->id)->first();


    //     DB::beginTransaction();
    //     $product_delete->update(
    //         [
    //             'type'              => 5,
    //         ]);
            
    //     $product_order->update(
    //         [
    //             'type'              => 5,
    //         ]);


    //       // ADD PRODUCT TO ORDER DETAILES TABLE
    //     $createOrderDetailes = ReserveOrder::create(
    //     [
    //         'product_id'        => $product_delete->id,
    //         'status_id'         => 7,
    //         'reserve_id'        => null,
    //     ]);

    //     DB::commit();
    //     DB::rollback();
    //     return \response()->json(
    //         [
    //             'status'        => true,
    //             'msg'           => 'تم تحصيل الشحنة بنجاح',
    //             'id'            => $request->id
    //         ]);
    // }

    public function store(Request $request) // SHOW DATA IN SUBMET NEW FILE PAGE
    {
        // return $request->sup_id;
        $reserveDetailes            = ReserveOrder::with('product')->where('reserve_id',null)->get();
        $reserveDetailesSupplier    = $reserveDetailes->first();
        $supplier_id                = $reserveDetailesSupplier->product->supplier_id;

        if($request->sup_id && $request->sup_id != null && $reserveDetailes && $reserveDetailes->count() > 0)
        {
            DB::beginTransaction();
           
            $create = Reserve::create(
                [
                    'supplier_id' => $supplier_id
                ]);

            foreach ($reserveDetailes as $pro) 
            {
                $update = $pro->update(
                    [
                        'reserve_id' => $create->id
                    ]);
            }
            $reserve_id = $create->id;

            DB::commit();
            DB::rollBack();
        }else
        {
            return "no";
        }

        return view('admin.reserves.reservesDetailes',\compact('reserve_id'));
    }

    public function show($id)
    {
        $proDetailes = Reserve::with('reservesDetailes')->find($id);
        $data = $proDetailes->reservesDetailes->pluck('product')->sum('product_price');
        // return $data;
        return view('admin.reserves.reservesDetailes',compact('proDetailes','data'));
    }

    public function edit($id)
    {
        $reserve    = Reserve::with('supplier')->find($id);
        $products   = Product::withTrashed()->where('status_id',7)->where('type',2)->where('supplier_id',$reserve->supplier->id)->get();
        // return $products; 
        return view('admin.reserves.edit',compact('reserve','products'));
    }

    public function update(Request $request)
    {
        $product_delete = Product::find($request->id);
        $product_order  = OrderDetailes::withTrashed()->where('product_id',$request->id)->first();
        // return $product_order;

        DB::beginTransaction();
        $product_delete->update(
            [
                'type'              => 5,
            ]);
            
        $product_order->update(
            [
                'type'              => 5,
            ]);


          // ADD PRODUCT TO ORDER DETAILES TABLE
        $createOrderDetailes = ReserveOrder::create(
        [
            'product_id'        => $product_delete->id,
            'status_id'         => 7,
            'reserve_id'        => $request->reserve,
        ]);

        DB::commit();
        DB::rollback();
        return \response()->json(
            [
                'status'        => true,
                'msg'           => 'تم تحصيل الشحنة بنجاح',
                'id'            => $request->id
            ]);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $proDetailes        = ReserveOrder::with('product')->find($id);
        // return $proDetailes->product->orders_detailes->first();

        $updatePro          = $proDetailes->product->update(
            [
                'type'      => 1,
                'status_id' => 2,
                'returns'   => 0,
            ]);

        $updateOrderDetailes = $proDetailes->product->orders_detailes->first()->update(
            [
                'type'              => 0,
                'product_status'    => 2,
            ]);

        $delete = $proDetailes->delete();

        DB::commit();
        DB::rollBack();
        return redirect()->back()->with(['success' => 'تم الحزف بنجاح']);

    }


}
