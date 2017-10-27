<?php
namespace Controllers;
/**
 * Description of Orders
 *
 * @author yoink
 */
class Orders
{
    private $model;
    
    public function __construct()
    {
        $this->model = new \Models\Orders();
    }

    public function getOrders(array $params)
    {
		if(\Models\Auth::isUser())
		{
			return $this->model->getOrders($params['id']);
		}
		else
		{
			throw new \Exception(403);
		}
    }

	public function postOrders(array $params)
	{
		if(count($params) == 3)
		{
			return $this->model->addOrder($params);
		}
	}
}
