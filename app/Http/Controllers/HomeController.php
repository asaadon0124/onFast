<?php

namespace App\Http\Controllers;

use \App\Models\OrderDetailes;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $data['supplier'] = Supplier::where('phone',auth()->user()->phone)->with(['products_supplier' => function($q)
        {
            $q->orderBy('updated_at','DESC')->take(10);
        }])->first();

        $data['proCount'] = Supplier::where('phone',auth()->user()->phone)->withCount('products_supplier')->first();
        $data['proUnCompletedCount'] = Supplier::where('phone', auth()->user()->phone)
        ->withCount(['products_supplier' => function($q) 
        {
            $q->whereIn('status_id', [2, 5]); // Use whereIn for multiple values
        }])
        ->first();
        $data['proCompletedCount'] = Supplier::where('phone', auth()->user()->phone)
        ->withCount(['products_supplier' => function($q) 
        {
            $q->whereIn('status_id',['6']); // Use whereIn for multiple values
        }])
        ->first();

        if ($data['supplier'] == '')
        {
            $products           = '';
            return view('home',$data);
        } else
        {
            $data['products'] = $data['supplier']->products_supplier;           
            return view('home',$data);
        }
    }
}
