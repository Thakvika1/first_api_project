<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Permission;
use App\Models\PermissionFeature;

class RolePermission extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'role_id',
        'permission_id',
        'permission_feature_id'
    ];

    function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }

    // function permissionFeature()
    // {
    //     return $this->belongsTo(PermissionFeature::class, 'permission_feature_id', 'id');
    // }
    // function role()
    // {
    //     return $this->belongsTo(Role::class, 'role_id', 'id');
    // }
}
