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
    public function index(Request $request)
    {
        $payments = Payment::with('agendas', 'students')->paginate(10); // Change '10' to the desired number of items per page
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
        $selectedAgenda = $agendas->first(); // You can adjust this to fetch the desired agenda
        $indivContrib = $selectedAgenda ? $selectedAgenda->indiv_contrib : null;
        return view('payment.create', compact('courses', 'agendas', 'students', 'indivContrib'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = [
            'required' => 'This field is required!',
        ];
    
        $request->validate([
            'agenda_id' => 'required',
            'student_id' => 'required',
            'amount' => 'required',
            'type' => 'required',
            'method' => 'required',
        ], $message);
    
        Payment::create([
            'student_id' => $request->student_id,
            'agenda_id' => $request->agenda_id,
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
        $courses = Course::all();
        $agendas = Agenda::all();
        $students = Student::all();
        $payments=Payment::find($id);
        return view('payment.view', compact('courses', 'agendas', 'students', 'payments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $courses = Course::all();
        $agendas = Agenda::all();
        $students = Student::all();
        $payments=Payment::find($id);
        return view('payment.edit', compact('courses', 'agendas', 'students', 'payments'));
   
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
