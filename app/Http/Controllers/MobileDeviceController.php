<?php

namespace App\Http\Controllers;

use App\Models\MobileDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class MobileDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('MobileDevice/IndexPage');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('MobileDevice/CreatePage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'listing_title' => [
                'required',
                'string',
            ],
            'listing_description' => [
                'required',
                'string',
            ],
            'damage_wear_description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
            ],

            'storage_capacity' => [
                'required',
                'string',
            ],
            'condition' => [
                'required',
                'string',
            ],

            'images' => [
                'nullable',
                'array',
            ],
            'user_id' => [
                'nullable',
                'exists:users,id',
            ],
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $mobileDevice = MobileDevice::create($validatedData);

        $mobileDevice->addFromMediaLibraryRequest($request->images)
            ->toMediaCollection('images');

        session()->flash('success', 'Mobile device added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mobileDevice = MobileDevice::with('user:id,name,email,created_at')
            ->select([
                'id',
                'slug',
                'listing_title',
                'listing_description',
                'damage_wear_description',
                'price',
                'storage_capacity',
                'condition',
                'carrier',
                'color',
                'exchange_possible',
                'user_id',
                'created_at',
                'updated_at',
            ])->findOrFail($id);

        $created_at_human = $mobileDevice->created_at ? $mobileDevice->created_at->diffForHumans() : null;
        $updated_at_human = $mobileDevice->updated_at ? $mobileDevice->updated_at->format('M d, Y') : null;
        $joined_at_human = $mobileDevice->user->created_at ? $mobileDevice->user->created_at->format('M d, Y') : null;
        $count_listings = MobileDevice::where('user_id', $mobileDevice->user_id)->count();

        return Inertia::render('MobileDevice/ShowPage', [
            'mobileDevice' => array_merge($mobileDevice->toArray(), [
                'created_at_human' => $created_at_human,
                'updated_at_human' => $updated_at_human,
                'joined_at_human' => $joined_at_human,
                'count_listings' => $count_listings,
            ]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function validateStep(Request $request, $step)
    {
        $rules = [
            '1' => [
                'storage_capacity' => ['required', 'string'],
                'condition' => ['required', 'string'],
            ],
            '2' => [
                'listing_title' => ['required', 'string'],
                'listing_description' => ['required', 'string'],
                'damage_wear_description' => ['nullable', 'string'],
            ],
            '3' => [
                'exchange_possible' => ['required', 'boolean'],
                'carrier' => ['nullable', 'string'],
                'color' => ['required', 'string'],
                'price' => ['required', 'numeric'],
            ],
        ];

        $validator = Validator::make($request->all(), $rules[$step] ?? []);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        return back();
    }
}
