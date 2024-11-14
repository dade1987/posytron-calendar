<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Shift;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShiftPolicy
{
    use HandlesAuthorization;

    public function create(User $user, $start_time, $end_time)
    {
        // Controllo accavallamento
        $overlap = Shift::where('user_id', $user->id)
            ->where('start_time', '<', $end_time)
            ->where('end_time', '>', $start_time)
            ->exists();

        return !$overlap;
    }

    public function update(User $user, Shift $shift, $start_time, $end_time)
    {
        // Controllo se la modifica è permessa
        if (now()->diffInDays($shift->start_time) < 1) {
            return false;
        }

        // Controllo accavallamento
        $overlap = Shift::where('user_id', $user->id)
            ->where('id', '!=', $shift->id)
            ->where('start_time', '<', $end_time)
            ->where('end_time', '>', $start_time)
            ->exists();

        return !$overlap;
    }

    public function delete(User $user, Shift $shift)
    {
        // Controllo se l'eliminazione è permessa
        if (now()->diffInDays($shift->start_time) < 3) {
            return false;
        }

        return true;
    }
}