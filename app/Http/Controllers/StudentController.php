<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $students = Student::with('courses')->get();
        return view('student.list', compact('students'));
    }

    public function loadadmin()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }
    

    public function addstudent_auth(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'SUPER ADMIN') {
            return redirect()->route('student.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $courses = Course::all();
        return view ('student.create',['courses'=>$courses]);
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
            'course_id' => 'required', 
            'name'=>'required',
            'id_num'=>'required',
            'social_acc'=>'required',
            'payment_acc'=>'required',
            ],$message);
                          
            Student::create([
            'course_id' => $request->course_id,
            'name' => $request->name, 
            'id_num' => $request->id_num,
            'social_acc' => $request->social_acc,
            'payment_acc' => $request->payment_acc,
            ]);
            return redirect()->route('student.index')->with('success', 'Student Registered Successfully');    

    }

    /**
     * Display the specified resource.
     */
    public function view($id)
    {
        $data = Student::find($id);
        
        if (!$data) {
            return redirect()->route('student.index')->with('error', 'Student not found');
        }
    
        $payments = Payment::where('student_id', $id)->get();
        
        return view('student.view', ['students' => $data, 'payments' => $payments]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data=Student::find($id);
        return view ('student.edit',['students'=>$data]);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
        $message=[
            'required' => 'This credential field is required!'
        ]; 
        $request->validate([
            'name'=>'required',
            'id_num'=>'required',
            'social_acc'=>'required',
            'payment_acc'=>'required',

        ],$message);
        $student=Student::find($request->id);
        $student->name=$request->name;
        $student->id_num=$request->id_num;
        $student->social_acc=$request->social_acc;
        $student->payment_acc=$request->payment_acc;                
        $student->save();
        return redirect()->route('student.index')
        ->with('success', 'Student, Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request) 
    {
       $id = $request->id;
       $emp = Student::find($id);
       Student::destroy($id);
   }
}
