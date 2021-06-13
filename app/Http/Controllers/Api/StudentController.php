<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;


use DB;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //Query Builder
        $student = DB::table('students')->get();
        // Elquoent ORM
        //$student = Student::all();
        return response()->json($student);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array();
        $data['class_id']= $request->class_id;
        $data['section_id']= $request->section_id;
        $data['name']= $request->name;
        $data['phone']= $request->phone;
        $data['email']= $request->email;
        $data['password']= Hash::make($request->password);
        $data['photo']= $request->photo;
        $data['address']= $request->address;
        $data['gender']= $request->gender;
        DB::table('students')->insert($data);
        return response('Student Information Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        //$student = DB::table('students')->where('id',$id)->first();
        $student = Student::findorFail($id);
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        {
            $data = array();
            $data['class_id']= $request->class_id;
            $data['section_id']= $request->section_id;
            $data['name']= $request->name;
            $data['phone']= $request->phone;
            $data['email']= $request->email;
            $data['password']= Hash::make($request->password);
            $data['photo']= $request->photo;
            $data['address']= $request->address;
            $data['gender']= $request->gender;
            DB::table('students')->where('id',$id)->update($data);
            return response('Student Information Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img = DB::table('students')->where('id', $id)->first(); //Get the first Data 
        $image_path = $img->photo; //Get only the image Data
        unlink(public_path($image_path));    //Image Deleted from folder
        DB::table('students')->where('id',$id)->delete();   //Delete From Databaes
        return response('Sudent Information Deleted Successfully'); 
    }
}
