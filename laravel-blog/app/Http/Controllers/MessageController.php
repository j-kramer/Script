<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Database\Eloquent\Builder;

use App\Models\User;

class MessageController extends Controller
{
    /**
     * Display a listing of the conversations.
     */
    public function index()
    {
        /*
         * we need to get a list of:
         * - users who we send a message
         * - users who send us a message
         * while including
         * - the count of unread messages
         * - id and names of the users
         */

        $users = User::select(['id', 'name'])->paginate(20);

        $messages = Message::select(['sender_id',
                                     'receiver_id',
                                     'is_read',
                                    ])
                            ->where('sender_id', Auth::id())
                           ->orWhere('receiver_id', Auth::id())
                           ->orderBy('sender_id')
                           ->with(['sender:id,name','receiver:id,name'])
                           ->get();

        $conversations = [];
        foreach ($messages as $message) {
            $unread = $message->is_read ? 0 : 1;
            if ($message->sender_id == Auth::id()) {
                $id = $message->receiver_id;
                $name = $message->receiver->name;
                // sent messages is to someone else, ignore is_read
                if ($id != Auth::id()) {
                    $unread = 0;
                }
            } else {
                $id = $message->sender_id;
                $name = $message->sender->name;
            }

            if (isset($conversations[$id])) {
                $conversations[$id]['unread'] += $unread;
            } else {
                $conversations[$id] = [
                    'name' => $name,
                    'unread' => $unread,
                ];
            }
        }

        return view('conversations.overview', [
            'users' => $users,
            'conversations' => $conversations,
        ]);
    }

    /**
     * Display a conversation.
     */
    public function show(User $user)
    {
        $messages = Message::where(function (Builder $query) use ($user) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $user->id);
        })->orWhere(function (Builder $query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', Auth::id());
        })->get();

        Message::where('sender_id', $user->id)
               ->where('receiver_id', Auth::id())
               ->unread()
               ->update(['is_read' => true]);

        return view('conversations.conversation', [
            'messages' => $messages,
            'other' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request, User $user)
    {
        $validated = $request->validated();

        $message = $request->user()->sentMessages()->make($validated);
        $message->receiver_id = $user->id;
        $message->save();

        return redirect()->back();
    }
}
