<?php
namespace database;
/**
 * Description of QSelect
 *
 * @author yoink
 */
class QSelect extends \database\Query
{
	public static function getInstance()
	{
		return new self;
	}

	public function getQueryString()
	{
		$query = 'select ' .$this->columns. ' from ' . "{$this->table} ";
		if($this->join)
		{
			$query .= "{$this->join} ";
		}
		if($this->where)
		{
			if(is_string($this->where)){
				$query .= "where {$this->where}";
			}
//			if(is_array($this->where))
//			{
//				$query .= "where ";
//				foreach ($this->where as $k => $v)
//				{
//					$query .= "`{$k}` = '{$v}', ";
//				}
//				$query = substr($query, 0, -2);
//			}
		}
		if($this->order)
		{
			$query .= " order by {$this->order} ";
		}
		if(is_bool($this->sortAsc))
		{
			$query .= ($this->sortAsc) ? ' asc' : ' desc';
		}
		if($this->limit)
		{
			$query .= " limit {$this->limit}";
		}
		
		return $query;
    }
}
