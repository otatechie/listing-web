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
        ]);

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
        //
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
