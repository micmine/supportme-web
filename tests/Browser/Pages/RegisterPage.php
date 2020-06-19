<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class RegisterPage extends Page
{
	/**
	 * Get the URL for the page.
	 *
	 * @return string
	 */
	public function url()
	{
		return '/register';
	}

	public function register(Browser $browser,$name = null , $email = null, $password = null) {
        $browser->type('@name', $name)
            ->type('@email', $email)
			->screenshot('after_typing_email')
            ->type('@password', $password)
            ->type('@passwordConfirm', $password)
			->press('Register');
	}

	/**
	 * Assert that the browser is on the page.
	 *
	 * @param  \Laravel\Dusk\Browser  $browser
	 * @return void
	 */
	public function assert(Browser $browser)
	{
		//
	}

	/**
	 * Get the element shortcuts for the page.
	 *
	 * @return array
	 */
	public function elements()
	{
		return [
            '@name' => 'input[name="name"]',
			'@email' => 'input[name="email"]',
            '@password' => '#password',
            '@passwordConfirm' => '#password-confirm'
		];
	}
}
