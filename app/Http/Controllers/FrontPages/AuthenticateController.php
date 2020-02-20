<?php
namespace App\Http\Controllers\FrontPages;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth, Hash, Input, Session, Redirect, Str, Validator, Mail;
class AuthenticateController extends Controller
{
    /**
     * Retrive the authorise url for user login.
     *
     * @return \Illuminate\Http\Response   
     */
    public function getLogin()
    {
        // Generate a random hash and store in the session for security
        $state = hash('sha256', microtime(TRUE).rand().$_SERVER['REMOTE_ADDR']);
        $params = array
        (
            'client_id' => OAUTH2_CLIENT_ID,
            'redirect_uri' => REDIRECT_URL,    
            'name' => 'Niraj',
            'locale' => 'en_CH',    
            'state' => $state,
            'grant_type' => 'authorization_code',
            'response_type' => 'code',    
        );
        return redirect(AUTHORIZE_URL.'?'.http_build_query($params));
    }

    /**
     * Retrive the token after authorization.
     *
     * @return \Illuminate\Http\Response   
     */
    public function getCallBackLogin()
    {
        $inputData = Input::all();
        if(isset($inputData['code']))
        {
            // Exchange the auth code for a token
            $token = api_request(TOKEN_URL, array
            (
                'client_id' => OAUTH2_CLIENT_ID,
                'client_secret' => OAUTH2_CLIENT_SECRET,
                'redirect_uri' => REDIRECT_URL,        
                'grant_type' => 'authorization_code',
                'code' => $inputData['code'],
                'scope' => 'user'
            ));
            $token_ary = json_decode($token,true);
            if(isset($token_ary['access_token']))
            {
                $tokenParts = explode('.', $token_ary['access_token']);
                $header = base64_decode($tokenParts[0]);
                $payload = base64_decode($tokenParts[1]);
                $signatureProvided = $tokenParts[2];

                if(count(json_decode($payload,true)))
                {
                    $payLoadAry = json_decode($payload,true);
                    if(isset($payLoadAry['email']))
                    {
                        $user = User::where('email',$payLoadAry['email'])->first();
                        if(!empty($user))
                        {
                            if(isset($payLoadAry['sub']))
                            {
                                $user->unique_user_id = $payLoadAry['sub'];
                                $user->save();
                            }
                            auth()->guard('web')->logout();
                            Auth::guard('web')->login($user);
                            return redirect()->route('userdetail');
                        }
                    }
                }
            }
            
        }
        return redirect()->route('login');
    }

    /**
     * Retrive the detail of looged user.
     *
     * @return \Illuminate\Http\Response   
     */
    public function loginUserDetail()
    {
        echo "User Name:<b>".auth()->guard('web')->user()->name.'</b> , '."Email Address:<b>".auth()->guard('web')->user()->email.'</b><br><a href="'.route('logout').'">For Logout Click Here</a>';
    }

    /**
     * Retrive the logout auth user.
     *
     * @return \Illuminate\Http\Response   
     */
    public function postLogout()
    {
        auth()->guard('web')->logout();
        echo "User Logout Successfully";   
        return redirect()->route('login');
    }
}
