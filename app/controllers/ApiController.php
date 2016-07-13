<?php

class ApiController extends Controller
{

	public $uses = ['post'];

	public function actionPosts()
	{
		$this->displayView = false;

		$posts['data'] = $this->post->getAllPosts();
		$posts['status'] = http_response_code();
		
		header('Content-Type: application/json');
		echo Helper::toJSON($posts);
	}
}