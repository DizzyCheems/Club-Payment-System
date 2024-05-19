<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Payment;
use App\Models\Pay;
use App\Models\Agenda;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $payments = Payment::with('agendas', 'students')->paginate(10); 
        return view('payment.list', compact('payments', 'courses', 'agendas', 'students', 'indivContrib'));
    }
    
    public function index_invoice(Request $request)
    {
        $courses = Course::all();   
        $agendas = Agenda::all();
        $students = Student::all();
        $pays = Pay::all();
        $selectedAgenda = $agendas->first();
        $indivContrib = $selectedAgenda ? $selectedAgenda->indiv_contrib : null;
        $payments = Payment::with('agendas', 'students')->paginate(10); 
        return view('payment.pays_list', compact('payments', 'courses', 'agendas', 'students', 'indivContrib', 'pays'));
    }
    
    
    public function index_user(Request $request)
{
    $user = Auth::user();
    $courses = Course::all();
    $agendas = Agenda::all();
    $students = Student::where('user_id', $user->id)->get();
    //$students = Student::all();
    $selectedAgenda = $agendas->first();
    $indivContrib = $selectedAgenda ? $selectedAgenda->indiv_contrib : null;

    $payments = collect();
    foreach ($students as $student) {
        $payments = $payments->merge($student->payments);
    }

    $payments = $payments;

    // You can directly use $user->name instead of retrieving it separately
    $userName = $user->name;

    // Encode students data as JSON
    $studentsJson = $students->toJson();
    
    return view('User.payments', compact('payments', 'students', 'courses', 'agendas', 'studentsJson', 'indivContrib', 'userName'));
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
        $selectedAgenda = $agendas->first(); 
        $indivContrib = $selectedAgenda ? $selectedAgenda->indiv_contrib : null;
        return view('payment.create', compact('courses', 'agendas', 'students', 'indivContrib'));
    }
    public function getIndivContrib($id)
    {
        $agenda = Agenda::find($id);
        return response()->json(['indiv_contrib' => $agenda ? $agenda->indiv_contrib : null]);
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
    
        $payment = Payment::create([
            'student_id' => $request->student_id,
            'agenda_id' => $request->agenda_id,
            'amount' => $request->amount,
            'type' => Str::upper($request->type),
            'method' => Str::upper($request->method),
        ]);
    
     
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
        $payments=Payment::with('agendas')->find($id);
        $courses = $payments->course;
        $pays = $payments->pays;
        $students = $payments->students;
        $agendas = $payments->agendas;
        $subtotal = $payments->amount; 
        $total = $subtotal - 0; 

        return view('payment.view', compact('courses', 'agendas', 'students', 'payments', 'pays', 'subtotal', 'total'));
    }
    public function invoice($id)
    {
        //
        $payments=Payment::with('agendas')->find($id);
        $courses = $payments->course;
        $pays = $payments->pays;
        $students = $payments->students;
        $agendas = $payments->agendas;
        $subtotal = $payments->amount; 
        $total = $subtotal - 0; 

        return view('pays.invoice', compact('courses', 'agendas', 'students', 'payments', 'pays', 'subtotal', 'total'));
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

    public function updatePayments(Request $request) {
        $paymentIds = $request->input('paymentIds');
    
        // Update 'approved' column for selected payments
        Payment::whereIn('id', $paymentIds)->update(['approved' => 1]);
    
        return response()->json(['message' => 'Payments updated successfully']);
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
