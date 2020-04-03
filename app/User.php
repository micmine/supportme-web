<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function groups()
	{
		return $this->belongsToMany(Group::class);
	}

	public function chats()
	{
		$chats = collect();
		//ddd(Auth::user()->chats()->get());
		foreach ($this->belongsToMany('App\Chat', 'entity_chat', 'chat_id', 'user_id')->get() as $chat) {
			$chats->push($chat);
		}


		foreach ($this->groups()->get() as $group) {
			foreach ($group->chats()->get() as $chat) {
				$chats->push($chat);
			}
		}


		return $chats;
		//	return $this->belongsToMany('App\Chat', 'entity_chat', 'user_id', 'id');
	}

	public function isUser()
	{
		return !$this->groups()->where('name', 'team')->exists();
	}
}
