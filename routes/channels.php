<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('Chat.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


