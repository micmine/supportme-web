<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	public function users()
	{
		return $this->belongsToMany(User::class);
	}

	public function addUser(User $user)
	{
		return $this->users()->attach($user);
	}

	public function removeUser(User $user)
	{
		return $this->users()->detach($user);
	}

	public function chats()
	{
		return $this->belongsToMany('App\Chat', 'entity_chat', 'group_id', 'chat_id');
	}
}
