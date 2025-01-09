<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use Inertia\Inertia;

class PageController extends Controller
{
    public function welcome()
    {
        $beats = Beat::with(['beatFile', 'user'])
            ->has('beatFile')
            ->get();
        $beatsData = $this->transformBeats($beats);

        return Inertia::render('Welcome', [
            'beats' => $beatsData,
            'auth' => $this->getAuthUserData(),
        ]);
    }

    private function transformBeats($beats)
    {
        return $beats->map(function ($beat) {
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
                    'username' => $beat->user->username,
                    'user_slug' => $beat->user->user_slug,
                ],
            ];
        });
    }

    private function getAuthUserData()
    {
        $user = auth()->user();

        if (!$user) {
            return null;
        }

        return [
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
        ];
    }

    public function newBeat()
    {
        $beats = Beat::with(['beatFile', 'user'])
            ->has('beatFile')
            ->get();
        $beatsData = $this->transformBeats($beats);

        return Inertia::render('NewBeatPage', [
            'auth' => $this->getAuthUserData(),
            'beats' => $beatsData,
        ]);
    }
}
