<?php
namespace Models;
/**
 * Description of Auth
 *
 * @author yoink
 */
class Auth
{

    private $db;
    public function __construct()
    {
        $this->db = \database\Database::getInstance();
    }

	public function checkLogData($params)
	{
		if(!\Utils\Validator::validEmail($params['login']))
		{
			return false;
		}

		if(!\Utils\Validator::validPassword($params['pass']))
		{
			return false;
		}

		$q = \database\QSelect::getInstance()->setColumns('pass')
												->setTable('carshop_users')
												->setWhere("login = {$this->db->clearString($params['login'])}");

		if($res = $this->db->select($q))
		{
			if($res[0]['pass'] == md5($params['pass']))
			{
				return true;
			}
		}
		return false;
	}

	public function login($params)
	{
		$params['hash'] = $this->generateHash();

		$q = \database\QUpdate::getInstance()->setTable('carshop_users')->setParams(array('hash' => "{$params['hash']}"))
																->setWhere("login = {$this->db->clearString($params['login'])}");
					

		if($res = $this->db->update($q))
		{
			$q = \database\QSelect::getInstance()->setColumns('id, name, hash')->setTable('carshop_users')
												->setWhere("login = {$this->db->clearString($params['login'])} "
												. "and pass = {$this->db->clearString(md5($params['pass']))}");

			return $this->db->select($q);
		}
		return false;
	}

	public function checkAuth($params)
	{
		$q = \database\QSelect::getInstance()->setColumns('name')->setTable('carshop_users')
											->setWhere("id = {$this->db->clearString($params['id'])}"
											. " and hash = {$this->db->clearString($params['hash'])}");

		if($res = $this->db->select($q))
		{
			return true;
		}
		return false;
	}

	private function generateHash($length=10)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length)
        {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }

	public static function isUser()
	{

		$db = \database\Database::getInstance();

		$id = $db->clearString($_SERVER['PHP_AUTH_USER']);
		$hash = $_SERVER['PHP_AUTH_PW'];


		$q = \database\QSelect::getInstance()->setTable('carshop_users')->setColumns('hash')
											->setWhere("id = {$id}");
		$res = $db->select($q);
		if($hash == $res[0]['hash'])
		{
			return true;
		}
		return false;
	}

}
