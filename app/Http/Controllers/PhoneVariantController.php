<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\MobileDevice;
use App\Models\PhoneVariant;
use Illuminate\Http\Request;

class PhoneVariantController extends Controller
{
    public function index($slug)
    {
        $phoneVariant = PhoneVariant::with('phoneBrand')
            ->where('slug', $slug)
            ->firstOrFail();

        $mobileDevices = MobileDevice::with(['phoneBrand', 'phoneModel', 'phoneVariant', 'user'])
            ->whereHas('phoneVariant', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->get()
            ->map(function ($device) {
                $device->image = $device->getFirstMediaUrl('images');
                return $device;
            });

        return Inertia::render('PhoneVariant/IndexPage', [
            'mobileDevices' => $mobileDevices,
            'phone_variant' => $phoneVariant
        ]);
    }
}
