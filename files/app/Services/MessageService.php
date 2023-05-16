<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{

    public function getMessage($id)
    {
        return Message::find($id);
    }

    public function getMessages()
    {
        return Message::all();
    }

    public function save($data)
    {
        $message = new Message;
        $message->name = $data['name'];
        $message->title = $data['title'];
        $message->email = $data['email'];
        if(isset($data['phone'])) $message->phone = $data['phone'];
        $message->content = $data['content'];
        $message->save();
        return $message;
    }
}