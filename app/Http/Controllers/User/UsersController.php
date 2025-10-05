<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Product;
use App\Models\Returns;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\OrderDetailes;
use App\Models\OrderReturnStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\filterRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\UserProfileRequest;

class UsersController extends Controller
{
    

    public function packageDetailes($id)
    {
        $product = Product::with('orders_detailes')->find($id);
        
        return view('user.packageDetailes',compact('product'));
    }


   public function filter(filterRequest $request)
   {
    
        $search2        = $_GET['filter'];
        // return auth()->user()->phone;
        $supplier       = Supplier::where('phone',auth()->user()->phone)->first();
        // return $supplier;
        $products       = Product::where('resver_phone','LIKE','%'.$search2.'%')->orWhere('resever_name','LIKE','%'.$search2.'%')->with('orders_detailes','status','supplier')->where('supplier_id',$supplier->id)->get(); 
        // return $products;
    
        return response()->json(
        [
            'status'    => true,
            'dataa'     => $products
        ]);   
   }



   public function profile()
   {
       return view('user.profile.edit');
   }


   public function updateProfile(UserProfileRequest $request)
   {
    try 
    {
        $user = auth()->user();
        // return $user;
        $update =  $user->update(
            [
                'name'      => $request->name,
                'phone'     => $request->phone,
                'email'     => $request->email,
                'password'  =>  bcrypt($request->password),
            ]);

            return redirect()->back()->with(['success' => 'تم تعديل الملف الشخصي بنجاح']);

    } catch (\Throwable $th) 
    {
        return redirect()->back()->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
    }
   }


}
