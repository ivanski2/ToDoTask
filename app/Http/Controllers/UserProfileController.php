<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Display the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user')); // Assuming your profile view is in resources/views/profile/profile.blade.php
    }

    /**
     * Show the form for editing the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user')); // Assuming your edit form view is in resources/views/profile/edit.blade.php
    }

    /**
     * Update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
    Log::info('Update method started.');

        Log::info($request->all());
        $user = Auth::user();
        Log::info('Before validation.');

        // Validate the incoming request data.
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'sometimes|nullable|string|min:8|confirmed',
                'profile_image' => 'sometimes|file|image|max:5000', // max 5MB
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed.', ['errors' => $e->errors()]);
            return back()->withErrors($e->errors());
        }

        Log::info('After validation.');
        // If a profile image is uploaded, store it and set the path in the data
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_pics', 'public');
            if (!$path) {
                return back()->with('error', 'Error uploading image.');
            }
            $data['profile_image'] = $path;
        }

        // If a password is provided, hash it
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        // Update the user's data
        $user->update($data);
        Log::info('Update method completed.');

        return redirect()->route('profile.index')->with('status', 'Profile updated successfully!');

    }
}

