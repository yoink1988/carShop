<?php
namespace Models;
/**
 * Description of Orders
 *
 * @author yoink
 */
class Orders
{
    private $db;
    
    public function __construct()
    {
        $this->db = \database\Database::getInstance();
    }

    public function getOrders($id)
	{
		$query = \database\QSelect::getInstance()->setColumns('o.id, c.brand, c.model, c.year, o.payment, o.status')
												->setTable('carshop_orders o left join carshop_cars c on c.id = o.id_car')
												->setWhere("id_user = {$id}");

		return	$this->db->select($query);
    }

	public function addOrder($params)
	{
		$q = \database\QInsert::getInstance()->setTable('carshop_orders')->setParams($params);

		return $this->db->insert($q);
	}


}
