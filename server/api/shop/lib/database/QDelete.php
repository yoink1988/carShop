<?php
namespace database;
/**
 * Description of QDelete
 *
 * @author yoink
 */
class QDelete extends \database\Query
{
	public static function getInstance()
	{
		return new self();
	}

	
	public function getQueryString()
	{
		$query = '';
		$query .= 'delete from ' . "{$this->table} ";

		if ($this->where)
		{
			$query .= " where {$this->where}";
		}
		else
		{
			//sorry no where - no delete
			return '';
		}

		if ($this->limit)
		{
			$query .= " limit {$this->limit}";
		}

		return $query;
	}
}
