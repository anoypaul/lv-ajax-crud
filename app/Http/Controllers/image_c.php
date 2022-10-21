<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\imaget;
use App\Models\Aj_crud_m\Teachers_m;
use Facade\FlareClient\Http\Response;

class image_c extends Controller
{
    // public function index_image(){
    //     return view('image_v');
    // }
    // public function store(Request $request){
    //     echo '<pre>';
    //     print_r($request);
    //     exit;
    // }
    // public function image_show(){
    //     return view('image_s');
    // }

    // public function Api($name = null){
    //     // return ["car1"=> "BMW", "car2" => "volvo"];
    //     $teacher_data = $name ? Teachers_m::where('teachers_name', $name)->get() : Teachers_m::all();
    //     return $teacher_data;
    // }
    // public function ApiStore(Request $request){
    //     $teacher = new Teachers_m();
    //     $teacher->teachers_name = $request->teachers_name;
    //     $teacher->teachers_title = $request->teachers_title;
    //     $teacher->teachers_institute = $request->teachers_institute;
    //     $teacher->save();

    //     if($teacher){
    //         return ["success"=>"Data Added Successfully"];
    //     }
    //     else{
    //         return ["success"=>"Data Not Added"];
    //     }
    // }

    public function index(){
        return view('aj_crud_v.test_aj');
    }
    public function allData(){
        $data = Teachers_m::orderBy('teachers_id', 'DESC')->get();
        return response()->json($data);
    }
    public function createData(Request $request){
        $data = new Teachers_m();
        $request->validate([
            'teachers_name' => 'required',
            'teachers_title' => 'required',
            'teachers_institute' => 'required'
        ]);
        $data->teachers_name = $request->teachers_name;
        $data->teachers_title = $request->teachers_title;
        $data->teachers_institute = $request->teachers_institute;
        $data->save();
        return response()->json($data);
    }

    public function findData($id){
        $data = Teachers_m::find($id);
        return response()->json($data);
    }

    public function updateData(Request $request, $id){
        $data = Teachers_m::find($id);
        $request->validate([
            'teachers_name' => 'required',
            'teachers_title' => 'required',
            'teachers_institute' => 'required'
        ]);
        $data->teachers_name = $request->teachers_name;
        $data->teachers_title = $request->teachers_title;
        $data->teachers_institute = $request->teachers_institute;
        $data->save();
        return response()->json($data);
    }

    public function deleteDate($teachers_id){
        $teachers_m = Teachers_m::where("teachers_id", $teachers_id);
        if(!is_null($teachers_m)){
            $teachers_m->delete();
        }
        return response()->json($teachers_m);
    }
}
