<?php

namespace App\Models;
use App\Models\ReserveOrder;


use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    protected $table = 'reserves';
    public $timestamps = true;
    protected $guarded = [];


    public function reservesDetailes()
    {
        return $this->hasMany(ReserveOrder::class);
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id')->withTrashed();
    }
}
