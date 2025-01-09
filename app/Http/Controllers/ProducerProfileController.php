<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use App\Models\Reaction;

class ProducerProfileController extends Controller
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
        $currentUser = auth()->user();

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
            'reaction_counts' => $beat->reactions()
                ->select('reaction_type')
                ->selectRaw('count(*) as count')
                ->groupBy('reaction_type')
                ->pluck('count', 'reaction_type')
                ->toArray(),
            'user_reactions' => $currentUser
                ? $beat->reactions()
                    ->where('user_id', $currentUser->id)
                    ->pluck('reaction_type')
                    ->toArray()
                : [],
        ];
    }

    public function show($user_slug)
    {
        $user = User::select(['id', 'username', 'user_slug', 'city', 'country'])
            ->with([
                'beats:id,user_id,title,created_at,genre,status',
                'beats.beatFile',
                'beats.stats:id,beat_id,plays_count',
                'profile:id,user_id,bio',
            ])
            ->withCount(['followers', 'following'])
            ->where('user_slug', $user_slug)
            ->firstOrFail();

        $currentUser = auth()->user();

        $isFollowing = $currentUser?->isFollowing($user);

        $beats = $user->beats->map(fn($beat) => $this->formatBeat($beat));

        $countryName = $user->country ? country($user->country)->getEmoji() : null;

        return Inertia::render('Producer/ShowPage', [
            'user' => [
                'id' => $user->id,
                'username' => e($user->username),
                'city' => e($user->city),
                'country' => e($countryName),
                'profile' => $this->formatProfile($user->profile),
                'followers_count' => $user->followers_count ?? 0,
                'following_count' => $user->following_count ?? 0,
            ],
            'beats' => $beats,
            'following' => $isFollowing,
        ]);
    }

    public function producerSetup()
    {
        return Inertia::render('Producer/SetupPage', [
            'user' => auth()->user()->only('name', 'email', 'city', 'country'),
        ]);
    }
}
