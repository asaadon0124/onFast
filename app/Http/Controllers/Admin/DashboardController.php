<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\City;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Status;
use App\Models\Product;
use App\Models\Reserve;
use App\Models\Returns;
use App\Models\Servant;
use App\Models\Supplier;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\OrderDetailes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\dashboardSearchRequest;

class DashboardController extends Controller
{
    public function index()
    {

        $from           = date('2021-11-15');
        $to             = Carbon::now();

        $allStatus      = Status::select('id','name')->where('id','<>',1)->get();
        $productsAll    = Product::with('orders_detailes')->whereBetween('created_at',array($from,$to))->get();


        return \view('admin.auth.Dashboard' ,compact('allStatus','productsAll') );

    }

    public function payMony(Request $request)
    {
        $product = OrderDetailes::withTrashed()->whereHas('product')->find($request->id);

        // UPDATE ORDER DETAILES TABLE
        $product->update(
            [
                'product_status' => 6
            ]);
        // UPDATE PRODUCTS TABLE
        $product->product->update(
            [
                'type'      => 1,
                'status_id' => 6,
            ]);
         return response()->json(
					 [
						 'status'   => true,
                         'msg'      => 'تم الحفظ بنجاح',
                         'id'       => $product->id,
                        //  'dataa'    => $create,
                        //  'sup'      =>$supplier,
                        //  'cit'      => $city,
                        //  'stat'     => $stats

					 ]);
    }

    public function endStatus($id)
    {
        $product = OrderDetailes::withTrashed()->whereHas('product')->find($id);

        $product->update(
            [
                'product_status' => 7
            ]);

        $product->product->update(
            [
                'type'      => 2,
                'status_id' => 7,
                'returns'   => 1
            ]);
        return redirect()->back()->with(['success' => 'تم تسليم الشحنة للعميل بنجاح']);

    }


    public function restore1($id)
    {
        $product = OrderDetailes::withTrashed()->whereHas('product')->find($id);

        // UPDATE ORDER DETAILES TABLE
        // return $product;
        $product->update(
            [
                'product_status' => 5
            ]);
        // UPDATE PRODUCTS TABLE
        $product->product->update(
            [
                'type'      => 1,
                'status_id' => 5,
            ]);
        return redirect()->back()->with(['success' => 'تم التحصيل بنجاح']);
    }

    public function restore2($id)
    {
        $product = OrderDetailes::withTrashed()->whereHas('product')->find($id);

        $product->update(
            [
                'product_status' => 3
            ]);

        $product->product->update(
            [
                'type'      => 0,
                'status_id' => 3,
                'returns'   => 1
            ]);
        return redirect()->back()->with(['success' => 'تم اعادة الشحنة  بنجاح']);

    }

    public function history(Request $request)
    {
        // return $request;
        // return Carbon::now('Africa/Cairo');

        $allStatus      = Status::select('id','name')->where('id','<>',1)->get();
        $cities         = City::all();
        $govs           = Governorate::all();

        $type           = $request->type;
        $search         = $request->search;
        $status         = $request->status;
        $gov            = $request->gov;
        $city           = $request->city;
        $from           = $request->from;
        $to             = $request->to;

        if ($type || $status || $city || $from)
        {
            if ($type == "supplier")
            {


                $supplier       = Supplier::where('name', 'like', "%{$search}%")->orWhere('phone', 'like', "%{$search}%")->first();
                // return $supplier;
                $productsAll    = Product::with('orders_detailes')->where('supplier_id',$supplier->id)->orderBy('created_at', 'desc')->paginate(10);

            }elseif($type == "status")
            {
                $status         = Status::where('id', 'like', "%{$status}%")->first();
                $productsAll    = Product::with('orders_detailes')->where('status_id',$status->id)->orderBy('created_at', 'desc')->paginate(10);

            }elseif($type == "city")
            {
                $productsAll    = Product::with('orders_detailes')->where('city_id',$request->city)->orderBy('created_at', 'desc')->paginate(10);

            }elseif ($type == "date")
            {
                $productsAll    = Product::with('orders_detailes')->whereBetween('created_at',array($from,$to))->orderBy('created_at', 'desc')->paginate(10);

            }elseif ($type == "resever")
            {
                $productsAll    = Product::with('orders_detailes')->where('resever_name', 'like', "%{$search}%")->orWhere('resver_phone', 'like', "%{$search}%")->orderBy('created_at', 'desc')->paginate(10);
            }


        }else
        {
            $productsAll    = Product::with('orders_detailes')->orderBy('created_at', 'desc')->where('type','<>',5)->paginate(10);

        }
        return view('admin.history',compact('productsAll','allStatus','request','cities','govs'));
    }


