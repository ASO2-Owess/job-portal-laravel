<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $candidate = Auth::guard('candidate')->user();

        return view('candidate.profile.edit', compact('candidate'));
    }

    public function update(Request $request)
    {
        $candidate = Auth::guard('candidate')->user();

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('candidates', 'email')->ignore($candidate->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'cv' => ['nullable', 'mimes:pdf,doc,docx', 'max:4096'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($candidate->profile_photo_path) {
                Storage::disk('public')->delete($candidate->profile_photo_path);
            }
            $validated['profile_photo_path'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        if ($request->hasFile('cv')) {
            if ($candidate->cv_path) {
                Storage::disk('public')->delete($candidate->cv_path);
            }
            $validated['cv_path'] = $request->file('cv')->store('cvs', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        unset($validated['profile_photo'], $validated['cv']);

        $candidate->update($validated);

        return back()->with('status', 'Profil mis à jour.');
    }
}
