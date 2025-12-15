<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RolePermission;
use App\Models\PermissionFeature;

class Permission extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name',
        'key',
        'description'
    ];

    function permissionFeatures()
    {
        return $this->hasMany(PermissionFeature::class, 'permission_id', 'id');
    }
}
