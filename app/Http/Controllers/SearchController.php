<?php

namespace App\Http\Controllers;

use App\Models\MobileDevice;
use Illuminate\Http\Request;
use MeiliSearch\Client;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // For live search, take fewer results
        $results = MobileDevice::search($request->search)
            ->when($request->device_type, function ($query) use ($request) {
                $query->where('device_type', $request->device_type);
            })
            ->when($request->min_price, function ($query) use ($request) {
                $query->where('price', '>=', $request->min_price);
            })
            ->when($request->max_price, function ($query) use ($request) {
                $query->where('price', '<=', $request->max_price);
            })
            ->take(5) // Limit for dropdown
            ->get();

        return response()->json($results);
    }

    // Add separate method for full search page
    public function index(Request $request)
    {
        return MobileDevice::search($request->search)
            ->when($request->device_type, function ($query) use ($request) {
                $query->where('device_type', $request->device_type);
            })
            ->when($request->min_price, function ($query) use ($request) {
                $query->where('price', '>=', $request->min_price);
            })
            ->when($request->max_price, function ($query) use ($request) {
                $query->where('price', '<=', $request->max_price);
            })
            ->paginate(20);
    }
}
