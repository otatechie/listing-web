<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DiscussionController extends Controller
{
    const EDIT_TIME_LIMIT_MINUTES = 10;

    public function store(Request $request)
    {
        // Add rate limiting
        $this->middleware('throttle:6,1'); // 6 requests per minute

        $rules = [
            'message' => ['required', 'max:1000'],
            'mobile_device_id' => ['required', 'exists:mobile_devices,id'],
        ];

        $validated = $request->validate($rules);
        $validated['user_id'] = auth()->user()->id;

        $discussion = Discussion::create($validated);
    }

    public function update(Request $request, Discussion $discussion)
    {
        // Authorize that the current user owns this discussion
        if ($discussion->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the discussion is still editable
        if ($discussion->created_at->diffInMinutes(now()) > self::EDIT_TIME_LIMIT_MINUTES) {
            abort(403, 'Discussion can no longer be edited. Time limit exceeded.');
        }

        $validated = $request->validate([
            'message' => ['required', 'max:1000'],
        ]);

        $discussion->update($validated);

        return redirect()->back();
    }
}
