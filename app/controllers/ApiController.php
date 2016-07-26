<?php

class ApiController extends Controller
{

	public $uses = ['post'];


	public function actionPosts()
	{
		$this->displayView = false;
		header('Content-Type: application/json');

		if (!Request::isAjax() && !Request::isGet()) {
			Helper::responseCode(500);
			$posts['error'] = 'Internal server error';
		} elseif (!Session::exists(Config::get('session.userId'))) {
			Helper::responseCode(403);
			$posts['error'] = 'Permission denied';
		} elseif ((Request::isGet() && Session::exists(Config::get('session.userId'))) || Request::isAjax()) {
			Helper::responseCode(200);
			$posts['posts'] = $this->post->getAllPostsWithCreator();
		} else {
			Helper::responseCode(500);
			$posts['error'] = 'Unexpected error';
		}

		echo Helper::toJSON($posts);
	}
}