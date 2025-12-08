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
        $this->belongsTo(Permission::class, 'permission_id', 'id');
    }

    function permissionFeature()
    {
        $this->belongsTo(PermissionFeature::class, 'permission_feature_id', 'id');
    }
}
