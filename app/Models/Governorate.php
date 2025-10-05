<?php

namespace App\Models;






use App\Traits\Admin\ClearsSidebarCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Governorate extends Model
{

    use SoftDeletes,ClearsSidebarCache;
    protected $table = 'governorates';
    public $timestamps = true;
    protected $fillable = array('name');

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }



    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}
