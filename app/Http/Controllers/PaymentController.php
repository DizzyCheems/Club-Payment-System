<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Payment;
use App\Models\Pay;
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
        $courses = Course::all();   
        $agendas = Agenda::all();
        $students = Student::all();
        $selectedAgenda = $agendas->first();
        $indivContrib = $selectedAgenda ? $selectedAgenda->indiv_contrib : null;
        $payments = Payment::with('agendas', 'students')->paginate(10); // Change '10' to the desired number of items per page
        return view('payment.list', compact('payments', 'courses', 'agendas', 'students', 'indivContrib'));
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
    
        // Create the payment
        $payment = Payment::create([
            'student_id' => $request->student_id,
            'agenda_id' => $request->agenda_id,
            'amount' => $request->amount,
            'type' => Str::upper($request->type),
            'method' => Str::upper($request->method),
        ]);
    
        // Generate a random reference number
        $refNum = mt_rand(100000, 999999);
    
        // Create the pay element
        Pay::create([
            'payment_id' => $payment->id,
            'student_id' => $request->student_id,
            'amount' => $request->amount,
            'ref_num' => $refNum,
        ]);
    
        if ($payment) {
            return back()->with('sweetAlert', true);
        } else {
            return back()->with('error', 'Failed to register agenda activity');
        }
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
        $payment = Payment::find($id); 
        if ($payment) {
            Pay::where('payment_id', $payment->id)->delete();
            $payment->delete();
        }
    }
    
}
