<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\AppSettings;

class AdminBaseController extends Controller
{

    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function global_add_data($modelName, $dataArr)
    {
        $model = "App\\Models\\".$modelName;
        $record = new $model;
        foreach($dataArr as $key => $val){
            $record->$key = $val;
        }
        $record->save();
    }
    
    /**
     * Crop image.
     *
     * @param  string $base64img var
     * @param  integer $x var
     * @param  integer $y var
     * @param  integer $w var
     * @param  integer $h var
     * @param  string $path var
     * @param  string $thumb_path var
     * @return \Illuminate\Http\Response   
     */
    public function cropImages($base64img,$x,$y,$w,$h,$path,$thumb_path )
    {
        $v_random_image = time().'-'.str_random(6);
        
        $base64img = substr(strstr($base64img,','), 1);
        
        $tmpFile = $v_random_image.'.png';
        $targ_w = $targ_h = 150;
        $jpeg_quality = 90;
        $img_src = base64_decode($base64img);
        $file = $path.$tmpFile;
        file_put_contents($file, $img_src);
        
        $img_r = imagecreatefromstring($img_src);
        $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
        imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $w, $h);
    	header('Content-type: image/jpeg');
        ob_start(); 
        imagejpeg($dst_r,null,$jpeg_quality);
        $image_data = ob_get_contents(); 
        ob_end_clean(); 
        $fileThumb = $thumb_path.$tmpFile;
        
        file_put_contents($fileThumb, $image_data);
        
        return $tmpFile;
     }
     
     /**
     * Store a newly created resource in storage
     *
     * @param  string $base64img var
     * @param  string $path var
     * @return \Illuminate\Http\Response   
     */
     public function saveImage($base64img,$path) {
        $v_random_image = time().'-'.str_random(6);
        if (strpos($base64img,'data:image/jpeg;base64,') !== false) {
            $base64img = str_replace('data:image/jpeg;base64,', '', $base64img);
            //$tmpFile = $v_random_image.'.jpeg';
        }
        if (strpos($base64img,'data:image/png;base64,') !== false) {
            $base64img = str_replace('data:image/png;base64,', '', $base64img);
            //$tmpFile = $v_random_image.'.png';
        }
        if (strpos($base64img,'data:image/webp;base64,') !== false) {

            $base64img = str_replace('data:image/webp;base64,', '', $base64img);
            //$tmpFile = $v_random_image.'.png';
        }

        if (strpos($base64img,'data:image/jpg;base64,') !== false) {
            $base64img = str_replace('data:image/jpg;base64,', '', $base64img);
            //$tmpFile = $v_random_image.'.jpg';
        }
        if (strpos($base64img,'data:image/gif;base64,') !== false) {
            $base64img = str_replace('data:image/gif;base64,', '', $base64img);
            //$tmpFile = $v_random_image.'.gif';
        }
        $tmpFile = $v_random_image.'.png';
        $data = base64_decode($base64img);
        $file = $path.$tmpFile;
        file_put_contents($file, $data);
        return $tmpFile;
    }
    
}