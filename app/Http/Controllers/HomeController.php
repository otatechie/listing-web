<?php

namespace App\Http\Controllers;

use App\Models\Beat;

use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('profile');

        $beats = Beat::with(['beatFile', 'user.profile'])->get();

        $beatsData = $beats->map(function ($beat) {
            $beatFile = $beat->beatFile;

            return [
                'id' => $beat->id,
                'slug' => $beat->slug,
                'title' => $beat->title,
                'genre' => $beat->genre,
                'bpm' => $beat->bpm,
                'type' => $beat->type,
                'status' => $beat->status,
                'created_at' => $beat->created_at->diffForHumans(),
                'cover_art' => $beatFile ? $beatFile->getFirstMediaUrl('cover_art') : null,
                'audio' => $beatFile ? $beatFile->getFirstMediaUrl('audio') : null,
                'user' => [
                    'id' => $beat->user->id,
                    'name' => $beat->user->username,
                ],
            ];
        });

        $recentPlays = $user->recentPlays()
            ->with(['beat.beatFile', 'beat.user'])
            ->get()
            ->map(function ($recentPlay) {
                $beatFile = $recentPlay->beat->beatFile;

                return [
                    'id' => $recentPlay->id,
                    'beat' => [
                        'id' => $recentPlay->beat->id,
                        'title' => $recentPlay->beat->title,
                        'cover_art' => $beatFile ? $beatFile->getFirstMediaUrl('cover_art') : null,
                        'user' => [
                            'name' => $recentPlay->beat->user->username
                        ]
                    ]
                ];
            });

        return Inertia::render('Home', [
            'beats' => $beatsData,
            'recentPlays' => $recentPlays,
            'user' => $user,
        ]);
    }
}
