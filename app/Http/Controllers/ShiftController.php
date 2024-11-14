<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreShiftRequest;
use App\Http\Requests\UpdateShiftRequest;

class ShiftController extends Controller
{
    // Elenco turni (30 giorni)
    public function index()
    {
        $shifts = Shift::where('start_time', '>=', now())
            ->where('start_time', '<=', now()->addDays(30))
            ->get();
        return view('shifts.index', compact('shifts'));
    }

    // Elenco turni per utente
    public function userShifts($userId)
    {
        $shifts = Shift::where('user_id', $userId)->get();
        return view('shifts.user', compact('shifts'));
    }

    // Elenco turni inviati almeno 10 giorni prima
    public function shiftsNotice()
    {
        $shifts = Shift::whereRaw('DATEDIFF(start_time, created_at) >= 10')->get();
        return view('shifts.notice', compact('shifts'));
    }

    // Creazione turno
    public function store(StoreShiftRequest $request)
    {
        $user = Auth::user();
        $start_time = $request->start_time;
        $end_time = $request->end_time;

        if (!$user->can('create', [Shift::class, $start_time, $end_time])) {
            return back()->withErrors(['error' => 'Il turno si sovrappone a un altro esistente.']);
        }

        // Creazione del turno
        Shift::create([
            'user_id' => $user->id,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

        return back()->with('success', 'Turno creato con successo.');
    }

    // Modifica turno
    public function update(UpdateShiftRequest $request, Shift $shift)
    {
        $user = Auth::user();
        $start_time = $request->start_time;
        $end_time = $request->end_time;

        if (!$user->can('update', [$shift, $start_time, $end_time])) {
            return back()->withErrors(['error' => 'Modifica non consentita.']);
        }

        // Aggiornamento del turno
        $shift->update($request->validated());

        return back()->with('success', 'Turno modificato con successo.');
    }

    // Eliminazione turno
    public function destroy(Shift $shift)
    {
        $user = Auth::user();

        if (!$user->can('delete', $shift)) {
            return back()->withErrors(['error' => 'Eliminazione non consentita a meno di 3 giorni dal turno.']);
        }

        $shift->delete();
        return back()->with('success', 'Turno eliminato con successo.');
    }

    public function edit(Shift $shift)
    {
        return view('shifts.edit', compact('shift'));
    }
}
