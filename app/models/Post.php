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

	public function saveData($params = [], $where = [])
	{
		$data = [];
		$result = [];
		foreach ($params as $key => $param) {
			if (is_numeric($key)) {
				$data[] = $param;
			} else {
				$result[$key] = $param;
			}
		}
		$result = array_merge(Helper::setData($data), $result);
		return $this->save($result, $where);	
	}
}