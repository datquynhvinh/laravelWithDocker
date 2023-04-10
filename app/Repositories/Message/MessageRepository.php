<?php
namespace App\Repositories\Message;

use App\Models\Message;
use App\Repositories\BaseRepository;
use App\Repositories\Message\MessageRepositoryInterface;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface {
    public function getModel() {
        return Message::class;
    }

    public function getMessages() {
        return $this->model->with('user')->get();
    }
}
