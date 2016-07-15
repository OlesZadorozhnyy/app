<?php

class ApiController extends Controller
{

	public $uses = ['post'];

	public function filters()
	{
		return [
			'auth' => [
				'pages' => ['posts'],
				'redirect' => '/user/login'
			]
		];
	}


	public function actionPosts()
	{
		$this->displayView = false;
		header('Content-Type: application/json');

		if (Request::isGet()) {
			$posts['data'] = $this->post->getAllPosts();
			$posts['success'] = true;
			http_response_code(200);
		} else {
			$posts['success'] = false;
			http_response_code(403);
		}
		echo Helper::toJSON($posts);
	}
}