    public function filter2(Request $request)
    {
        // return $request;

        $results        = '';
        $option        = '';
        $search2        = $_GET['filter'];
        $allStatus      = Status::select('id','name')->where('id','<>',1)->get();

        foreach ($allStatus as $value)
        {
            $option .= '<option value="'. $value->id .'">
            '. $value->name .'
            </option>';
        }


        if($request->type == 'supplier' )
        {
            $supplier       = Supplier::where('name','LIKE', "%{$request->filter}%")->orWhere('phone','LIKE', "%{$request->filter}%")->orWhere('phone2','LIKE', "%{$request->filter}%")->first();
            $query          = Product::with('orders_detailes')->where('supplier_id',$supplier->id)->orderBy('created_at', 'desc')->paginate(10);

        }elseif($request->type == 'resever')
        {
            $query          = Product::with('orders_detailes')->where('resever_name','LIKE', "%{$request->filter}%")->orWhere('resver_phone','LIKE', "%{$request->filter}%")->orderBy('created_at', 'desc')->paginate(10);

        }elseif($request->type == 'status')
        {
            $query          = Product::with('orders_detailes')->where('status_id','LIKE', "%{$request->filter}%")->orderBy('created_at', 'desc')->paginate(10);

        }elseif($request->type == 'city')
        {
            $query          = Product::with('orders_detailes')->where('city_id','LIKE', "%{$request->filter}%")->orderBy('created_at', 'desc')->paginate(10);

        }elseif($request->type == 'date')
        {
            $query          = Product::with('orders_detailes')->whereBetween('created_at',array($request->filter,$request->date))->orderBy('created_at', 'desc')->paginate(10);

        }


        $total_row = $query->count();
         if ($total_row > 0)
        {
           foreach ($query as $product )
           {
                foreach ($product->orders_detailes as $row)
                {
                        // return $row->id;

                        if ($row->product_status != 6)
                        {
                            $results .= '
                            <tr>
                                <td>' . $row->created_at . '</td>
                                <td>' . $row->product2->rescive_date . '</td>
                                <td>' . $row->order2->servant->name . '<br/> ' . $row->order2->servant->phone . '</td>
                                <td>' . $row->product2->supplier->name . ' <br/>' . $row->product2->supplier->phone . '</td>
                                <td>' . $row->product2->resever_name . '<br/>' . $row->product2->resver_phone . '</td>
                                <td>' . $row->product2->cities->governorate->name . ' <br/> ' . $row->product2->cities->name . ' <br/> ' . $row->product2->adress . '</td>
                                <td>' . $row->product2->product_price . '</td>
                                <td>' . $row->shipping_price . '</td>
                                <td>' . $row->total_price . '</td>' .
                                '<td>
                                    <form>
                                        <input type="text" class="form-control" name="notes" id="notes2'.$row->id.'" value="'. $row->notes .'">
                                        <button class="notes2 btn btn-success btn-block" id="'. $row->id .'">
                                            تعديل
                                        </button>
                                    </form>
                                </td>
                                <td class="statusA'. $row->id .'">' . $row->status->name . '</td>
                                <td style="width:100px;" class="pro_row' . $row->id .'">
                                    <form class="status">
                                        <select name="status_id'. $row->id .'" class="st_id'.$row->id .' form-control" id="select'.$row->id .'">

                                            <option>
                                                اختار الحالة
                                            </option>
                                        '. $option .'

                                        </select>
                                        <div class="noPrint">
                                            <button class="btn btn-primary makeStatus" id="'. $row->id .'">
                                                تعديل
                                            </button>
                                        </div>
                                    </form>
                                    <p>' . $row->updated_at . '</p>
                                </td>



                            </tr>';
                        }else
                        {
                            $results .= '
                            <tr>
                                <td>' . $row->created_at . '</td>
                                <td>' . $row->product2->rescive_date . '</td>
                                <td>' . $row->order2->servant->name . '<br/> ' . $row->order2->servant->phone . '</td>
                                <td>' . $row->product2->supplier->name . ' <br/>' . $row->product2->supplier->phone . '</td>
                                <td>' . $row->product2->resever_name . '<br/>' . $row->product2->resver_phone . '</td>
                                <td>' . $row->product2->cities->governorate->name . ' <br/> ' . $row->product2->cities->name . ' <br/> ' . $row->product2->adress . '</td>
                                <td>' . $row->product2->product_price . '</td>
                                <td>' . $row->shipping_price . '</td>
                                <td>' . $row->total_price . '</td>' .
                                '<td>
                                    <form>
                                        <input type="text" class="form-control" name="notes" id="notes2'.$row->id.'" value="'. $row->notes .'">
                                        <button class="notes2 btn btn-success btn-block" id="'. $row->id .'">
                                            تعديل
                                        </button>
                                    </form>
                                     <p>' . $row->updated_at . '</p>
                                </td>
                                <td class="statusA'. $row->id .'">' . $row->status->name . '</td>
                            </tr>';
                        }



                }
           }
        }else
        {
            $results = '
            <tr>
                <td align="center" colspan="12">لا يوجد شحنات</td>
            </tr>
            ';
        }

        $query = array
        (
            'table_data' => $results,
        );

        return json_encode($query);

    }

