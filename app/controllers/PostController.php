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
		$this->set('title', 'Create Post');
		if (Request::isPost()) {
			if (!$this->post->validate(Request::getPost())) {
				$this->set('errors', $this->post->getErrors());
			} else {
				if($this->post->savePost(Request::getPost())) {
					Session::flash('message', 'Post was created!');
					Helper::redirect('/post');
				} else {
					Session::flash('message', 'Oops! Something went wrong!');
				}
				
			}
		}
	}

	public function actionUpdate($id)
	{
		$this->set('title', 'Update Post');
		if (empty($this->post->isOwnerPost($id, Session::get(Config::get('session.userId'))))) {
			Helper::redirect('/post');
		}
		if (Request::isPost()) {
			if(!$this->post->validate(Request::getPost())) {
				$this->set('errors', $this->post->getErrors());
			} else {
				if($this->post->savePost(Request::getPost(), $id)) {
					Session::flash('message', 'Post was updated!');
					Helper::redirect('/post');
				} else {
					Session::flash('message', 'Oops! Something went wrong');
				}
			}
		}
		$this->set('data', $this->post->getPostById($id));
	}

	public function actionIndex()
	{
		$this->set('title', 'Index');
		$this->set('posts', $this->post->getAllPosts());
	}

	public function actionMy()
	{
		$this->set('title', 'My Posts');
		$this->set('posts', $this->post->getMyPosts(Session::get(Config::get('session.userId'))));
	}

	public function actionDelete($id)
	{
		$this->set('title', 'Delete Post');
		if (empty($this->post->isOwnerPost($id, Session::get(Config::get('session.userId'))))) {
			Helper::redirect('/post');
		}
		if (Request::isPost()) {
			if($this->post->deleteRecord(['id' => $id])) {
				Session::flash('message', 'Post was deleted!');
				Helper::redirect('/post');
			} else {
				Session::flash('message', 'Oops! Something went wrong!');
			}
			
		}
		$this->set('id', $id);
	}

	public function actionError()
	{
		$this->set('title', 'Error');
	}
}
