<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\LoginPage;

class LoginTest extends DuskTestCase
{
	use DatabaseMigrations;
	/**
	 * @test test login by creating user
	 *
	 * @return void
	 */
	public function loginWithUser()
	{
		$user = factory(User::class)->create([
			'email' => 'taylor@laravel.com',
			'password' => bcrypt('normal'),
			'name' => 'taylor'
		]);

		$this->browse(function (Browser $browser) use ($user) {
			$browser->visit(new LoginPage)
				->loginUser($user->email, 'normal')
				->assertPathIs('/');
		});
	}

	public function testloginRequired()
	{
		$this->browse(function ($browser) {
			$browser->visit('/')
				->waitForText('Login')
				->assertPathIs('/login');
		});
	}
}
