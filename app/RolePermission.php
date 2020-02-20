<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class RolePermission extends Model
{
    protected $table = 'permission_role';    
    public function permissions()
    {
        return $this->hasOne('App\Permission','id','permission_id');
    }
}
