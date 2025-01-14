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

    public function destroy(string $id)
    {
        //
    }
}
