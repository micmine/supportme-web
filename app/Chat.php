<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    /**
    * Get the route key for the model.
    *
    * @return string
    */
    public function getRouteKeyName()
    {
        return 'id';
    }

    protected $fillable = array('name');

    public function users() {
        return $this->belongsToMany('App\User', 'entity_chat', 'user_id', 'chat_id');
    }

    public function addUser(User $user) {
        return $this->users()->attach($user);
    }

    public function removeUser(User $user) {
        return $this->users()->detach($user);
    }

    public function messages() {
        return $this->hasMany(ChatMessage::class, 'chat_id', 'id');
    }

}
