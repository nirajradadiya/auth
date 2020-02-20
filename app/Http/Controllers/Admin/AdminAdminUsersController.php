<?php
namespace App\Http\Controllers\Admin;
use Session, Input, Excel;
use App\User,App\Role,App\UsersRole;
use Validator,Hash,Mail;
class AdminAdminUsersController extends AdminBaseController
{
    /**
     * Retrive the list of admin user.
     *
     * @return \Illuminate\Http\Response   
     */
    public function getIndex()
    {
        $usersList = $this->admin_user_list();
        return view('admin.admin-users.index', array('title' => 'Admin Users List','userslist'=>$usersList));
    }

    /**
     * Retrive the list of user using ajax.
     *
     * @return \Illuminate\Http\Response   
     */
	public function anyListAjax() {

        $data = Input::all();
        $sortColumn = array('updated_at', 'name','email');
        $query = new User;
        if(isset($data['name']) && $data['name'] != '') {
            $query = $query->where('name', 'LIKE',"%".$data['name']."%");
        }
        
        if(isset($data['email']) && $data['email'] != '') {
            $query = $query->where('email',$data['email']);
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
            $data[$i][$index++] = $val['name'];
            $data[$i][$index++] = $val['email'];
            $roles = UsersRole::where('user_id',$val['id'])->with('roles')->get()->toArray();

            if(count($roles))
            {
                $rolesHtml = "";
                $j=1;
                foreach ($roles as $key => $roles) 
                {
                    if(isset($roles['roles']['display_name']))
                    {
                        $rolesHtml .= $j.') '.$roles['roles']['display_name'].'<br>';   
                        $j++;
                    }
                }
            }
            else
            {
                $rolesHtml = "--N/A--";
            }
            $data[$i][$index++] = $rolesHtml;
            $action = '<a class="btn btn-xs default" rel="'.$val['id'].'" href="'.action('Admin\AdminAdminUsersController@anyEdit', array('id'=>$val['id'])).'" href="javascript:void(0);"><i class="fa fa-pencil"></i> Manage Roles </a>';

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
        $record = User::find($id);
        if(count($record) > 0)
        {
            if(Input::all())
            {
                $data = Input::all();
                if(isset($data['roles']))
                {
                    if(in_array('0',$data['roles']))
                    {
                        unset($data['roles']);
                        $data['roles'] = UsersRole::pluck('id')->toArray();
                    }   
                    for($i=0;$i<count($data['roles']);$i++)
                    {
                        $usersroles[$i]['user_id'] = $record->id;
                        $usersroles[$i]['role_id'] =  $data['roles'][$i];   
                    }
                    UsersRole::where('user_id',$record->id)->delete();
                    mass_assignment_insert('App\UsersRole',$usersroles);
                }
                else
                {
                    UsersRole::where('user_id',$record->id)->delete();   
                }
                Session::flash('success_message',EDIT_USER_ROLES);
                return 'TRUE';
            } else {
                $roleList = Role::all();
                $userroleList = UsersRole::where('user_id',$record->id)->pluck('role_id');
                return view('admin.admin-users.edit',array('title' => 'Edit Admin User Roles', 'record'=> $record,'rolelist'=>$roleList,'userrolelist'=>$userroleList->toArray()));
            }
        } else {
            return redirect()->action('Admin\AdminAdminUsersController@getIndex');
        }
    }

    /**
     * Retrive the list of admin user.
     *
     * @return \Illuminate\Http\Response   
     */
    public static function admin_user_list()
    {
        $userslist = User::orderBy('id','DESC')->pluck('name','id');
        return $userslist;
    }

}
?>
