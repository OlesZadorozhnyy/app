<?php

class Model extends Table
{

	protected $tableName;

	public $validationRules = [];

	public $scenarios = [];

	public function validate($post = [])
	{
		$rules = $this->validationRules;
		$scenario = $this->scenario;
		if (array_key_exists($scenario, $rules)) {		
			foreach ($post as $key => $value) {
				foreach ($rules[$scenario] as $ruleName => $rule) {
					foreach ($rule as $ruleMethod => $ruleValue) {
						if ($key === $ruleName) {
							if (in_array($ruleMethod, Validation::getRequiresInstances())) {
								Validation::$ruleMethod($key, $value, $ruleValue, $this);
							} else {
								Validation::$ruleMethod($key, $value, $ruleValue);
							}
							
						}
					}
				}
			}
		}
	
		return Validation::getResult();
	}

	public function save($data = [], $where = [])
	{
		if (empty($where)) {
			return $this->insert($this->tableName, $data);
		} else {
			return $this->update($this->tableName, $data, $where);
		}
	}

	public function deleteRecord($params = [])
	{
		return $this->delete($this->tableName, $params);
	}

	public function find($columns = null, $params = [], $join = [])
	{
		if (empty($params)) {
			return $this->getAll($this->tableName, $columns, $join);
		} else {
			return $this->get($this->tableName, $columns, $join, $params);
		}
		
	}

	public function findById($id)
	{
		return $this->get($this->tableName, null, null, ['id' => $id])[0];
	}

	public function getTable()
	{
		return $this->tableName;
	}

	public function getErrors()
	{
		return Validation::getErrors();
	}
}