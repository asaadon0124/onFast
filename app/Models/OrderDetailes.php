<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Status;
use App\Models\Returns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetailes extends Model
{
    use SoftDeletes;


    protected $table = 'order_detailes';
    public $timestamps = true;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function product2()
    {
        return $this->belongsTo('App\Models\Product', 'product_id')->with('supplier','cities2');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id')->withTrashed();
    }
    
    public function order2()
    {
        return $this->belongsTo(Order::class,'order_id')->with('servant')->withTrashed();
    }

   
    public function status()
    {
        return $this->belongsTo(Status::class,'product_status','id')->withTrashed();
    }

    public function orderStatusReturns()
    {
        return $this->hasMany('App\Models\order_return_statuses')->withTrashed();
    }
}
