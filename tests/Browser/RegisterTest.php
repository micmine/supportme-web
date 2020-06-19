<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\RegisterPage;

class RegisterTest extends DuskTestCase
{
	use DatabaseMigrations;
	/**
	 * @test register a new User
	 *
	 * @return void
	 */
	public function register()
	{
		$user = factory(User::class)->create([
			'email' => 'taylor@laravel.com',
			'password' => bcrypt('normal'),
			'name' => 'taylor'
		]);

		$this->browse(function (Browser $browser) use ($user) {
			$browser->visit(new RegisterPage)
                ->register("hans" ,"hans@gmail.com" , 'oiuhgiuerh33goweiruhgergo8743z87zhk')
                ->screenshot("after_register")
                ->waitForText('hans@gmail.com')
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
