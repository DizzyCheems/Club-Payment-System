<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            'activity_name' => 'required',
            'fund' => 'required',
            'date' => 'required',
        ], $message);
    
        $activity = Activities::create([
            'agenda_id' => $request->agenda_id,
            'activity_name' => $request->activity_name,
            'fund' => $request->fund,
            'date' => $request->date,
        ]);
    
        if ($activity) {
            return back()->with('sweetAlert', true);
        } else {
            return back()->with('error', 'Failed to register agenda activity');
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Activities $activities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activities $activities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activities $activities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request) 
    {
       $id = $request->id;
       $emp = Activities::find($id);
       Activities::destroy($id);
   }
}
