<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function users() {
        return $this->belongsToMany('App\User', 'user_chat', 'user_id', 'chat_id');
    }

    public function messages() {
        return $this->hasMany(ChatMessage::class, 'chat_id', 'id');
    }

}
