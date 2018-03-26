<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use Auth;

class HomeController extends Controller 
{
    public function __construct(Request $request) {
        //check login
        if(!Auth::check()){
            return redirect('/login.html');
        }
    }
    /*
     * function home
     */

    public function default_dasboard(Request $request)
    {
        set_time_limit(0);
      
        $randomImage = Dashboard::getRandomGiftImage();
        if($randomImage['status']){
            $data['gif_image_url'] = $randomImage['url'];
            $data['image_height'] = $randomImage['height'];
            $data['image_width'] = $randomImage['width'];
        }else{
            $data['gif_image_url'] = "";
            $data['image_height'] = 0;
            $data['image_width'] = 0;
        }
        
        //menu - check menu - check permission
        $data['Menu'] = "mn-dashboard";
        $data['Sub'] = "";
        return view('default_dashboard')->with('data', $data);
    }

}
