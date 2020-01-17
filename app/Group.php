<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function users() {
        return $this->belongsToMany('App\User', 'user_group', 'user_id', 'group_id');
    }

    public function addUser(User $user) {
        return $this->users()->attach($user);
    }

    public function removeUser(User $user) {
        return $this->users()->detach($user);
    }
}
