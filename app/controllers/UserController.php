<?php

class UserController extends Controller
{

	public function actionRegister()
	{

	}

	public function actionLogin()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (!$this->user->validate($_POST)) {
				$this->set('errors', $this->user->getErrors());
			}
		}
		
	}

	public function actionLogOut()
	{

	}
}
