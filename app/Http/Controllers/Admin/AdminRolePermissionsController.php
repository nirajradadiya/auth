<?php
namespace App\Http\Controllers\Admin;
use Session, Input, Excel;
use App\Role,App\Permission,App\RolePermission;
use Validator,Hash,Mail;
class AdminRolePermissionsController extends AdminBaseController
{
    /**
     * Retrive the list of permission roles.
     *
     * @return \Illuminate\Http\Response   
     */
    public function getIndex() // Index
    {
        $rolesList = $this->roles_list();
        return view('admin.role-permissions.index', array('title' => 'Role Permissions List','roleslist'=>$rolesList));
    }

    /**
     * Retrive the list of user using ajax.
     *
     * @return \Illuminate\Http\Response   
     */
	public function anyListAjax() {

        $data = Input::all();
        $sortColumn = array('updated_at', 'name','email');
        $query = new Role;
        
        
        if(isset($data['display_name']) && $data['display_name'] != '') {
            $query = $query->where('display_name',$data['display_name']);
        }
        

       

        $rec_per_page = REC_PER_PAGE;
        if(isset($data['length'])){
            if($data['length'] == '-1') {
                $rec_per_page = '';
            } else {
                $rec_per_page = $data['length'];
            }
        }

        $sort_order = $data['order']['0']['dir'];
        $order_field = $sortColumn[$data['order']['0']['column']];
        if($sort_order != '' && $order_field != ''){
            $query = $query->orderBy($order_field,$sort_order);
		} else {
		  $query = $query->orderBy('updated_at','desc');
		}

        $record = $query->paginate($rec_per_page);

        $arrRecord = $record->toArray();
        $data = array();
        $i=0;
        foreach($arrRecord['data'] as $key => $val) {
            $index = 0;
            $data[$i][$index++] = $val['display_name'];
          
            $permissions = RolePermission::where('role_id',$val['id'])->with('permissions')->get()->toArray();

            if(count($permissions))
            {
                $permissionsHtml = "";
                $j=1;
                foreach ($permissions as $key => $permission) 
                {
                    if(isset($permission['permissions']['display_name']))
                    {
                        $permissionsHtml .= $j.') '.$permission['permissions']['display_name'].'<br>';   
                        $j++;
                    }
                }
            }
            else
            {
                $permissionsHtml = "--N/A--";
            }
            $data[$i][$index++] = $permissionsHtml;
            $action = '<a class="btn btn-xs default" rel="'.$val['id'].'" href="'.action('Admin\AdminRolePermissionsController@anyEdit', array('id'=>$val['id'])).'" href="javascript:void(0);"><i class="fa fa-pencil"></i> Manage Permissions </a>';

            $data[$i][$index++] = $action;
            $i+=1;
        }

        $return_data['data'] = $data;
        $return_data['recordsTotal'] = $arrRecord['total'];
        $return_data['recordsFiltered'] = $arrRecord['total'];
        //$return_data['draw'] = $page;
        return $return_data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id var
     * @return \Illuminate\Http\Response
     */
    public function anyEdit($id)
    {
        $record = Role::find($id);
        if(count($record) > 0)
        {
            if(Input::all())
            {
                $data = Input::all();
                if(isset($data['permissions']))
                {
                    if(in_array('0',$data['permissions']))
                    {
                        unset($data['permissions']);
                        $data['permissions'] = UsersRole::pluck('id')->toArray();
                    }   
                    for($i=0;$i<count($data['permissions']);$i++)
                    {
                        $userspermissions[$i]['role_id'] = $record->id;
                        $userspermissions[$i]['permission_id'] =  $data['permissions'][$i];
                    }
                    RolePermission::where('role_id',$record->id)->delete();
                    mass_assignment_insert('App\RolePermission',$userspermissions);
                }
                else
                {
                    RolePermission::where('role_id',$record->id)->delete();
                }
                Session::flash('success_message',EDIT_ROLE_PERMISSIONS);
                return 'TRUE';
            } 
            else 
            {
                $permissionList = Permission::all();
                $rolepermissionsList = RolePermission::where('role_id',$record->id)->pluck('permission_id');
                return view('admin.role-permissions.edit',array('title' => 'Edit Admin User Roles', 'record'=> $record,'permissionlist'=>$permissionList,'rolepermissionslist'=>$rolepermissionsList->toArray()));
            }
        } else {
            return redirect()->action('Admin\AdminRolePermissionsController@getIndex');
        }
    }

    /**
     * Retrive the list of roles.
     *
     * @return \Illuminate\Http\Response   
     */
    public static function roles_list()
    {
        $roleslist = Role::orderBy('id','DESC')->pluck('display_name','id');
        return $roleslist;
    }

}
?>
