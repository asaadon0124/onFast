<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Servant extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'servants';
    public $timestamps = true;
    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany('App\Models\Order')->withTrashed();
    }

   

}

