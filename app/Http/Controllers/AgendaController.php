<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Activities;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $agendas = Agenda::all();
        return view('agenda.list', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $totalStudents = Student::count(); // Get the total count of students
        return view('agenda.create', ['totalStudents' => $totalStudents]);
    }

    public function addagenda_auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully logged in!',
            ]);
        }
    
        // Authentication failed
        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials. Please try again.',
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = [
            'required' => 'This field is required!'
        ];

        $request->validate([
            'agenda_name' => 'required',
            'deadline' => 'required',
            'num_students' => 'required|integer',
            'indiv_contribution' => 'required|numeric',
            'total_fund' => 'required|numeric',
        ], $message);

        Agenda::create([
            'agenda_name' => $request->agenda_name,
            'deadline' => $request->deadline,
            'num_students' => $request->num_students,
            'indiv_contrib' => $request->indiv_contribution,
            'total_fund' => $request->total_fund,
        ]);

        return redirect()->route('agenda.index')->with('success', 'Agenda Registered Successfully');    
    }


    /**
     * Display the specified resource.
     */
    public function view($id)
    {
        $allAgendas = Agenda::all(); 
        $activities = Activities::all(); 
        $agendas = Agenda::find($id);
        return view('agenda.view', [
            'allAgendas' => $allAgendas,
            'activities' => $activities,
            'agendas' => $agendas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data=Agenda::find($id);
        return view ('agenda.edit',['agendas'=>$data]);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        //
        $message=[
            'required' => 'This credential field is required!'
        ]; 
        $request->validate([
            'agenda_name'=>'required',
            'deadline'=>'required',
            'total_fund'=>'required',
          

        ],$message);
        $agenda=Agenda::find($request->id);
        $agenda->agenda_name=$request->agenda_name;
        $agenda->deadline=$request->deadline;
        $agenda->total_fund=$request->total_fund;                
        $agenda->save();
        return redirect()->route('agenda.index')
        ->with('success', 'Agenda, Updated Successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request) 
    {
       $id = $request->id;
       $emp = Agenda::find($id);
       Agenda::destroy($id);
   }
}
