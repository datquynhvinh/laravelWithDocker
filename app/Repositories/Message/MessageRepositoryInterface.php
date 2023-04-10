<?php
namespace App\Repositories\Message;

use App\Repositories\RepositoryInterface;

interface MessageRepositoryInterface extends RepositoryInterface {
    public function getMessages();
}
