<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;

class UserAccountController extends Controller
{
    private function getAuthUser(): User
    {
        return auth()->user();
    }


    public function index()
    {

        $user = $this->getAuthUser();
        $profile = $user->profile;

        return Inertia::render('UserAccount/IndexPage', [
            'user' => array_merge($user->only('name', 'email', 'username', 'city', 'country'), [
                'is_setup_complete' => $profile->is_setup_complete ?? false
            ]),
            'countries' => Arr::sort(countries()),
            'profile' => $profile,
        ]);
    }


    public function twoFactorAuthentication()
    {
        $user = $this->getAuthUser();

        $data = [
            'user' => $user,
            'qrCodeSvg' => $user->two_factor_secret ? $user->twoFactorQrCodeSvg() : null,
            'recoveryCodes' => $user->two_factor_secret ? json_decode(decrypt($user->two_factor_recovery_codes, true)) : null,
        ];

        return Inertia::render('UserAccount/IndexTwoFactorAuthenticationPage', $data);
    }


    public function switchRole()
    {
        $user = auth()->user();
        $newRole = $user->hasRole('producer') ? 'listener' : 'producer';

        $user->syncRoles([$newRole]);

        session()->flash('success', "Your profile has been switched to {$newRole} mode");

        return redirect()->route('home');
    }
}
