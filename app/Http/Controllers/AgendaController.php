<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

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
        return view('agenda.create');
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
                    'agenda_name'=>'required',
                    'deadline'=>'required',
                    'total_fund'=>'required',
                    ],$message);
                                  
                    Agenda::create([
                    'agenda_name' => $request->agenda_name, 
                    'deadline' => $request->deadline,
                    'total_fund' => $request->total_fund,
                    ]);
                    return redirect()->route('agenda.index')->with('success', 'Agenda Registered Successfully');    
        
    }

    /**
     * Display the specified resource.
     */
    public function view($id)
    {
        //
        $data=Agenda::find($id);
        return view ('agenda.view',['agendas'=>$data]);   
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
