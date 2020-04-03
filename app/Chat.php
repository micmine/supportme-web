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

	public function users()
	{
		return $this->belongsToMany('App\User', 'entity_chat', 'user_id', 'chat_id');
	}

	public function groups()
	{
		return $this->belongsToMany('App\Group', 'entity_chat', 'chat_id', 'group_id');
	}

	public function addUser(User $user)
	{
		return $this->users()->attach($user);
	}

	public function removeUser(User $user)
	{
		return $this->users()->detach($user);
	}

	public function addGroup(Group $group)
	{
		return $this->groups()->attach($group);
	}

	public function removeGroup(Group $group)
	{
		return $this->groups()->detach($group);
	}

	public function messages()
	{
		return $this->hasMany('App\ChatMessage');
	}

	public function getSupportLevel()
	{
		$out = 1;
		foreach ($this->groups()->get() as $group) {
			if (strpos($group->name, 'supportlevel-') === 0) {
				$out = substr($group->name, -1);
			}
		}

		return $out;
	}
}
