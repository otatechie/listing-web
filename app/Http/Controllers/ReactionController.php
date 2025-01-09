<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function addOrUpdateReaction(Request $request)
    {
        $user = auth()->user();
        $beatId = $request->input('beat_id');
        $reactionType = $request->input('reaction_type');

        // Update or create the reaction
        Reaction::updateOrCreate(
            ['user_id' => $user->id, 'beat_id' => $beatId],
            ['reaction_type' => $reactionType]
        );

        // Fetch updated reaction counts
        $reactionCounts = Reaction::where('beat_id', $beatId)
            ->select('reaction_type')
            ->selectRaw('count(*) as count')
            ->groupBy('reaction_type')
            ->pluck('count', 'reaction_type')
            ->toArray();
    }
}
