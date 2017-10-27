<?php
namespace Controllers;

/**
 * Description of Authors
 *
 * @author yoink
 */
class Cars
{
	public $model;

	public function __construct()
	{
		$this->model = new \Models\Cars();
	}

	public function getCars($params=null)
	{
		return $this->model->getCars($params);
	}
}
