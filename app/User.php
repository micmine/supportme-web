<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    public function groups() {
        return $this->belongsToMany('App\Group', 'user_group', 'group_id', 'user_id');
    }

    public function chats() {
        $user_chat = $this->belongsToMany('App\Chat', 'entity_chat', 'user_id', 'id');
        $group_chat = collect();

        $groups = $this->groups();

        foreach ($groups as $group) {
            $chats = $group->chats();

            $group_chat = $group_chat->merge($chats);
        }

        return $user_chat->merge($group_chat)->all();
    }

    public function isUser() {
        return $this->groups()->where('name', 'user')->exists();
    }
}
