<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Permission;
use App\Models\RolePermission;

class PermissionFeature extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'permission_id',
        'name',
        'key',
        'description'
    ];

    function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }

    function rolePermission()
    {
        return $this->hasMany(RolePermission::class, 'permission_feature_id', 'id');
    }
}
