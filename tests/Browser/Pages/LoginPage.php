<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class LoginPage extends Page
{
	/**
	 * Get the URL for the page.
	 *
	 * @return string
	 */
	public function url()
	{
		return '/login';
	}

	public function loginUser(Browser $browser, $email = null, $password = null) {
		$browser->type('@email', $email)
			->screenshot('after_typing_email')
			->type('@password', $password)
			->press('Login');
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
			'@email' => 'input[name="email"]',
			'@password' => '#password'
		];
	}
}
