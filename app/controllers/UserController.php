<?php

class UserController extends Controller
{

	public function filters()
	{
		return [
			'auth' => [
				'pages' => ['logout'],
				'redirect' => '/user/login'
			],
			'guest' => [
				'pages' => ['login', 'register'],
				'redirect' => '/post'
			]
		];
	}

	public function actionRegister()
	{
		if (Request::isPost()) {
			$this->user->scenario = 'register';
			if (!$this->user->validate(Request::getPost())) {
				$this->set('errors', $this->user->getErrors());
			} else {
				if($this->user->save([
					'username' => Request::input('username'), 
					'email' => Request::input('email'),
					'password' => Helper::hash(Request::input('password'))
				])) {
					Session::flash('message', 'Congratulations! You have been registered!');
					Helper::redirect('/user/login');
				} else {
					Session::flash('message', 'Oops! Something went wrong!');
				}
				
			}
		}
	}

	public function actionLogin()
	{
		if(Request::isPost()) {
			$this->user->scenario = 'auth';
			if (!$this->user->validate(Request::getPost())) {
				$this->set('errors', $this->user->getErrors());
			} else {
				echo '1';
				if ($this->user->auth(Request::input('login'), Request::input('password'))) {
					Helper::redirect('/post');
				} else {
					Session::flash('message', 'Incorrect values');
				}
			}
		}
		
	}

	public function actionLogOut()
	{
		Session::delete(Config::get('session.userId'));
		Session::flash('message', 'Thanks for visiting!');
		Helper::redirect('/user/login');
	}
}
