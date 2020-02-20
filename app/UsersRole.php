<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class UsersRole extends Model
{
    protected $table = 'role_user';    
    public function roles()
    {
        return $this->hasOne('App\Role','id','role_id');
    }
}
