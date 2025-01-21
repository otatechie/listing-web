<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\MobileDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function favorite(string $mobileDeviceId)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Please login to favorite devices');
            return back();
        }

        if (Auth::user()->id === $mobileDeviceId) {
            session()->flash('error', 'You cannot favorite your own device');
            return back();
        }

        $exists = Favorite::where([
            'user_id' => Auth::id(),
            'mobile_device_id' => $mobileDeviceId
        ])->first();

        if ($exists) {
            $exists->delete();
            session()->flash('success', 'Device removed from favorites');
            return back();
        }

        Favorite::create([
            'user_id' => Auth::id(),
            'mobile_device_id' => $mobileDeviceId
        ]);

        session()->flash('success', 'Device added to favorites');
    }
}
