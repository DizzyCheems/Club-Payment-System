<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $course = Course::all(); 
        return view('course.list', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view ('course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //
            $message=[
            'required' => 'This field is required!'
             ];
                          
            $request->validate([      
            'name'=>'required',
            'year_level'=>'required',
            'section'=>'required',
            ],$message);
                          
            Course::create([
            'name' => $request->name, 
            'year_level' => $request->year_level,
            'section' => $request->section,
            ]);
            return redirect()->route('course.list')->with('success', 'Course Registered Successfully');    

   
    }

    /**
     * Display the specified resource.
     */
    public function view($id)
    {
        //
        $data=Course::find($id);
        return view ('course.view',['course'=>$data]);   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data=Course::find($id);
        return view ('course.edit',['course'=>$data]);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
                $message=[
                    'required' => 'This credential field is required!'
                ]; 
                $request->validate([
                    'name'=>'required',
                    'year_level'=>'required',
                    'section'=>'required',
        
                ],$message);
                $course=Course::find($request->id);
                $course->name=$request->name;
                $course->year_level=$request->year_level;
                $course->section=$request->section;        
                $course->save();
                return redirect()->route('course.list')
                ->with('success', 'Course, Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request) 
    {
       $id = $request->id;
       $emp = Course::find($id);
       Course::destroy($id);
   }
}
