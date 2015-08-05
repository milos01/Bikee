<?php

class ExampleTest extends TestCase {

	public function test_show_home_page()
	{
		$resposne = $this->call('GET', '/');
		$this->assertTrue(strpos($resposne->getContent(),'Sisms projekat') !== false);
	}
	public function test_user_page(){
		$response = $this->call('POST', '/user/login');
		$this->assertRedirectedTo('/user');
		// var_dump($response->getContent());
	}

}
