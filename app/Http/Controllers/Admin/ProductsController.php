<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Status;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\OrderReturnStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\productsRequest;

class ProductsController extends Controller
{
    public function index()
    {
        $governorates   = Governorate::all();
        $suppliers      = Supplier::all();
                $products       = Product::with('supplier')->where('type',0)->where('returns',0)->orderBy('created_at', 'desc')->limit(250)->get();

        $status         = Status::all();
        // return $status->first();
        return \view('admin.products.index',\compact('products','governorates','suppliers','status'));
    }

    public function cities($id)
    {
        $city = City::where('governorate_id',$id)->get();
        // return $city;
        return \response()->json($city);
    }
    
    public function create()
    {
        $suppliers = Supplier::all();
        $governorates  = Governorate::all();
        return view('admin.products.create',compact('suppliers','governorates'));
    }

    public function store(productsRequest $request)
    {
        try
        {
            // CREATE DATA ON DATABASE
              $old_pro = Product::where('resver_phone',$request->resver_phone)->where('rescive_date',$request->rescive_date)->where('resever_name',$request->resever_name)->first();
            
              if (isset($old_pro) && $old_pro->count() > 0) 
              {
               return redirect()->route('products.index')->with(['error' => 'لم يتم تسجيل الشحنة']);   
              }else
              {
                   $create = Product::create(
                [
                    'supplier_id'        => $request->supplier_id,
                    'resever_name'       => $request->resever_name,
                    'resver_phone'       => $request->resver_phone,
                    'city_id'            => $request->city_id,
                    'adress'             => $request->adress,
                    'total_price'        => $request->total_price,
                    'shipping_price'     => $request->shipping_price,
                    'product_price'      => $request->product_price,
                    'status_id'          => 1,
                    'notes'              => $request->notes,
                    'rescive_date'       => $request->rescive_date,
                    'package_number'     => mt_rand(1000000000, 9999999999),
                    'admin_id'          => auth()->user()->id,
                ]);
                
                  return redirect()->route('products.index')->with(['success' => 'تم اضافة الشحنة بنجاح']);
              }
           

            
        }catch (\Throwable $th)
        {
            return $th;
            return \redirect()->route('products.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function edit($id)
    {
        try
        {
            $product = Product::find($id);
            if($product)
            {
                $suppliers      = Supplier::all();
                $status         = Status::all();
                $governorates   = Governorate::whereHas('cities')->get();
                $gover_id       = City::where('id',$product->city_id)->with('governorate')->get();
                // return $city;
                return \view('admin.products.edit',\compact('product','governorates','gover_id','suppliers','status'));
            }else
            {
                return \redirect()->route('products.index')->with(['error' => 'هذا المورد غير موجود']);
            }
        }catch (\Throwable $th)
        {

            return \redirect()->route('products.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function update(Request $request,$id)
    {

        try
        {
            $product = Product::find($id);

            // return $request;
            if(!$product)
            {

                return \redirect()->route('products.index')->with(['error' => 'هذه الشحنة غير موجودة']);
            }else
            {
                // return $product;

                $update = $product->update(
                    [
                        'supplier_id'        => $request->supplier_id,
                        'resever_name'       => $request->resever_name,
                        'resver_phone'       => $request->resver_phone,
                        'city_id'            => $request->city_id,
                        'adress'             => $request->adress,
                        'product_price'      => $request->product_price,
                        'total_price'        => $request->total_price,
                        'shipping_price'     => $request->shipping_price,
                        'status_id'          => $request->status_id,
                        'notes'              => $request->notes,
                        'rescive_date'       => $request->rescive_date,
                    ]);

                    // $orderStatusReturns = OrderReturnStatus::create(
                    //     [

                    //         'status_id' => 1,
                    //         'package_number' => $product->package_number,
                    //     ]);

                    return \redirect()->route('products.index')->with(['success' => 'تم التعديل بنجاح']);
            }
        }catch (\Throwable $th)
        {

            return $th;
            return \redirect()->route('products.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function destroy(Request $request)
    {
        $product_delete = Product::find($request->id);
        $product_delete->delete();

        return \response()->json(
            [
                'status' => true,
                'msg' => 'تم الحزف بنجاح',
                'id' => $request->id
            ]);
    }

    public function getSoftDelete()
    {
        try
        {
            $last_status_id = Status::where('deleted_at',null)->get()->last()->id;

            // return $last_status_id;
            $products = Product::onlyTrashed()->get();
            // return $servants;
            if($products)
            {
                return \view('admin.products.softDelete',\compact('products','last_status_id'));
            }else
            {
                return \redirect()->route('products.index')->with(['error' => 'لا يوجد شحنات محزوفة ']);
            }
        }catch (\Throwable $th)
        {

            return $th;
            return \redirect()->route('products.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function restore(Request $request)
    {

        $product = Product::onlyTrashed()->find($request->id);
        $product->restore();

        return \response()->json(
            [
                'status'    => true,
                'msg'       => 'تم التفعيل بنجاح',
                'id'        => $request->id
            ]);
    }

    public function show($id)
    {
        try
        {
            $product = Product::find($id);
            if(!$product)
            {
                return \redirect()->route('products.index')->with(['error' => 'هذه الشحنة غير موجودة']);

            }else
            {
                return \view('admin.products.show',\compact('product'));
            }
        }catch (\Throwable $th)
        {

            return $th;
            return \redirect()->route('products.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function uncompleateProducts()
    {
        $products       = Product::with('supplier')->where('type',1)->where('status_id',2)->get();
        return view('admin.products.uncompleateProducts',compact('products'));
    }

    public function compleatedProducts()
    {
        $products       = Product::with('supplier')->where('type',1)->where('status_id',5)->orWhere('status_id',6)->get();
        // return $products;
        return view('admin.products.compleatedProducts',compact('products'));
    }

    public function deletedProducts()
    {
        $products = Product::onlyTrashed()->get();
        return view('admin.products.deletedProducts',compact('products'));
    }


        // NEW USER PRODUCTS FUNCTIONS ***************************************************************

        public function newProducts_Index()
        {
            $products = Product::where('type',4)->get();
            return view('admin.products.newProducts.newProducts_Index',compact('products'));
        }


        public function newProducts_edit($id)
        {
            try
            {
                $product = Product::find($id);
                if($product)
                {
                    $suppliers      = Supplier::all();
                    $status         = Status::all();
                    $governorates   = Governorate::whereHas('cities')->get();
                    $gover_id       = City::where('id',$product->city_id)->with('governorate')->get();
                    // return $city;
                    return \view('admin.products.newProducts.newProducts_edit',\compact('product','governorates','gover_id','suppliers','status'));
                }else
                {
                    return \redirect()->route('products.index')->with(['error' => 'هذا المورد غير موجود']);
                }
            }catch (\Throwable $th)
            {

                return \redirect()->route('products.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
            }
        }

        public function newProducts_update($id,productsRequest $request)
        {
            try
            {
                $product = Product::find($id);

                // return $request;
                if(!$product)
                {

                    return \redirect()->route('products.newProducts_Index')->with(['error' => 'هذه الشحنة غير موجودة']);
                }else
                {
                    // return $product;

                    $update = $product->update(
                        [
                            'supplier_id'        => $request->supplier_id,
                            'resever_name'       => $request->resever_name,
                            'resver_phone'       => $request->resver_phone,
                            'city_id'            => $request->city_id,
                            'adress'             => $request->adress,
                            'product_price'      => $request->product_price,
                            'total_price'        => $request->total_price,
                            'shipping_price'     => $request->shipping_price,
                            'status_id'          => $request->status_id,
                            'notes'              => $request->notes,
                            'rescive_date'       => $request->rescive_date,
                        ]);

                    return \redirect()->route('products.newProducts_Index')->with(['success' => 'تم التعديل بنجاح']);
                }
            }catch (\Throwable $th)
            {

                return $th;
                return \redirect()->route('products.newProducts_Index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
            }
        }

        public function newProducts_accept(Request $request)
        {
            $product_accept = Product::find($request->id);
            $product_accept->update(
                [
                    'type' => 0
                ]);

            return \response()->json(
                [
                    'status' => true,
                    'msg' => 'تم قبول الشحنة بنجاح',
                    'id' => $request->id
                ]);
        }

}
