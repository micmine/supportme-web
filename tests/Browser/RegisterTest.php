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
		$this->browse(function (Browser $browser) {
			$browser->visit(new RegisterPage)
                ->register("hans" ,"hans@gmail.com" , 'oiuhgiuerh33goweiruhgergo8743z87zhk')
                ->screenshot("after_register")
                ->waitForText('hans')
                ->assertPathIs('/chat');
		});
	}
}
