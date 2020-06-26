<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\MessagePage;
use Tests\Browser\Pages\LoginPage;
use App\User;

class MessageTest extends DuskTestCase
{
    /**
     * @test
     * Test message sending
     *
     * @return void
     */
    public function sendAndReceiveMessage()
    {
        $user = factory(User::class)->create([
			'email' => 'taylor@laravel.com',
			'password' => bcrypt('normal'),
			'name' => 'taylor'
        ]);

        $message = "This is the Message.";

		$this->browse(function (Browser $browser) use ($user) {
			$browser->visit(new LoginPage)
                ->loginUser($user->email, 'normal')
                ->visit(new MessagePage)
				->send($user, " ", "This is the Message.");
        });

        $supporter = factory(User::class)->create([
			'email' => 'jon@laravel.com',
			'password' => bcrypt('normal'),
			'name' => 'jon'
        ]);

        Group::where("name", "team")->first()->addUser($supporter);
        Group::where("name", "supportlevel-1")->first()->addUser($supporter);

        $this->browse(function (Browser $browser) use ($supporter) {
			$browser->visit(new LoginPage)
                ->loginUser($supporter->email, 'normal')
                ->visit(new MessagePage)
				->receive($supporter, 1, "This is the Message.");
        });
    }
}
