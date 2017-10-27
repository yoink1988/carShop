<?php
namespace Models;

/**
 * Description of Authors
 *
 * @author yoink
 */
class Cars
{
	private $db;

	public function __construct()
	{
		$this->db = \database\Database::getInstance();
	}

    public function getCars($params=null)
    {
		$query = \database\QSelect::getInstance()->setColumns('id, model, brand, year, motor, speed, color, price')
												->setTable('carshop_cars');

		if($params)
        {
			$where = '';
			foreach($params as $k => $v)
			{
				$where .="`$k` = '$v' and ";
			}
			$where = substr($where, 0, -5);
			
			$query->setWhere($where);
        }
        return $this->db->select($query);
    }
}
