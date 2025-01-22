<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['messages', 'sender', 'receiver', 'device'])
            ->latest()
            ->get();

        return inertia('Messages/Index', [
            'conversations' => $conversations
        ]);
    }

    public function show(Conversation $conversation)
    {
        // Authorize user is part of conversation
        if (
            $conversation->sender_id !== auth()->id() &&
            $conversation->receiver_id !== auth()->id()
        ) {
            abort(403);
        }

        return inertia('Messages/Show', [
            'conversation' => $conversation->load(['messages', 'sender', 'receiver', 'device'])
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'mobile_device_id' => 'nullable|exists:mobile_devices,id'
        ]);

        // Check if conversation exists
        $conversation = Conversation::where(function ($query) use ($validated) {
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $validated['receiver_id']);
        })->orWhere(function ($query) use ($validated) {
            $query->where('sender_id', $validated['receiver_id'])
                ->where('receiver_id', auth()->id());
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $validated['receiver_id'],
                'mobile_device_id' => $validated['mobile_device_id']
            ]);
        }

        return redirect()->route('conversations.show', $conversation);
    }
}
