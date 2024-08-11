<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import User model

class ProfileController extends Controller
{
    /**
     * Show the form for editing the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        // Make sure $user is an instance of User
        if ($user instanceof User) {
            $user->update($request->only('name', 'email', 'phone'));
        }

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the user's profile.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $user = Auth::user();
        // Make sure $user is an instance of User
        if ($user instanceof User) {
            $user->delete();
        }

        return redirect()->route('home')->with('success', 'Profile deleted successfully.');
    }
}
