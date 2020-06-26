<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class MessagePage extends Page
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

	public function send(Browser $browser, $chat = null, $message = null) {
        $browser->visit('/chat')
            ->screenshot('help')
            ->type('@message', $message)
			->press('send');
    }

    public function receive(Browser $browser, $chat = null , $message = null) {
        $browser->visit('/chat/' . $chat)
            ->assertSee($message);
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
			'@message' => 'input[name="message"]'
		];
	}
}
