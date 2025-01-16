<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Arr;
use App\Models\MobileDevice;
use Illuminate\Http\Request;

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

    public function userListing()
    {
        $user = auth()->user();
        $userListings = MobileDevice::with('phoneBrand', 'phoneModel', 'phoneVariant')
            ->where('user_id', $user->id)->get();

        return Inertia::render('UserAccount/IndexPageListing', [
            'userListings' => $userListings,
        ]);
    }

}
