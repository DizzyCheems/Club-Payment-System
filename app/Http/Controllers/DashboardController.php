<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Agenda;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        
    public function index()
    {
      
        $agendaCount = Agenda::count();
        $totalAmount = Payment::sum('amount');
        $user = Auth::user();
        $recentAgendas = Agenda::orderBy('created_at', 'desc')->take(4)->get();
        foreach ($recentAgendas as $agenda) {
            $agenda->paymentCount = Payment::where('agenda_id', $agenda->id)->count();
        }

        return view('dashboard.dashboard', compact('user', 'totalAmount', 'agendaCount', 'recentAgendas'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
