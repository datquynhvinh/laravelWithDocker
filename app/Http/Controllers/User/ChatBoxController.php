<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
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
        $user = Auth::user();
        $dataRequest = $request->all();

        $createMessage = $this->messageRepository->create([
            'message' => $dataRequest['message'],
            'user_id' => $user->id,
        ]);

        if ($createMessage) {
            return $createMessage->load('user');
        }

        return false;
    }
}
