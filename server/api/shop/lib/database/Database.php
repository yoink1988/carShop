<?php
namespace database;
/**
 * Description of Database
 *
 * @author yoink
 */
class Database
{
	private $pdo = null;
	private static $instance = null;

	private function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public static function getInstance()
	{
		if (self::$instance instanceof self)
		{
			return self::$instance;
		}

		$pdo = new \PDO(DB_HOST,DB_USER,DB_PWD, array(
				\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
				\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC));
		return self::$instance = new self($pdo);
	}

	/**
	 *
	 * @param \database\QSelect $query
	 */
	public function select(\database\QSelect $query)
	{
		if(!$stmt = $this->pdo->query($query->getQueryString()))
		{
			echo $this->getError();
		}
		$result = array();
		if ($stmt instanceof \PDOStatement)
		{
			foreach ($stmt as $row)
			{
				$result[] = $row;
			}
		}

		return $result;
	}
	
	public function insert(\database\QInsert $query)
	{
		$res = $this->pdo->exec($query->getQueryString());
		return $res !== false;
	}
	
	public function delete(\database\QDelete $query)
	{
		$res = $this->pdo->exec($query->getQueryString());
		return $res !== false;
	}


	/**
	 *
	 * @param \database\QUpdate $query
	 */
	public function update(\database\QUpdate $query)
	{
		$res = $this->pdo->exec($query->getQueryString());
		return $res !== false;
	}



	public function getError()
	{
		$errInfo = $this->pdo->errorInfo();

		if ($errInfo[2])
		{
			return "$errInfo[2]";
		}
		return '';
    }

	/**
	 *
	 * @param  $str
	 */
    public function clearString($str)
    {
        return $this->pdo->quote($str);
    }

	public function clearParams(array $params)
	{
		$cleared = [];
		foreach ($params as $k => $v)
		{
			$cleared[$k] = $this->pdo->quote($v);
		}
		return $cleared;
	}

	public function getLastInsertID()
	{
		return $this->pdo->lastInsertId();
	}
	
}
