<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Beat;
use Inertia\Inertia;
use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserBeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Check if user is a producer
        if (!$user->hasRole('producer')) {
            return redirect()->route('home')->with('error', 'Please switch to producer mode to access beats management. You can do this from your profile settings.');
        }

        $beats = $user->beats()->with(['beatFile', 'user.profile'])->get();

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
            ];
        });

        return Inertia::render('UserBeat/IndexPage', [
            'beat' => $beatsData,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        // Check if user is a producer
        if (!$user->hasRole('producer')) {
            return redirect()->route('home')->with('error', 'Please switch to producer mode to access beats management. You can do this from your profile settings.');
        }

        return Inertia::render('UserBeat/CreatePage', [
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if user is a producer
        if (!auth()->user()->hasRole('producer')) {
            return redirect()->route('home')->with('error', 'Please switch to producer mode to access beats management. You can do this from your profile settings.');
        }

        $validatedData = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('beats')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],
            'bpm' => [
                'required',
                'integer',
                'min:20',
                'max:300'
            ],
            'genre' => [
                'required',
                'string',
                Rule::in([
                    'Afrobeat',
                    'Amapiano',
                    'Hip Hop',
                    'R&B',
                    'Drill',
                    'Trap',
                    'Dancehall',
                    'Pop',
                ])
            ],
            'type' => [
                'required',
                'string',
                Rule::in([
                    'Dark',
                    'Chill',
                    'Happy',
                    'Sad',
                    'Smooth',
                    'Hard',
                    'Melodic',
                    'Club',
                ])
            ],
        ]);

        $validatedData['user_id'] = auth()->id();

        $beat = Beat::create($validatedData);

        session()->flash('success', 'Great! Beat added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Beat $beat)
    {
        $beatFile = $beat->beatFile;

        $beatData = [
            'id' => $beat->id,
            'slug' => $beat->slug,
            'title' => $beat->title,
            'genre' => $beat->genre,
            'type' => $beat->type,
            'bpm' => $beat->bpm,
            'status' => $beat->status,
            'description' => $beat->description,
            'user' => [
                'id' => $beat->user->id,
                'name' => $beat->user->name,
                'profile' => $beat->user->profile
            ],
            'media' => [
                'cover_art' => $beatFile ? $beatFile->getMedia('cover_art') : null,
                'audio' => $beatFile ? $beatFile->getMedia('audio') : null,
            ],
            'has_files' => !is_null($beatFile),
            'beatFile' => $beatFile ? ['id' => $beatFile->id] : null
        ];

        return Inertia::render('UserBeat/EditPage/EditPage', [
            'beat' => $beatData,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $beat = Beat::findOrFail($id);

        $validatedData = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('beats')->ignore($beat->id)->where('user_id', auth()->id())
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],
            'bpm' => [
                'required',
                'integer',
                'min:20',
                'max:300'
            ],
            'genre' => [
                'required',
                'string',
                Rule::in([
                    'Afrobeat',
                    'Amapiano',
                    'Hip Hop',
                    'R&B',
                    'Drill',
                    'Trap',
                    'Dancehall',
                    'Pop',
                ])
            ],
            'type' => [
                'required',
                'string',
                Rule::in([
                    'Dark',
                    'Chill',
                    'Happy',
                    'Sad',
                    'Smooth',
                    'Hard',
                    'Melodic',
                    'Club',
                ])
            ],
        ]);

        $beat->update($validatedData);

        session()->flash('success', 'Great! Beat updated successfully');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
