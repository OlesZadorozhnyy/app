<?php

class Post extends Model
{

	protected $tableName = 'post';

	public $scenario = 'post';
	
	public $validationRules = [
		'post' => [
			'title' => [
				'required' => true,
				'max' => 100
			],
			'body' => [
				'required' => true,
				'max' => 255
			],
			'lat' => [
				'required' => true,
				'numeric' => true
			],
			'lng' => [
				'required' => true,
				'numeric' => true
			]
		]
	];

	public function getAllPosts()
	{
		return $this->find();
	}

	public function getMyPosts($id)
	{
		return $this->find(['user_id' => $id]);
	}

	public function isOwnerPost($id, $userId)
	{
		return $this->find(['id' => $id, 'user_id' => $userId]);
	}

	public function getPostById($id)
	{
		return $this->findById($id);
	}

	public function savePost($post, $id = null)
	{
		$where = [];
		if($id) {
			$where = ['id' => $id];
		} else {
			$post['user_id'] = Session::get(Config::get('session.userId'));
		}
		return $this->save($post, $where);
	}
}