<?php 
define('VERSION','?ver=v.1.0.1');
define('JS_VERSION','?ver=v.1.0.1');
define('CSS_VERSION','?ver=v.1.0.1');
$SITE_URL = $app->make('url')->to('/')."/";
define('WWW_ROOT',$_SERVER['DOCUMENT_ROOT'].'/auth/');
define('SITE_NAME','Laravel Authentication With Roles');
define('SITE_URL',$SITE_URL);
define('ASSET_URL',$SITE_URL.'assets/');
define("DOMPDF_ENABLE_REMOTE", false);
define("GOOGLE_MAP_URL","http://maps.google.com/maps?=");

define('ADMIN_NAME','admin');
define('ADMIN_PATH',ADMIN_NAME);
define('ADMIN_URL_NEW',$SITE_URL.ADMIN_NAME);
define('ADMIN_URL',$SITE_URL.ADMIN_NAME."/");
define('ADMIN_ASSET_URL',$SITE_URL."assets/");
define('SITE_PLUGIN_URL',$SITE_URL."public/plugins/");
define('DOC_ROOT' , $_SERVER['DOCUMENT_ROOT']);

define('FROM_EMAIL_ADDRESS','testing2php@gmail.com');
define('FROM_EMAIL_ADDRESS_NAME','Test Admin');
define('JS_CSS_VER','1.0.0');


//THIRD PARTY API URL:

define('OAUTH2_CLIENT_ID','11');
define('OAUTH2_CLIENT_SECRET','7MZeB9lH9iN9mB8eKCU7NCmMFMFFZTqHJpfrhDVK');
define('APP_NAME','TEST');
//define("REDIRECT_URL",$SITE_URL."frontpages/auth-call-back-url");
define("REDIRECT_URL",'http://localhost:9090/auth');
define('AUTHORIZE_URL','https://authdev.peoplefone.com/oauth/authorize');
define('TOKEN_URL','https://authdev.peoplefone.com/oauth/token');

define('EMAIL_FROM',FROM_EMAIL_ADDRESS);
define('EMAIL_PASSWORD','this.admin');
define('EMAIL_PORT','25');
define('EMAIL_SERVER','smtp.gmail.com');
define('EMAIL_SSL','ssl');

define('FILE_PATH','files/');
define('TEMP_PDF_PATH','files/temp-pdf/');
define('TEMP_SIGN_IMG_PATH','files/temp-sign-img/');
define('FILE_UPLOAD_URL',$_SERVER['DOCUMENT_ROOT'] . '/testing_demo/files/');


/*Admin side constants*/
define('MAX_UPLOAD_SIZE','4');
define('PROFILE_PATH','files/profile/');
define('INVALID_IMAGE_EXTENSION','You must select an image file only.');
define('INVALID_IMAGE_SIZE','Please upload a smaller image, maximum size is '.MAX_UPLOAD_SIZE.' MB');
define('REC_PER_PAGE', 10);
define('TEMP_IMG_PATH', 'files/'); // all the image will be uploaded in this folder path
define('TEMP_IMAGE_THUMB_PATH', 'files/thumb/'); // all the thumb image will be uploaded in this folder path
define('ADMIN_PROFILE_PATH','files/admin_profile/');
define('ADMIN_PROFILE_THUMB_PATH','files/admin_profile/thumb/');
define('USER_PROFILE_PATH','files/user_profile/');
define('USER_PROFILE_THUMB_PATH','files/user_profile/thumb/');




define("ERR_PWS", "Email ID and password do not match.");
define("ERR_INACTIVE", "Your account is inactive by admin.");
define("ERR_VERIFIED", "Your Email Id is not verified yet.");
define("LOG_SUCCESS","You have successfully logged out.");
define("INVALID_EMAIL","Invalid email address.");
define("PW_SENT","Password has been emailed successfully.");
define("PW_RESET_SENT","Check your email to reset your password.");
define("PROFILE_SUCCESS","Profile has been updated successfully.");
define("SETTING_SUCCESS","Setting has been updated successfully.");
define("PW_RESET_SUCCESS","Password has been reset successfully.");
define("PW_RESET_ERROR","Could not recover your password.");
define("ADD_SUCCESS","Record added successfully.");
define("EDIT_SUCCESS","Record updated successfully.");
define("EDIT_USER_ROLES","User roles updated successfully.");
define("EDIT_ROLE_PERMISSIONS","Role permissions updated successfully.");




//All Images/Excel Path
define('THEME_IMG_PATH', 'img/');
define('FILES_PATH','files/');
define('USER_PROFILE_IMG_PATH', 'files/user_parent/profile_images/');
define('EXCEL_STORE_EMAIL_PATH','files/excel/');
define('EXPORT_IMPORT_DATA','files/import_export/');

//set schdule india timezone
define("TIME_ZONE_INDIA",'Asia/Kolkata');
define("TIME_ZONE_UTC",'UTC');


//Defualt Image Constant
define('DEFAULT_USER_IMAGE_NAME','default-avatar.png'); 


