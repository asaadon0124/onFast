<?php

namespace App\Models;

use App\Models\OrderReturnStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderReturnStatus extends Model
{
    use SoftDeletes;

    protected $table = 'order_return_statuses';
    public $timestamps = true;
    protected $guarded = [];


    public function status()
    {
        return $this->belongsTo('App\Models\status', 'status_id')->withTrashed();
    }

    public function order_detailes()
    {
        return $this->belongsTo('App\Models\OrderDetailes', 'order_detailes_id')->withTrashed();
    }

    public function returns()
    {
        return $this->belongsTo('App\Models\Returns', 'returns_id')->withTrashed();
    }
}
