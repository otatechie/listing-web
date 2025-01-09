<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Models\BeatFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Http;
use App\Services\AudioFingerprintService;

class UserBeatFileController extends Controller
{
    private AudioFingerprintService $fingerprintService;

    public function __construct(AudioFingerprintService $fingerprintService)
    {
        $this->fingerprintService = $fingerprintService;
    }


    public function index()
    {
        $user = auth()->user();

        $beat =  $user->beats()->where('status', 'draft')->get()->map(function ($beat) {
            return [
                'id' => $beat->id,
                'slug' => $beat->slug,
                'title' => $beat->title,
                'genre' => $beat->genre,
                'type' => $beat->type,
                'bpm' => $beat->bpm,
                'status' => $beat->status,
                'created_at' => Carbon::parse($beat->created_at)->diffForHumans(),
            ];
        });

        return Inertia::render('UserBeatFile/CreatePage', [
            'beat' => $beat,
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'beat_id' => [
                'required',
                'string',
                Rule::exists('beats', 'id'),
            ],
            'cover_art' => [
                'required',
                'max:2048',
            ],
            'audio' => [
                'required',
                'max:10240',
            ],
        ]);

        // Create beat file first
        $beatFile = BeatFile::create([
            'beat_id' => $validatedData['beat_id'],
        ]);

        // Handle audio file and generate fingerprint
        if ($request->has('audio')) {
            $beatFile->addFromMediaLibraryRequest($request->audio)
                ->toMediaCollection('audio');

            // Get the latest media after processing
            $media = $beatFile->fresh()->getFirstMedia('audio');

            if ($media && !$beatFile->fingerprint) {
                $audioPath = $media->getPath();
                $fingerprint = $this->fingerprintService->generateFingerprint($audioPath);

                if (!empty($fingerprint['fingerprint'])) {
                    if ($this->fingerprintService->checkDuplicates($fingerprint)) {
                        $media->delete();
                        $beatFile->delete();

                        session()->flash('error', 'We detected that this beat has already been uploaded to our platform. Please upload a different beat.');
                        return redirect()->back();
                    }

                    $beatFile->update([
                        'fingerprint' => $fingerprint['fingerprint'],
                        'duration' => $fingerprint['duration'],
                    ]);

                    session()->flash('success', 'Beat files uploaded and published successfully');
                }
            }
        }


        if ($request->has('cover_art')) {
            $beatFile->addFromMediaLibraryRequest($request->cover_art)
                ->toMediaCollection('cover_art');
        }

        $beat = Beat::findOrFail($validatedData['beat_id']);
        $beat->update(['status' => 'published']);

        session()->flash('success', 'Great! Beat files uploaded and published successfully');

        return redirect()->route('beat.index');
    }

    public function update(Request $request, string $id)
    {
        $beatFile = BeatFile::findOrFail($id);

        if ($request->cover_art !== null && $request->cover_art !== '') {
            $beatFile->syncFromMediaLibraryRequest(['cover_art' => $request->cover_art])
                ->toMediaCollection('cover_art');
        }

        if ($request->audio !== null && $request->audio !== '') {
            $beatFile->syncFromMediaLibraryRequest(['audio' => $request->audio])
                ->toMediaCollection('audio');
        }

        return redirect()->back()->with('success', 'Beat files updated successfully');
    }


    public function destroy(string $id)
    {
        //
    }
}
