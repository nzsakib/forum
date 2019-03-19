<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;

class ProfilesController extends Controller
{
    public function show(User $user) 
    {
        return view('profiles.show', [
            'activities' => Activity::feed($user),
            'profileUser' => $user
        ]);
    }

    protected function getActivity($user)
    {
        return $user->activity()->latest()->with('subject')->take(50)->get()->groupBy(function($activity) {
            return $activity->created_at->format('Y-m-d');
        });
    }

}
