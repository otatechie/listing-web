<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use App\Models\MobileDevice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactRequests = ContactRequest::where(function ($query) {
            $query->where('seller_id', auth()->id())
                  ->orWhere('buyer_id', auth()->id());
        })
            ->with(['buyer', 'seller', 'mobileDevice'])
            ->latest()
            ->paginate(10);

        $contactRequests->through(function ($request) {
            $request->created_at_formatted = $request->created_at->diffForHumans();
            $request->created_at = $request->created_at->toJSON();
            $request->device = [
                'brand' => $request->mobileDevice->phoneBrand?->name,
                'variant' => $request->mobileDevice->phoneVariant?->name,
                'model' => $request->mobileDevice->phoneModel?->model_number,
                'price' => $request->mobileDevice->price,
            ];
            return $request;
        });

        return inertia('ContactRequest/IndexPage', [
            'contactRequests' => $contactRequests
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            session()->flash('error', 'Please login to request contact information');
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'mobile_device_id' => 'required|exists:mobile_devices,id',
        ]);

        $device = MobileDevice::findOrFail($validated['mobile_device_id']);

        if ($device->user_id === auth()->id()) {
            return response()->json([
                'message' => 'You cannot request contact information for your own listing'
            ], 403);
        }

        $contactRequest = ContactRequest::create([
            'buyer_id' => auth()->id(),
            'mobile_device_id' => $validated['mobile_device_id'],
            'seller_id' => $device->user_id,
            'status' => 'pending'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactRequest $contactRequest)
    {
        $this->authorize('view', $contactRequest);

        return inertia('ContactRequests/Show', [
            'contactRequest' => $contactRequest->load(['buyer', 'seller', 'mobileDevice'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactRequest $contactRequest)
    {
        $this->authorize('update', $contactRequest);

        $validated = $request->validate([
            'status' => ['required', Rule::in(['approved', 'rejected'])],
        ]);

        $contactRequest->update([
            'status' => $validated['status'],
            $validated['status'] . '_at' => now(),
        ]);

        return response()->json([
            'contact_request' => $contactRequest
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactRequest $contactRequest)
    {
        $this->authorize('delete', $contactRequest);

        $contactRequest->delete();

        return response()->json([
            'message' => 'Contact request deleted successfully'
        ]);
    }
}
