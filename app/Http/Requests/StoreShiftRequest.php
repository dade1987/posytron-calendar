<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StoreShiftRequest extends FormRequest
{
    public function authorize()
    {
        // Permette l'accesso solo agli utenti autenticati
        return auth()->check();
    }

    public function rules()
    {
        $nextMonday = Carbon::now()->startOfWeek()->addWeek();
        $nextSunday = $nextMonday->copy()->endOfWeek();

        return [
            'start_time' => 'required|date|after_or_equal:' . $nextMonday->format('Y-m-d H:i:s') . '|before_or_equal:' . $nextSunday->format('Y-m-d H:i:s'),
            'end_time' => 'required|date|after:start_time',
        ];
    }

    public function messages()
    {
        return [
            'start_time.required' => 'La data di inizio è obbligatoria.',
            'start_time.after_or_equal' => 'Il turno deve iniziare da lunedì prossimo.',
            'start_time.before_or_equal' => 'Il turno non può superare la domenica successiva.',
            'end_time.required' => 'La data di fine è obbligatoria.',
            'end_time.after' => 'La data di fine deve essere successiva alla data di inizio.',
        ];
    }
}
