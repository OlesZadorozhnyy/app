<?php

class PostController extends Controller
{

	public function filters()
	{
		return [
			'auth' => [
				'pages' => ['create', 'update', 'index', 'my', 'delete'],
				'redirect' => '/user/login'
			]
		];
	}

	public function actionCreate()
	{
		if (Request::isPost()) {
			if (!$this->post->validate(Request::getPost())) {
				$this->set('errors', $this->post->getErrors());
			} else {
				$dataForSave = ['user_id' => Session::get(Config::get('session.sessionName') . '.' . Config::get('session.user_id'))];
				$dataForSave = array_merge(Helper::setData(['title', 'body', 'lat', 'lng']), $dataForSave);
				$this->post->save($dataForSave);
				Session::flash('message', 'Post was created!');
				Helper::redirect('/post');
			}
		}
	}

	public function actionUpdate($id)
	{
		if (Request::isPost()) {
			if(!$this->post->validate(Request::getPost())) {
				$this->set('errors', $this->post->getErrors());
			} else {
				$dataForSave = ['user_id' => Session::get(Config::get('session.sessionName') . '.' . Config::get('session.user_id'))];
				$dataForSave = array_merge(Helper::setData(['title', 'body', 'lat', 'lng']), $dataForSave);
				$this->post->save(
					$dataForSave, 
					[
						'id' => $id, 
						'user_id' => Session::get(Config::get('session.sessionName') . '.' . Config::get('session.user_id'))
					]
				);
				Session::flash('message', 'Post was updated!');
				Helper::redirect('/post');
			}
		}
		$this->set('data', $this->post->getPostById($id));
		$this->set('id', $id);
	}

	public function actionIndex()
	{
		$this->set('posts', $this->post->getAllPosts());
	}

	public function actionMy()
	{
		$this->set('posts', $this->post->getMyPosts(Session::get(Config::get('session.sessionName') . '.' . Config::get('session.user_id'))));
	}

	public function actionDelete($id)
	{
		if (Request::isPost()) {
			$this->post->deleteRecord(['id' => $id, 'user_id' => Session::get(Config::get('session.sessionName') . '.' . Config::get('session.user_id'))]);
			Session::flash('message', 'Post was deleted!');
			Helper::redirect('/post');
		}
		$this->set('id', $id);
	}

	public function actionError()
	{
		
	}
}
