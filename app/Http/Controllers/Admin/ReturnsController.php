<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Status;
use App\Models\Product;
use App\Models\Returns;
use App\Models\Servant;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\OrderDetailes;
use App\Models\ReturnsDetailes;
use App\Models\OrderReturnStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ordersRequest;

class ReturnsController extends Controller
{
    public function index()
    {
        $allReturns = OrderDetailes::with('product')->where('product_status',3)->orWhere('product_status',4)->withTrashed()->get();
        // return $allReturns;
        return \view('admin.returns.index',\compact('allReturns'));
    }

    public function softDelete()
    {
        try
        {
            $orders = OrderDetailes::onlyTrashed()->with('order','product')->where('product_status',7)->get();
            // return $orders;
            if($orders)
            {
                return \view('admin.returns.softDelete',\compact('orders'));
            }else
            {
                return \redirect()->route('returns.index')->with(['error' => 'لا يوجد اوردرات محزوفة ']);
            }
        }catch (\Throwable $th)
        {

            return $th;
            return \redirect()->route('returns.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

      public function restore(Request $request)
    {

        $order_restore = Returns::withTrashed()->where('id',$request->id);

        $order_restore2 = Returns::where('id',$request->id)->get();
        // return $order_restore2;
        $last_status_id = Status::where('deleted_at',null)->get()->last()->id;

        // $items_id =  $order_restore2->pluck('id')->implode(', ');
        // $items = OrderDetailes::withTrashed()->where('order_id',$items_id)->get();


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
}
