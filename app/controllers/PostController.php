<?php

class PostController extends Controller
{

	public function filters()
	{
		return [
			'auth' => [
				'pages' => ['create', 'update', 'index'],
				'redirect' => '/user/login'
			]
		];
	}

	public function actionCreate()
	{

	}

	public function actionUpdate()
	{

	}

	public function actionIndex()
	{
		
	}

	public function actionError()
	{
		
	}
}
