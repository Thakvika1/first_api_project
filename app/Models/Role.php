<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RolePermission;

class Role extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function rolePermissions()
    {
        return $this->hasMany(RolePermission::class, 'role_id', 'id');
    }
}
