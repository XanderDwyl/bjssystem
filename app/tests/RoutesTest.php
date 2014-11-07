<?php

class RoutesTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testRoutes()
	{
		$crawler = $this->client->request('GET', '/login');
		$this->assertTrue($this->client->getResponse()->isOk());
	}

}
