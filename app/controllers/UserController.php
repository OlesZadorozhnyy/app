<?php

class UserController extends Controller
{

	public function actionRegister()
	{
		if (Request::post()) {
			if (!$this->user->validate(Request::all())) {
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
		if(Request::post()) {
			if (!$this->user->validate(Request::all(), $this->user->authRules())) {
				$this->set('errors', $this->user->getErrors());
			} else {
				$user = $this->user->auth(Request::input('login'), Helper::hash(Request::input('password')));
				if ($user) {
					Session::set('user.id', $user[0]['id']);
					Session::set('user.username', $user[0]['username']);
					Session::set('user.email', $user[0]['email']);
				}
			}
		}
		
	}

	public function actionLogOut()
	{
		Session::delete('user');
		Helper::redirect('/user/login');
	}
}
