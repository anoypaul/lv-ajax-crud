<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\imaget;

class image_c extends Controller
{
    public function index_image(){
        return view('image_v');
    }
    public function store(Request $request){
        echo '<pre>';
        print_r($request);
        exit;
    }
    public function image_show(){
        return view('image_s');
    }
}
