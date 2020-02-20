<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admin;
use Auth, Hash, Input, Session, Redirect, Str, Validator, Mail;
class AdminAuthenticateController extends Controller
{
    /**
     * Check admin login or not
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        $admin_login = auth()->guard('admin')->check(); 
        
        if($admin_login){
            return redirect()->action('Admin\AdminAuthenticateController@dashboard');
        } else {
            return view('admin.authentication.login', array('title' => 'Admin Login'));     
        }
        
    }
    
    /**
     * Login action for admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin()
    {
        $requestData = Input::all();
        if(!empty($requestData) && count($requestData) > 0)
        {
            $strRemember = (Input::has('remember') ? true : false); // getting value of remember me
            $auth = auth()->guard('admin');
            $objAuth = $auth->attempt(array( 
                    'v_email' => e(trim(Input::get('username'))),
                    'password' => e(trim(Input::get('password'))),
            ),$strRemember);
            
            if($objAuth)
            {
                if(Auth::guard('admin')->user()->e_status == 'Active')
                {
                     Admin::where('id','=',Auth::guard('admin')->user()->id)->update(array('d_last_login_date'=>CURRENT_DATE_TIME));
                    return redirect()->action('Admin\AdminAuthenticateController@dashboard'); 
                }
                else
                {
                     auth()->guard('admin')->logout();
                     Session::flash('message', ERR_INACTIVE);
                     return redirect()->action('Admin\AdminAuthenticateController@getLogin');
                }
            } else {
                Session::flash('message', ERR_PWS);
                return redirect()->action('Admin\AdminAuthenticateController@getLogin');
            }
        } else {
            return 0;
        }
    }
    
    /**
     * Retrive the view of dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $auth = auth()->guard('admin');
        $total = [];
        if($auth->check())
        {
            $user = $auth->user();
            return view('admin.authentication.dashboard', array('title' => 'Dashboard','currentUser'=>$user,'pageHead'=> 'Dashboard','total'=> $total)); 
        } else {
            return redirect()->action('Admin\AdminAuthenticateController@getLogin');
        }
    }
    
    /**
     * Retrive the view of admin profile
     *
     * @return \Illuminate\Http\Response
     */
    public function my_profile()
    {
        $user = '';
        $auth = auth()->guard('admin');
        if($auth->check())
        {
            $user = $auth->user();
        }
        $data = Input::all();
        if(!empty($data) && count($data) > 0)
        {
            $objValidator = Validator::make($data, array(  //method for server side validation 
                'v_email'  => 'unique:administrator,v_email,'.$user->id
            ),array(
                'unique' => 'Email address already exits.'
            ));
            if($objValidator->fails())
            {
                return $objValidator->errors();
            }
            $record = Admin::find($auth->user()->id);
            
            if(isset($data['imgbase64']) && $data['imgbase64'] != '') {
                $profileImgPath = ADMIN_PROFILE_PATH;
                $profileImgThumbPath = ADMIN_PROFILE_THUMB_PATH;
                $imageName = $this->cropImages($data['imgbase64'],$data['x'],$data['y'],$data['h'],$data['w'],$profileImgPath,$profileImgThumbPath);
                @unlink(ADMIN_PROFILE_PATH.$record->v_img);
                @unlink(ADMIN_PROFILE_THUMB_PATH.$record->v_img);
                
                $record->v_image = $imageName;
            }
            if(isset($data['v_password']) && $data['v_password'] != '')
            {
                if(Hash::check($data['v_password'], $record->password))
                {
                    $duplicateError = array();
                    $duplicateError['password'] = 'New password must be diffrent from your current password.'; 
                    return $duplicateError;
                }
                $record->password = Hash::make($data['v_password']);
            }
            $record->v_name = $data['v_name'];
            $record->v_email = $data['v_email'];
            $record->updated_at = date('Y-m-d H:i:s');        
            $record->save();
            Session::flash('success_message', PROFILE_SUCCESS);
            return 'TRUE';
        } else {
            return view('admin.authentication.my_profile', array('title' => 'My Profile', 'pageHead'=>'My Profile', 'currentUser'=>$user));
        }
    }
    
    /**
     * Retrive the logout action
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->guard('admin')->logout();
        Session::flash('success_message', "You have successfully logout.");
        return redirect()->action('Admin\AdminAuthenticateController@getLogin');
    }
}
