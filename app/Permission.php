<?php

namespace App;

use App\Role;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];
    protected $table = "permissions";

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
