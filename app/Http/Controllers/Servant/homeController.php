<?php

namespace App\Http\Controllers\Servant;

use App\Models\Order;
use App\Models\Servant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginServantRequest;

class homeController extends Controller
{
    public function login()
    {
        return view('servant.login');
    }

    public function makeLogin(LoginServantRequest $request)
    {
        // return $request;
        if(Auth::guard('servant')->attempt(['phone' =>$request->phone,'password' =>$request->password]))
        {
            return redirect()->route('servant.home');
        }
            return back()->with(['error' => 'البيانت غير صحيحة']);
    }

    public function home()
    {
        $data = Servant::with('orders')->where('id',auth()->user()->id)->get();
        $data = Servant::with(['orders' => function($q)
        {
            $q->where('deleted_at',null);
        }])->where('id',auth()->user()->id)->get();
        // return $data;
        return view('servant.home',compact('data'));
    }

    public function logout()
    {
        \auth()->guard('servant')->logout();
        return redirect()->route('servant.login');
    }

    public function allOrders()
    {
        $data = Servant::with('orders')->where('id',auth()->user()->id)->get();
        return view('servant.allOrders',compact('data'));
    }

    public function showOrderDetailes($id)
    {
        $detailes = Order::withTrashed()->with('orders_detailes')->find($id);
        // return $detailes;
        return view('servant.showOrderDetailes',compact('detailes'));
    }
}
