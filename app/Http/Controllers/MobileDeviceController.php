<?php

namespace App\Http\Controllers;

use App\Models\MobileDevice;
use App\Models\PhoneBrand;
use App\Models\PhoneModel;
use App\Models\PhoneVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class MobileDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appleId = PhoneBrand::where('slug', 'apple')->value('id');
        $samsungId = PhoneBrand::where('slug', 'samsung')->value('id');
        $pixelId = PhoneBrand::where('slug', 'google')->value('id');
        $oneplusId = PhoneBrand::where('slug', 'oneplus')->value('id');

        $brandIds = [
            'iphone' => $appleId,
            'samsung' => $samsungId,
            'pixel' => $pixelId,
            'oneplus' => $oneplusId,
        ];

        $devices = [];
        foreach ($brandIds as $key => $brandId) {
            $devices["{$key}Devices"] = PhoneVariant::with('phoneBrand')
                ->where('phone_brand_id', $brandId)
                ->limit(6)
                ->get();
        }

        return Inertia::render('MobileDevice/IndexPage', $devices);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $phoneBrands = PhoneBrand::select('id', 'name')
            ->orderBy('name')
            ->get();
        $phoneModels = PhoneModel::select('id', 'model_number', 'phone_variant_id')
            ->orderBy('model_number')
            ->get();
        $phoneVariants = PhoneVariant::select('id', 'name', 'phone_brand_id')
            ->orderBy('name')
            ->get();

        return Inertia::render('MobileDevice/CreatePage', [
            'phoneBrands' => $phoneBrands,
            'phoneModels' => $phoneModels,
            'phoneVariants' => $phoneVariants,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $baseRules = [
            'listing_title' => ['required', 'string'],
            'listing_description' => ['required', 'string'],
            'damage_wear_description' => ['nullable', 'string'],
            'ram' => [
                'required_if:is_apple,false',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value && !$request->is_apple && !in_array($value, [64, 128, 256, 512, 1024])) {
                        $fail('The RAM must be one of the following values: 64, 128, 256, 512, or 1024.');
                    }
                }
            ],
            'price' => ['required', 'numeric'],
            'storage_capacity' => ['required', 'string', 'in:64,128,256,512,1024'],
            'condition' => ['required', 'in:new,mint,good,fair'],
            'images' => ['required', 'array'],
            'phone_brand_id' => ['required', 'exists:phone_brands,id'],
            'phone_variant_id' => ['nullable', 'exists:phone_variants,id'],
            'phone_model_id' => ['nullable', 'exists:phone_models,id'],
            'color' => ['required', 'in:black,white,gold,pacific_blue,deep_purple,sierra_blue,midnight,starlight,space_gray,silver,rose_gold,purple,pink,mint,lavender,green,gray,graphite,cream,coral,burgundy,blue,alpine_green,titanium,yellow'],
            'carrier' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:100'],
            'is_active' => ['boolean'],
            'battery_health' => [
                'required_if:is_apple,true',
                'nullable',
                'numeric',
                'min:0',
                'max:100'
            ],
        ];

        $validatedData = $request->validate($baseRules);

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
        $mobileDevice = MobileDevice::with([
            'user:id,name,email,created_at',
            'phoneBrand:id,name',
            'phoneModel:id,model_number',
            'phoneVariant:id,name',
            'media'
        ])
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
                'user_id',
                'battery_health',
                'ram',
                'region',
                'phone_brand_id',
                'phone_model_id',
                'phone_variant_id',
                'created_at',
                'updated_at',
            ])->findOrFail($id);

        $created_at_human = $mobileDevice->created_at ? $mobileDevice->created_at->diffForHumans() : null;
        $updated_at_human = $mobileDevice->updated_at ? $mobileDevice->updated_at->format('M d, Y') : null;
        $joined_at_human = $mobileDevice->user->created_at ? $mobileDevice->user->created_at->format('M d, Y') : null;
        $count_listings = MobileDevice::where('user_id', $mobileDevice->user_id)->count();
        $active_listings = MobileDevice::where('user_id', $mobileDevice->user_id)
            ->where('is_active', true)
            ->count();

        $images = $mobileDevice->getMedia('images')->map(function ($media) {
            return $media->getUrl();
        });

        return Inertia::render('MobileDevice/ShowPage', [
            'mobileDevice' => array_merge($mobileDevice->toArray(), [
                'created_at_human' => $created_at_human,
                'updated_at_human' => $updated_at_human,
                'joined_at_human' => $joined_at_human,
                'count_listings' => $count_listings,
                'active_listings' => $active_listings,
                'images' => $images,
                'full_name' => implode(' ', array_filter([
                    $mobileDevice->phoneBrand?->name,
                    $mobileDevice->phoneVariant?->name,
                    $mobileDevice->phoneModel?->model_number
                ])),
                'location' => implode(', ', array_filter([$mobileDevice->town, $mobileDevice->region])),
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
                'phone_brand_id' => ['required', 'exists:phone_brands,id'],
                'phone_variant_id' => ['nullable', 'exists:phone_variants,id'],
                'phone_model_id' => ['nullable', 'exists:phone_models,id'],
                'color' => ['required', 'string'],
                'ram' => [
                    'required_if:is_apple,false',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($value && !$request->is_apple && !in_array($value, [64, 128, 256, 512, 1024])) {
                            $fail('The RAM must be one of the following values: 64, 128, 256, 512, or 1024.');
                        }
                    }
                ],
                'battery_health' => [
                    'required_if:is_apple,true',
                    'nullable',
                    'numeric',
                    'min:0',
                    'max:100'
                ],
            ],
            '2' => [
                'carrier' => ['nullable', 'string'],
                'town' => ['nullable', 'string', 'max:100'],
                'region' => ['nullable', 'string', 'max:100'],
            ],
            '3' => [
                'listing_title' => ['required', 'string'],
                'listing_description' => ['required', 'string'],
                'damage_wear_description' => ['nullable', 'string'],
                'price' => ['required', 'numeric'],
            ],
            '4' => [
                'images' => ['required', 'array'],
                'images.*' => ['image', 'max:5048'] // 5MB max per image
            ]
        ];

        $validator = Validator::make($request->all(), $rules[$step] ?? []);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        return response()->json([
            'message' => 'Validation passed'
        ]);
    }
}
