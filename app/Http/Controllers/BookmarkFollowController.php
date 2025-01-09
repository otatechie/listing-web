<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkFollowController extends Controller
{
    public function follow(Request $request, string $userId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->id === $userId) {
            return back();
        }

        $existingFollow = Follow::where([
            'follower_id' => Auth::user()->id,
            'following_id' => $userId
        ])->first();

        if ($existingFollow) {
            $existingFollow->delete();
            return back();
        }

        $follow = Follow::create([
            'follower_id' => Auth::user()->id,
            'following_id' => $userId,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return back();
    }
}
