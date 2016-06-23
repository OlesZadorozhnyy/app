<?php

class MySQLDriver implements DatabaseInterface
{
	private static $instance = null;

	private $query;
	private $result;

	public function __construct()
	{
		$this->connect();
	}

	public function connect()
	{
		if (!isset(self::$instance)) {
			$host = Config::get('database.host');
			$user = Config::get('database.user');
			$password = Config::get('database.password');
			$db = Config::get('database.dbname');
			self::$instance = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';', $user, $password); 	
		}
		return self::$instance;
	}

	public function executeQuery($sql, $params = [])
	{
		$this->query = self::$instance->prepare($sql);

		if (count($params)) {
			$number = 1;
			foreach ($params as $key => $param) {
				$this->query->bindValue($number, $param);
				$number++;
			}

			if ($this->query->execute()) {
				$this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);
			}
		}
		return $this;
	}

	public function getResults()
	{
		return $this->result;
	}

	public function getFirst()
	{
		return $this->result[0];
	}

	public function disconnect()
	{
		self::$instance = null;
	}
}