    public function notes(Request $request)
    {
        // return $request->id;

        $update = OrderDetailes::withTrashed()->find($request->id);
                // return $update;

       if(isset($update))
       {
        $update->update(
            [
                'notes' => $request->notes
            ]);


            return response()->json(
                [
                    'status'   => true,
                    'msg'      => 'تم الحفظ بنجاح',
                ]);

       }else
       {
        return response()->json(
            [
                'status'   => false,
                'msg'      => 'لا يوجد بيانات',
            ]);
       }
    }


    public function test(Request $request)
    {
        return $request;
    }


    public static function sidebarData()
    {
        $data = [
            'admins_count'          => Admin::count(),
            'servants_count'        => Servant::count(),
            'servants_deleted'      => Servant::onlyTrashed()->count(),
            'suppliers_count'       => Supplier::count(),
            'suppliers_deleted'     => Supplier::onlyTrashed()->count(),
            'governorates_count'    => Governorate::count(),
            'governorates_deleted'  => Governorate::onlyTrashed()->count(),
            'cities_count'          => City::count(),
            'cities_deleted'        => City::onlyTrashed()->count(),
            'orders_count'          => Order::count(),
            'orders_deleted'        => Order::onlyTrashed()->count(),
            'products_count'        => Product::where('type',0)->where('returns',0)->count(),
            'products_new'          => Product::where('type',4)->where('returns',0)->count(),
            'products_completed'    => Product::where('type',1)
                                               ->where(function($q){
                                                   $q->where('status_id',5)
                                                     ->orWhere('status_id',6);
                                               })->count(),
            'products_deleted'      => Product::onlyTrashed()->count(),
            'reserves_count'        => Reserve::count(),
        ];

        // خزنه في الكاش بشكل دائم
        Cache::forever('sidebar_data', $data);

        // ورجع الداتا نفسها
        return $data;
    }


}
