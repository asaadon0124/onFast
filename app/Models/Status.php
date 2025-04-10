<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;

    protected $table = 'status';
    public $timestamps = true;
    protected $fillable = array('name');

    public function projects()
    {
        return $this->hasMany('App\Models\Product')->withTrashed();
    }
    public function orders()
    {
        return $this->hasMany('App\Models\Order')->withTrashed();
    }
    public function orderStatusReturns()
    {
        return $this->hasMany('App\Models\order_return_statuses')->withTrashed();
    }
    
    public function orderDetailes()
    {
        return $this->hasMany('App\Models\order_detailes')->withTrashed();
    }

}
