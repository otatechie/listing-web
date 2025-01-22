<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, Conversation $conversation)
    {
        // Verify user is part of conversation
        if ($conversation->sender_id !== auth()->id() &&
            $conversation->receiver_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'body' => 'required|string|max:1000'
        ]);

        $message = $conversation->messages()->create([
            'user_id' => auth()->id(),
            'body' => $validated['body']
        ]);

        return back();
    }

    public function markAsRead(Conversation $conversation)
    {
        $conversation->messages()
            ->whereNull('read_at')
            ->where('user_id', '!=', auth()->id())
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }
}
