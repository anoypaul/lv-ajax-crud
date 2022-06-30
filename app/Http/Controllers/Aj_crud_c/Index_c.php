<?php

namespace App\Http\Controllers\Aj_crud_c;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aj_crud_m\Teachers_m;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class Index_c extends Controller
{
    public function index(){
        return view('aj_crud_v.index_v');
    }

    public function allData(){
        $data = Teachers_m::orderBy('teachers_id', 'DESC')->get();
        return response()->json($data);
    }

    public function createData(Request $request){
        $request->validate([
            'teachers_name' => 'required',
            'teachers_title' => 'required',
            'teachers_institute' => 'required'
        ]);

        $teachers_m =Teachers_m::insert([
            'teachers_name' => $request->teachers_name,
            'teachers_title' => $request->teachers_title,
            'teachers_institute' => $request->teachers_institute,
        ]);
        
        return response()->json($teachers_m);

    }

    public function findData($teachers_id){
       $data = Teachers_m::find($teachers_id);
       return response()->json($data);
    }

    public function updateData(Request $request, $teachers_id){
        $request->validate([
            'teachers_name' => 'required',
            'teachers_title' => 'required',
            'teachers_institute' => 'required'
        ]);

        $teachers_m =Teachers_m::findOrFail($teachers_id)->update([
            'teachers_name' => $request->teachers_name,
            'teachers_title' => $request->teachers_title,
            'teachers_institute' => $request->teachers_institute,
        ]);
        
        return response()->json($teachers_m);
    }

    public function deleteData($teachers_id){
       $teachers_m = Teachers_m::where("teachers_id", $teachers_id);
        if(!is_null($teachers_m)){
            $teachers_m->delete();
        }
        return response()->json($teachers_m);
    }
}