//Route File Constants
define('CURRENT_DATE_TIME',date('Y-m-d H:i:s'));
define('CURRENT_DATE_TIME_FORMAT','Y-m-d H:i:s');
define('CURRENT_DATE_FORMAT','Y-m-d');
define('CURRENT_DATE_DISPLAY_FORMAT','d-m-Y');
define('CURRENT_DATE',date('Y-m-d'));
define('CURRENT_DATE_DISPLAY',date('d-m-Y'));
define('SERVICE_EXPIRED_REMANIDER_REMANING_VISIT','2');


 




/*  Email Verification / Reset Password Blade Message List */
define("EMAIL_VERIFY","Email Verification"); 
define("MSG_EMAIL_VERIFY_SUCCESS","Your email Id is verified sucessfully"); 
define("MSG_EMAIL_ALREADY_VERIFY","You have already verified your email address."); 
define("MSG_EMAIL_VERIFY_LINK_INVALID","Invalid verification link."); 


//START COMMON FUNCTION FOR ADMIN
function objectToArray($d) {
  if (is_object($d)) {
    $d = get_object_vars($d);
  }

  if (is_array($d)) {
    return array_map(__FUNCTION__, $d);
  }
  else {
    return $d;
  }
}
function pr($arr) {
    echo "<pre>";
    print_r($arr);
    echo "</pre>";    
}
function get_last_query() {
  $queries = DB::getQueryLog();
  $sql = end($queries);
 

  if( ! empty($sql['bindings']))
  {
    $pdo = DB::getPdo();
    foreach($sql['bindings'] as $binding)
    {
      $sql['query'] =
        preg_replace('/\?/', $pdo->quote($binding),
          $sql['query'], 1);
    }
  }
  return pr($sql['query']);
} 
//custom function for add month in date


//END COMMON FUNCTION FOR ADMIN




function insert($model,$key_value_array) //common funciton for insert record dynamically 
{
  $add_record = new $model;  
  foreach ($key_value_array as $key => $value) 
  {
    $add_record->$key = trim($value);
  }
  if($add_record->save())
  {
   return $add_record; 
  }
}
function mass_assignment_insert($model,$key_value_array) //common funciton for insert multiple record with array dynamically 
{
  $model::insert($key_value_array);  
}
function update_using_id($model,$key_value_array,$id) //common funciton for update record dynamically 
{
  $update_record = $model::find($id);  
  foreach ($key_value_array as $key => $value) 
  {
    $update_record->$key = trim($value);
  }
  return $update_record->save();
}
function update_using_array($key_value_array,$update_array) //common funciton for update record dynamically 
{  
  foreach($key_value_array as $key => $value) 
  {
    $update_array->$key = trim($value);
  }
  return $update_array->save();
}
function delete_using_id($model,$key,$id)
{
  $model::where($key,'=',$id)->delete();  
}
function image_upload($file,$store_path,$image_name,$id) //common funciton for upload image dynamically 
{
  $image_name =  $id.'_'.$image_name.'_'.rand(10000000,99999999).".png"; 
  $file->move($store_path,$image_name);
  return $image_name;
}

function pdf_upload($file,$store_path,$pdf_name,$id) //common funciton for upload pdf dynamically 
{
  $pdf_name =  $id.'_'.$pdf_name.'_'.rand(10000000,99999999).".pdf"; 
  $file->move($store_path,$pdf_name);
  return $pdf_name;
}



function get_file_extension($file_name) {
  return substr(strrchr($file_name,'.'),1);
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return strtoupper($randomString);
}
function is_json($string,$return_data = false) {
       $data = json_decode($string,true);
       return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
}
function is_arary_json($string,$return_data = false) {
       $data = json_decode($string,true);
       echo json_last_error(); exit();
       return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
}
function file_exists_check($path){
  return file_exists($path); 
}
function add_prefix_path($n,$image_path) // function for delete images 
{
    return($image_path.$n);
}
function empty_dir($dir_path)
{
  array_map('unlink',glob($dir_path.'*'));
}
function sortByOrder($a, $b) 
{
    return $a['i_order'] - $b['i_order'];
}
function remove_dir($dir_path)
{
  File::deleteDirectory($dir_path);
}
function array_msort($array, $cols)
{
    $colarr = array();
    foreach ($cols as $col => $order) {
        $colarr[$col] = array();
        foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
    }
    $eval = 'array_multisort(';
    foreach ($cols as $col => $order) {
        $eval .= '$colarr[\''.$col.'\'],'.$order.',';
    }
    $eval = substr($eval,0,-1).');';
    eval($eval);
    $ret = array();
    foreach ($colarr as $col => $arr) {
        foreach ($arr as $k => $v) {
            $k = substr($k,1);
            if (!isset($ret[$k])) $ret[$k] = $array[$k];
            $ret[$k][$col] = $array[$k][$col];
        }
    }
    return $ret;
}

function api_request($tokenURL, $post=FALSE, $headers=array(),$method='')
{

    $client_id = OAUTH2_CLIENT_ID;
    $client_secret = OAUTH2_CLIENT_SECRET;
    $authentication = base64_encode($client_id.":".$client_secret);
    $headers = array('Content-Type'=>'application/json','Authorization' => 'Basic '.$authentication);
    $ch = curl_init($tokenURL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    if($method != 'get')
        curl_setopt($ch, CURLOPT_POSTFIELDS,  http_build_query($post));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $return = curl_exec($ch);
    curl_close($ch);
    return $return;
}


?>