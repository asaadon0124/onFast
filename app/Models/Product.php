<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';
    public $timestamps = true;

    protected $guarded = [];


    public function cities()
    {
        return $this->belongsTo('App\Models\City', 'city_id')->withTrashed();
    }
    public function cities2()
    {
        return $this->belongsTo('App\Models\City', 'city_id')->with('governorate')->withTrashed();
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id')->withTrashed();
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id')->withTrashed();
    }

    public function orders_detailes()
    {
        return $this->hasMany('App\Models\OrderDetailes')->withTrashed();
    }
    public function orders_detailes2()
    {
        return $this->hasMany('App\Models\OrderDetailes')->with('order2','status')->withTrashed();
    }

}
