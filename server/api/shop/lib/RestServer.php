<?php

/**
 * Description of RestServer
 *
 * @author yoink
 */
class RestServer
{
	private $args = null;
	private $responseType = null;
	public function __construct()
	{
		$this->url = $_SERVER['REQUEST_URI'];
		$this->reqMeth = $_SERVER['REQUEST_METHOD'];
	}

	public function run()
	{
		$this->parseUrl();
		if(class_exists($this->class))
		{
			$controller = new $this->class;
			switch ($this->reqMeth)
            {
                case 'GET':
                case 'DELETE':
                    $this->execMethod($controller, $this->func, $this->args);
                    break;
                case 'POST':
                case 'PUT':
					$this->args = $this->getArgs();
                    $this->execMethod($controller, $this->func, $this->args);
                    break;
            }
		}
		else
		{
			throw new \Exception('405');
		}

	}

	private function execMethod($class, $method, $param = null)
    {
        if (method_exists($class, $method))
        {
            if($res = $class->$method($param))
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse($res, $this->responseType);
			}
			else
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse(false, $this->responseType);
			}
        }
		else
		{
			throw new \Exception('405');
		}
	}

	public function parseUrl()
	{
		$arrayUrl = explode('/api/', $this->url);
        $this->class = '\Controllers\\'.ucfirst(array_shift(explode('/', $arrayUrl[1])));
		$this->func = strtolower($this->reqMeth).ucfirst(array_shift(explode('/', $arrayUrl[1])));

		$string = $arrayUrl[1];

		if(strripos($string, '.'))
        {
            $this->responseType = array_pop(explode('.', $string));
			$string = array_shift(explode('.', $string));
        }
        else
        {
            $this->responseType = DEFAULT_OUTPUT;
        }

		if(substr("$string",-1) == '/')
		{
			$string = substr("$string", 0, -1);
		}

		$args = explode('/', $string);
		array_shift($args);
		if($args)
		{
			if($args[0] !== "")
			{
				$argPare = array_chunk($args, 2);
				if((count($args) % 2) == 0)
				{
					foreach($argPare as $pair)
					{
						$arg[$pair[0]] = $pair[1];
						$this->args = $arg;
					}
				}
				else
				{
					if((int)$args[0])
					{
						$this->args['id'] = $args[0];
					}
					else
					{
						throw new \Exception(400);
					}
				}
			}
		}
	}
	private function getArgs()
    {
		return json_decode(file_get_contents("php://input"), true);
    }
}
