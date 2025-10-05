<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\create_productRequest;
use App\Models\City;
use App\Models\Governorate;
use App\Models\OrderDetailes;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class productsController extends Controller
{
    public function index()
    {
        $supplier = Supplier::where('phone',auth()->user()->phone)->with(['products_supplier' => function($q)
        {
            $q->orderBy('updated_at','DESC');
        }])->first();
        
        // return $supplier;

        if ($supplier == '')
        {
            $products           = '';
            return view('home',compact('products'));
        } else
        {
            $products = $supplier->products_supplier;
            return view('user.products.index',compact('products'));
        }
    }


    public function cities($id)
    {
        $city = City::where('governorate_id',$id)->get();
        // return $city;
        return \response()->json($city);
    }


    public function create()
    {
        $governorates   = Governorate::all();
        return view('user.products.addProduct',compact('governorates'));
    }

    public function store(create_productRequest $request)
    {
        // return $request;
        try
        {
            $supplier = Supplier::where('phone',auth()->user()->phone)->first();
            // return $supplier;


               if ($supplier && $supplier->count() > 0  && $request->total_price != 0)
               {
                $create = Product::create(
                    [
                        'resever_name'       => $request->resever_name,
                        'resver_phone'       => $request->resver_phone,
                        'city_id'            => $request->city_id,
                        'adress'             => $request->adress,
                        'total_price'        => $request->total_price,
                        'shipping_price'     => $request->shipping_price,
                        'product_price'      => $request->product_price,
                        'status_id'          => 1,
                        'type'               => 4,
                        'notes'              => $request->notes,
                        'rescive_date'       => $request->rescive_date,
                        'package_number'     => mt_rand(1000000000, 9999999999),
                        'supplier_id'        => $supplier->id,
                        'user_id'            => auth()->user()->id
                    ]);

                return redirect()->route('user.index.product')->with(['successs' => 'تم تسجيل الشحنة بنجاح']);
               }else
               {
                   return redirect()->back()->with(['error' => 'رقم التليفون ليس مسجل لدي الشركة']);
               }

        } catch (\Throwable $th)
        {
            return $th;
            return redirect()->route('home')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }

    }


    public function edit($id)
    {
        try
        {
            $governorates   = Governorate::all();
            $product        = Product::find($id);
            $this_gov       = $product->cities2->governorate->id;
            // return $this_gov;
            return view('user.products.edit',compact('governorates','product','this_gov'));
        } catch (\Throwable $th)
        {
            //throw $th;
        }
    }


    public function update(create_productRequest $request, $id)
    {
        // return $request;
        try
        {
            $product    = Product::find($id);
            $supplier   = Supplier::where('phone',auth()->user()->phone)->first();
            // return $supplier;


               if ($supplier && $supplier->count() > 0)
               {
                $update = $product->update(
                    [
                        'resever_name'       => $request->resever_name,
                        'resver_phone'       => $request->resver_phone,
                        'city_id'            => $request->city_id,
                        'adress'             => $request->adress,
                        'total_price'        => $request->total_price,
                        'shipping_price'     => $request->shipping_price,
                        'product_price'      => $request->product_price,
                        'status_id'          => 1,
                        'type'               => 4,
                        'notes'              => $request->notes,
                        'rescive_date'       => $request->rescive_date,
                        'package_number'     => mt_rand(1000000000, 9999999999),
                        'supplier_id'        => $supplier->id,
                        'user_id'            => auth()->user()->id
                    ]);

                return redirect()->back()->with(['success' => 'تم تعديل الشحنة بنجاح']);
               }else
               {
                   return redirect()->back()->with(['error' => 'رقم التليفون ليس مسجل لدي الشركة']);
               }

        } catch (\Throwable $th)
        {
            return $th;
            return redirect()->route('home')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }


    public function delete($id)
    {
        $product = Product::find($id);
        try
        {
           if ($product && $product->type == 4)
           {
                $product->forceDelete();
                return redirect()->back()->with(['success' => 'تم حزف الشحنة بنجاح']);
           }else
           {
                return redirect()->back()->with(['error' => 'هذه الشحنة لا يمكن مسحها']);
           }
        } catch (\Throwable $th)
        {
            return redirect()->route('home')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }


}
