<?php

namespace App\Services;

use App\Models\Point;
use App\Models\User;
use Carbon\Carbon;

class LoginPointService
{
    public function giveDailyLoginPoints(User $user)
    {
        $today = Carbon::today();

        // Check if the user has already received points today
        if ($user->last_login_at && $user->last_login_at->isSameDay($today)) {
            return false;
        }

        // Fetch points for daily login
        $points = Point::where('name', 'daily_login')->first();

        if (!$points) {
            // Optionally, create points if it doesn't exist
            $points = Point::create([
                'name' => 'daily_login',
                'point' => 5, // Assuming daily login points are free
            ]);
        }

        // Add points to the user's total points
        $user->increment('points', $points->point);

        // Update the last login time
        $user->last_login_at = now();
        $user->save();

        return true;
    }
}
