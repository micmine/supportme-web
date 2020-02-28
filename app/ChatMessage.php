<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    public function chat() {
        return $this->belongsTo('App\Chat');
    }
}
