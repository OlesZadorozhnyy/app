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
			'noAuth' => [
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
				$this->user->save([
					'username' => Request::input('username'), 
					'email' => Request::input('email'),
					'password' => Helper::hash(Request::input('password'))
				]);
				Session::flash('message', 'Congratulations! You have been registered!');
				Helper::redirect('/user/login');
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
				$user = $this->user->auth(Request::input('login'), Request::input('password'));
				if ($user) {
					Session::set('user.id', $user[0]['id']);
					Helper::redirect('/post');
				} else {
					Session::flash('message', 'Incorrect values');
				}
			}
		}
		
	}

	public function actionLogOut()
	{
		Session::delete('user');
		Session::flash('message', 'Thanks for visiting!');
		Helper::redirect('/user/login');
	}
}
