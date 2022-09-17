<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\imaget;
use App\Models\Aj_crud_m\Teachers_m;

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

    public function Api($name = null){
        // return ["car1"=> "BMW", "car2" => "volvo"];
        $teacher_data = $name ? Teachers_m::where('teachers_name', $name)->get() : Teachers_m::all();
        return $teacher_data;
    }
    public function ApiStore(Request $request){
        $teacher = new Teachers_m();
        $teacher->teachers_name = $request->teachers_name;
        $teacher->teachers_title = $request->teachers_title;
        $teacher->teachers_institute = $request->teachers_institute;
        $teacher->save();

        if($teacher){
            return ["success"=>"Data Added Successfully"];
        }
        else{
            return ["success"=>"Data Not Added"];
        }
    }
}
