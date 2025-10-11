<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\Agenda;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function index()
    {
        $activities = Activities::all();
        return view('activity.index', compact('activities'));
    }

    public function create()
    {
        //
    }

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

    /** View Activity Details */
    public function view($id)
    {
        $activity = Activities::with('agenda')->findOrFail($id);
        return view('activity.view', compact('activity'));
    }

    /** Edit Activity Form */
    public function edit($id)
    {
        $activity = Activities::findOrFail($id);
        $agendas = Agenda::all();
        return view('activity.edit', compact('activity', 'agendas'));
    }

    /** Update Activity */
    public function update(Request $request, $id)
    {
        $request->validate([
            'activity_name' => 'required',
            'fund' => 'required|numeric',
            'date' => 'required|date',
            'agenda_id' => 'required',
        ]);

        $activity = Activities::findOrFail($id);
        $activity->update([
            'activity_name' => $request->activity_name,
            'fund' => $request->fund,
            'date' => $request->date,
            'agenda_id' => $request->agenda_id,
        ]);

        return redirect()->route('activity.view', $id)->with('success', 'Activity updated successfully!');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        Activities::destroy($id);
    }
}
