<?php
namespace Phalcon\Library;

use \Phalcon\Config as PhConfig;
use \Phalcon\Mvc\Dispatcher;

class Seo
{
	
	protected $_description;
	protected $_title;
	protected $_canonical;
	protected $_moduleName;
	protected $_controllerName;
	protected $_actionName;
	private static $_instance;
	protected $_router;
	
	public static function instance($title, $description, $canonical)
    {	
		$params = (object) array("title" => $title, "description" => $description, "canonical" => $canonical);
	
        if( empty(self::$_instance) )
            self::$_instance = new Seo($params);
        return self::$_instance;
    }
	
	private function __construct($params)
    {
		
		$this->_title = $params->title;
		$this->_description = $params->description;
		$this->_canonical = $params->canonical;
		
		$this->_router = \Phalcon\DI::getDefault()->getShared('router');
		
		$this->_moduleName = $this->_router->getModuleName(); 
		$this->_controllerName = $this->_router->getActionName();
		$this->_actionName = $this->_router->getActionName();

	}
	
	private static function __analitics($id)
	{
		
	}
	
	private static function __piwik($id)
	{
		
	}
	
}
