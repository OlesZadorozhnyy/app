<?php 

class Table
{
	private $db;

	public function __construct()
	{
		$driver = Config::get('database.driver');
		$this->db = new $driver;
	}

	public function get($table, $where = [], $orderBy = null, $limit = null)
	{
		$sql = "SELECT * FROM " . $table;
		$result = [];

		foreach ($where as $key => $whereItem) {
			if (!is_numeric($key)) {
				$result['query'][] = $key . ' = ?';
				$result['params'][] = $whereItem;
			} else {
				$result['query'][] = $whereItem;
			}
		}

		$wheres = implode(' AND ', $result['query']);

		$sql .= " WHERE " . $wheres;

		if (count($orderBy) && is_array($orderBy)) {
			foreach ($orderBy as $key => $orderByItem) {
				$result['orders'][] = $key . " " . $orderByItem;
			}
			$orders = implode('', $result['orders']);
			$sql .= " ORDER BY " .$orders;
		}

		if (isset($limit) && is_numeric($limit)) {
			$sql .= " LIMIT " . $limit;
		}

		$this->db->executeQuery($sql, $result['params']);

		return $this->db->getResults();

	} 

	public function getAll($table)
	{
		$sql = "SELECT * FROM " . $table;
		$this->db->executeQuery($sql, null);
		return $this->db->getResults();
	}

	public function insert($table, $data = [])
	{
		$params = $values = $column = [];

		foreach ($data as $column_name => $value) {
			$column[] = $column_name;
			$values[] = "?";
			$params[] = $value;
		}

		$keys = implode(', ', array_values($column));
		$values = implode(', ', array_values($values));

		$sql = "INSERT INTO " . $table . " (" . $keys . ") VALUES (" . $values . ")";

		if ($this->db->executeQuery($sql, $params)) {
			return true;
		} else {
			return false;
		}
	}

	public function update($table, $data = [], $where = [])
	{
		$sql = "UPDATE " . $table . " SET ";

		$set = $values = null;

		foreach ($data as $column_name => $value) {
			if($set) {
				$set .= ', ' . $column_name . '=?';
			} else {
				$set = $column_name . '=?';
			}
			$params[] = $value;
		}
        
		foreach ($where as $key => $value) {
			if ($values) {
				$values .= ', ' . $key . '=?';
			} else {
				$values = $key . '=?';
			}
			$params[] = $value;
		}

		$sql .= $set . " WHERE " . $values;

		if ($this->db->executeQuery($sql, $params)) {
			return true;
		} else {
			return false;
		}
	}

	public function delete($table, $where = [])
	{
		$sql = "DELETE FROM " . $table;

		$result = [];
		foreach ($where as $key => $whereItem) {
			if (!is_numeric($key)) {
				$result['query'][] = $key . '= ?';
				$result['params'][] = $whereItem;
			} else {
				$result['query'][] = $whereItem;
			}
		}
		$wheres = implode(' AND ', $result['query']);

		$sql .= " WHERE " . $wheres;

		if ($this->db->executeQuery($sql, $result['params'])) {
			return true;
		} else {
			return false;
		}
	}
}
