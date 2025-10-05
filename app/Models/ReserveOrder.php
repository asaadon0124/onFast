<?php

namespace App\Models;
use App\Models\Reserve;


use Illuminate\Database\Eloquent\Model;

class ReserveOrder extends Model
{
    protected $table = 'reserve_orders';
    public $timestamps = true;
    protected $guarded = [];


    public function reserve()
    {
        return $this->belongsTo(Reserve::class,'reserve_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

}
