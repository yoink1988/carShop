<?php
include_once 'lib/config.php';
include_once 'lib/functions.php';

spl_autoload_register('autoload');

try{
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Credentials: true');

    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE');
    header('Access-Control-Allow-Headers: Authorization, Content-Type');
    $router = new RestServer;
	$router->run();
}

catch (\Exception $e)
{
	if(RUN_MODE == MODE_LIVE)
	{
		\Utils\Response::ErrorResponse($e->getMessage());
//		echo $e->getMessage();
	}
	else
	{
//		\Utils\Response::SuccessResponse(200);
//		\Utils\Response::doResponse($e->getMessage());
		echo $e->getMessage().'<br>';
		echo $e->getTraceAsString();
	}

}
?>
