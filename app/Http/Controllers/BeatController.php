<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class BeatController extends Controller
{
    private function formatProfile($profile)
    {
        return [
            'bio' => e($profile->bio ?? null),
        ];
    }


    private function formatBeat($beat)
    {
        $beatFile = $beat->beatFile;

        return [
            'id' => $beat->id,
            'title' => e($beat->title),
            'created_at' => $beat->created_at->diffForHumans(),
            'genre' => e($beat->genre),
            'status' => e($beat->status),
            'stats' => [
                'plays_count' => $beat->stats->plays_count ?? 0,
            ],
            'cover_art' => $beatFile?->getFirstMediaUrl('cover_art'),
            'audio' => $beatFile?->getFirstMediaUrl('audio'),
            'user' => [
                'id' => $beat->user->id,
                'username' => e($beat->user->username),
                'city' => e($beat->user->city),
                'country' => e($beat->user->country),
            ],
            'profile' => $this->formatProfile($beat->user->profile),
        ];
    }


    public function index(Beat $beat)
    {
        $user = User::select(['id', 'username','city','country'])
            ->with([
                'beats:id,user_id,title,created_at,genre,status,slug',
                'beats.beatFile',
                'beats.stats:id,beat_id,plays_count',
                'profile:id,user_id,bio',
            ])
            ->withCount(['followers', 'following'])
            ->firstOrFail();

        $currentUser = auth()->user();
        $isFollowing = $currentUser?->isFollowing($user);

        $mainBeat = $beat;

        $relatedBeats = Beat::where('slug', '!=', $mainBeat->slug)
            ->where(function($query) use ($mainBeat) {
                $query->where('genre', $mainBeat->genre)
                      ->orWhere('user_id', $mainBeat->user_id);
            })
            ->with(['beatFile', 'stats', 'user'])
            ->take(5)
            ->get()
            ->map(fn($relatedBeat) => $this->formatBeat($relatedBeat));

        return Inertia::render('BeatPage', [
            'user' => [
                'id' => $user->id,
                'username' => e($user->username),
                'profile' => $this->formatProfile($user->profile),
                'followers_count' => $user->followers_count ?? 0,
                'following_count' => $user->following_count ?? 0,
                'city' => e($user->city),
                'country' => e($user->country),
            ],
            'beat' => $this->formatBeat($mainBeat),
            'relatedBeats' => $relatedBeats,
            'following' => $isFollowing,
        ]);
    }
}
