<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courses = Course::all(); 
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

    /***
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //
            $message=[
            'required' => 'This field is required!'
             ];
                          
            $request->validate([      
            'course_name'=>'required',
            'year_level'=>'required',
            'section'=>'required',
            ],$message);
                          
            Course::create([
            'course_name' => $request->course_name, 
            'year_level'  => Str::upper($request->year_level),
            'section' => $request->section,
            ]);
            return redirect()->route('course.index')->with('success', 'Course Registered Successfully');    

    }

    public function view($id)
    {
        $data = Course::find($id);
        
        if (!$data) {
            return redirect()->route('courses.index')->with('error', 'Courses not found');
        }
    
        $students = Student::where('course_id', $id)->get();
        
        return view('course.view', ['courses' => $data, 'students' => $students]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data=Course::find($id);
        return view ('course.edit',['courses'=>$data]);   
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
                    'course_name'=>'required',
                    'year_level'=>'required',
                    'section'=>'required',
        
                ],$message);
                $course=Course::find($request->id);
                $course->course_name=$request->course_name;
                $course->year_level=$request->year_level;
                $course->section=$request->section;        
                $course->save();
                return redirect()->route('course.index')
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
