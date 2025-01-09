<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use Inertia\Inertia;
use App\Models\RecentPlay;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;

class BeatStatsController extends Controller
{
    public function recordPlay($beatId)
    {
        $beat = Beat::findOrFail($beatId);
        $beat->stats()->increment('plays_count');
    }

    public function recordRecentPlay(Request $request, $beatId)
    {
        if (!auth()->check()) {
            return;
        }

        $beat = Beat::findOrFail($beatId);

        if ($beat->user_id === auth()->id()) {
            return;
        }

        $agent = new Agent();
        $deviceInfo = [
            'device' => $agent->device(),
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
        ];

        $recentPlay = RecentPlay::create([
            'user_id' => auth()->id(),
            'beat_id' => $beat->id,
            'device' => json_encode($deviceInfo),
            'play_timestamp' => now(),
        ]);
    }

    public function getFollowers()
    {
        $followers = auth()->user()->followers()->get();
        $following = auth()->user()->following()->get();

        return Inertia::render('UserBeat/FollowerPage/IndexPage', [
            'following' => $following,
            'followers' => $followers,
        ]);
    }
}
