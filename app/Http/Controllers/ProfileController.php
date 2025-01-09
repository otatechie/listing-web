<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $countries = Arr::sort(countries());
        $profile = $user->profile;

        return Inertia::render('Profile/IndexPage', [
            'profile' => $profile,
            'countries' => $countries
        ]);
    }


    public function updateProfile(Request $request, UserProfile $profile)
    {
        $validatedData = $request->validate([
            'phone' => ['nullable', 'string', Rule::unique(UserProfile::class)->ignore($profile->id)],
            'bio' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('profile_photo')) {
            $profile->addMediaFromRequest('profile_photo')
                ->withResponsiveImages()
                ->toMediaCollection('profile_photo');
        }

        $profile->update($validatedData);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }


    public function updateSocialMedia(Request $request, UserProfile $profile)
    {
        $validatedData = $request->validate([
            'twitter' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string'],
            'website' => ['nullable', 'url'],
            'spotify' => ['nullable', 'string'],
        ]);

        $profile->update($validatedData);

        return redirect()->back()->with('success', 'Social media links updated successfully');
    }


    public function destroy(string $id)
    {
        //
    }
}
