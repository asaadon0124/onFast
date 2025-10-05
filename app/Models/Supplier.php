<?php

namespace App\Models;

use App\Models\OrderDetailes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $table = "suppliers";

    protected $guarded = [];

    public $timestamps = true;


    // RELATIONS

    // ONE TO MANY WITH PRODUCTS
    public function products()
    {
        return $this->hasMany('App\Models\Product')->withTrashed();
    }

    public function products_supplier()
    {
        return $this->hasMany('App\Models\Product', 'supplier_id')->with(['orders_detailes2' => function($query)
        {
            $query->orderBy('created_at', 'desc');
        }]);
    }

    // ONE TO MANY WITH CITIES
    public function cities()
    {
        return $this->belongsTo('App\Models\City', 'city_id')->withTrashed();
    }

    // ONE TO MANY WITH PRODUCTS
    public function returns()
    {
        return $this->hasMany('App\Models\Returns')->withTrashed();
    }






    public function orderDetailes()
    {
        return $this->hasManyThrough(
            OrderDetailes::class,               // الموديل الهدف
            Product::class,                     // الموديل الوسيط
            'supplier_id',                      // المفتاح الأجنبي في products
            'product_id',                       // المفتاح الأجنبي في order_detailes
            'id',                               // المفتاح المحلي في suppliers
            'id'                                // المفتاح المحلي في products
        )->withTrashed();
    }
}
