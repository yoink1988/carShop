<?php
namespace Utils;

/**
 * Description of Response
 *
 * @author yoink
 */
class Response
{
    public static function ErrorResponse($h)
	{
        $header = array(
            400 => "HTTP/1.0 400 Bad Request",
            403 => "HTTP/1.0 403 Forbidden",
            404 => "HTTP/1.0 404 Not Found",

        );
		header($header[$h]);
    }

    public static function SuccessResponse($h) {
        $header = array(
            200 => "HTTP/1.0 200 OK",
        );
		header($header[$h]);
    }

	public static function doResponse($data, $resType)
	{
		print_r(self::convertRespone($data, $resType));
	}

	public static function convertRespone($data, $resType)
	{
		switch ($resType)
		{
			case 'json':
				return self::toJson($data);
				break;
			case 'txt':
				return self::toTxt($data);
				break;
			case 'xml':
                $xml = new \SimpleXMLElement('<?xml version="1.0"?><data></data>');
                self::toXml($data, $xml);
                return $xml->asXML();
				break;
			case 'html':
				return self::toHtml($data);
				break;
		}
	}

	public static function toXml($data, $xml)
	{
		if(is_array($data))
		{
			foreach($data as $key=>$val)
			{
				if(is_numeric($key))
				{
					$key = 'obj'.$key ;
				}
				if(is_array($val))
				{
					$subnode = $xml->addChild($key);
					self::toXml($val, $subnode);
				}
				else
				{
					$xml->addChild("$key",htmlspecialchars("$val"));
				}
			}
		}
		else
		{
			$xml->addChild($data);
		}
	}
	public static function toJson($data)
	{
		header('Content-Type: application/json');
		return json_encode($data);
	}
	public static function toHtml($data)
	{
		header('Content-Type: text/html; charset=utf-8');
        ob_start();
        include "lib/template.php";
        $html = ob_get_contents();
        ob_end_clean();
        print_r($html) ;
	}
	public static function toTxt($data)
	{
		header('Content-Type: text/javascript; charset=utf-8');
		return print_r($data);
	}
}
