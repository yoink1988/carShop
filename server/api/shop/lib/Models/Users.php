<?php
namespace Models;
/**
 * Description of Users
 *
 * @author yoink
 */
class Users
{
    private $db;
    public function __construct()
    {
        $this->db = \database\Database::getInstance();
    }

    public function addUser($params)
    {
		if(!\Utils\Validator::validName($params['name']))
		{
			return 'Invalid Name';
		}
		if(!\Utils\Validator::validEmail($params['login']))
		{
			return 'Invalid Email';
		}
		if(!\Utils\Validator::validPassword($params['pass']))
		{
			return 'Invalid Password';
		}

		$params['pass'] = md5($params['pass']);

        $query = \database\QInsert::getInstance()->setTable('carshop_users')
												->setParams($params);

        if($this->db->insert($query))
		{
			return true;
		}
		return false;
    }

	public function getUserData($id = null)
    {
        $query = \database\QSelect::getInstance()->setColumns('id, name, hash')
                                                ->setTable('carshop_users');
		if($id)
		{
			$id = $this->db->clearString($id);
			$query->setWhere("id = {$id}");
		}
        return $this->db->select($query);
    }
}
