<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Pay;
use App\Models\Agenda;
use App\Models\Student;
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
     
         // Get the total number of Pay elements
         $payCount = Pay::count();
     
         return view('dashboard.dashboard', compact('user', 'totalAmount', 'agendaCount', 'recentAgendas', 'payCount'));
     }

     public function user()
    {
        $user = Auth::user();
        $agendaCount = Agenda::count();
        $agendas = Agenda::all();

        // Try to find a student record for this user
        $student = Student::where('user_id', $user->id)->first();

        // If no student record found, show dashboard with empty or default data
        if (!$student) {
            $payments = collect(); // empty collection
            $totalAmount = 0;
            $recentAgendas = Agenda::orderBy('created_at', 'desc')->take(4)->get();
            $payCount = Pay::count();

            foreach ($recentAgendas as $agenda) {
                $agenda->paymentCount = Payment::where('agenda_id', $agenda->id)->count();
            }

            return view('User.dashboard', compact(
                'user',
                'totalAmount',
                'agendaCount',
                'recentAgendas',
                'payCount',
                'payments',
                'agendas'
            ))->with('warning', 'You are not yet registered as a student.');
        }

        // If student record exists, load their payments
        $payments = $student->payments()->get();
        $totalAmount = $payments->sum('amount');
        $recentAgendas = Agenda::orderBy('created_at', 'desc')->take(4)->get();
        $payCount = Pay::count();

        foreach ($recentAgendas as $agenda) {
            $agenda->paymentCount = Payment::where('agenda_id', $agenda->id)->count();
        }

        return view('User.dashboard', compact(
            'user',
            'totalAmount',
            'agendaCount',
            'recentAgendas',
            'payCount',
            'payments',
            'agendas'
        ));
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
