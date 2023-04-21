<?php

namespace App\Http\Controllers\User;

use App\Models\Chatroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\MessagePosted;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Message\MessageRepositoryInterface;

class ChatBoxController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function index()
    {
        return view('chatbox.index');
    }

    public function getMessages()
    {
        return $this->messageRepository->getMessages();
    }

    public function postMessages(Request $request)
    {
        /** @var \App\Models\User() */
        $user = Auth::user();
        $dataRequest = $request->all();

        $createMessage = $this->messageRepository->create([
            'room' => $dataRequest['room'] ?? '',
            'message' => $dataRequest['message'] ?? '',
            'user_id' => $user->id,
        ]);

        broadcast(new MessagePosted($createMessage))->toOthers();

        if ($createMessage) {
            return $createMessage->load('user');
        }

        return false;
    }

    public function chatRoom()
    {
        $data = [
            'user' => Auth::user(),
            'rooms' => Chatroom::all(),
        ];

        return view('chatbox.chat_room', [
            'data' => $data
        ]);
    }
}
