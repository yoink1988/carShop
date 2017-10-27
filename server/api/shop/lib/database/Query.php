<?php
namespace database;
/**
 * Description of Query
 *
 * @author yoink
 */
abstract class Query
{
	protected $table = '';
	protected $where = '';
	protected $columns = '';
	protected $join = '';
	protected $limit = null;
	protected $order = '';
	protected $sortAsc = null;
	protected $params = array();

	public function setTable($table)
	{
		$this->table = $table;
		return $this;
	}
	public function setWhere($where)
	{
		$this->where = $where;
		return $this;
	}
	public function setColumns($columns)
	{
		$this->columns = $columns;
		return $this;
	}
	public function setjoin($join)
	{
		$this->join = $join;
		return $this;
	}
	public function setOrder($order)
	{
		$this->order = $order;
		return $this;
	}
	public function setAsc()
	{
		$this->sortAsc = true;
		return $this;
	}
	public function setDesc()
	{
		$this->sortAsc = false;
		return $this;
	}
	public function setParams(array $params)
	{
		$this->params = $params;
		return $this;
	}
	public function setLimit($limit)
	{
		$this->limit = $limit; 
		return $this;
	}

	abstract public function getQueryString();
}
