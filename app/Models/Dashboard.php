<?php
namespace App\Models;

class Dashboard 
{
    public static function getRandomGiftImage(){
        $header = array();
        
        $service_url = "http://api.giphy.com/v1/gifs/random?api_key=1csWTpbGGjBD7JdTLeqdFEuGShgI4fVt&tag=pikachu";
        $curl = curl_init($service_url);

        curl_setopt($curl, CURLOPT_HTTPGET, TRUE);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5); //Time out 5s
        $exec = curl_exec($curl);
        //$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (curl_error($curl)) {
            die(curl_error($curl));
        }
        curl_close($curl);
        $decoded = json_decode($exec);
        if(isset($decoded->data) && $decoded->data){
            $data['status'] = true;
            $imageInfo = $decoded->data;
            $data['url'] = $imageInfo->image_original_url;
            $data['width'] = $imageInfo->image_width;
            $data['height'] = $imageInfo->image_height;
            return $data;
        }else{
            $data['status'] = false;
            $data['url'] = "";
            $data['width'] = 0;
            $data['height'] = 0;
            return $data;
        }
    }
}