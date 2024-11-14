<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShiftRequest extends FormRequest
{
    public function authorize()
    {
        // Permetti l'accesso solo agli utenti autenticati
        return auth()->check();
    }

    public function rules()
    {
        return [
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ];
    }

    public function messages()
    {
        return [
            'start_time.required' => 'La data di inizio è obbligatoria.',
            'start_time.after' => 'La data di inizio deve essere una data futura.',
            'end_time.required' => 'La data di fine è obbligatoria.',
            'end_time.after' => 'La data di fine deve essere successiva alla data di inizio.',
        ];
    }
}
