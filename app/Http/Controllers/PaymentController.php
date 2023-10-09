<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Payment;
use App\Models\Agenda;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $payments = Payment::with('agendas', 'students' )->get();
        return view('payment.list', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $courses = Course::all();
        $agendas = Agenda::all();
        $students = Student::all();
        return view('payment.create', compact('courses', 'agendas', 'students'));
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
            'agenda_id',
            'student_id', 
            'amount'=>'required',
            'type'=>'required',
            'method'=>'required',
            ],$message);
                          
            Student::create([
            'amount' => $request->amount, 
            'type' => Str::upper($request->type),
            'method' => Str::upper($request->method),
            ]);
            return redirect()->route('payment.index')->with('success', 'Payment Registered Successfully');    

    }


    /**
     * Display the specified resource.
     */
    public function view($id)
    {
        //
        $data=Student::find($id);
        return view ('payment.view',['students'=>$data]);   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data=Payment::find($id);
        return view ('payment.edit',['payments'=>$data]);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $student)
    {
        //
        $message=[
            'required' => 'This credential field is required!'
        ]; 
        $request->validate([
            'agenda_id',
            'student_id', 
            'amount'=>'required',
            'type'=>'required',
            'method'=>'required',

        ],$message);
        $student=Payment::find($request->id);
        $student->amount=$request->amount;
        $student->type=Str::upper($request->type);
        $student->method=Str::upper($request->method);            
        $student->save();
        return redirect()->route('payment.index')
        ->with('success', 'Payment, Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request) 
    {
       $id = $request->id;
       $emp = Payment::find($id);
       Payment::destroy($id);
   }
}
