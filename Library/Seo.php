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
		echo "<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			  ga('create', '{$id}', 'auto');
			  ga('send', 'pageview');
			
			</script>";
	}
	
	###############################
	#     $url_piwik - Bez http   #
	#	  $id - id piwik id	      #
	###############################
	
	private static function __piwik($id, $url_piwik)
	{
		echo '<script type="text/javascript">
			  var _paq = _paq || [];
			  _paq.push([\'trackPageView\']);
			  _paq.push([\'enableLinkTracking\']);
			  (function() {
				var u=(("https:" == document.location.protocol) ? "https" : "http") + "://'.$url_piwik.'";
				_paq.push([\'setTrackerUrl\', u+\'piwik.php\']);
				_paq.push([\'setSiteId\', '.$id.']);
				var d=document, g=d.createElement(\'script\'), s=d.getElementsByTagName(\'script\')[0]; g.type=\'text/javascript\';
				g.defer=true; g.async=true; g.src=u+\'piwik.js\'; s.parentNode.insertBefore(g,s);
			  })();
			</script>';
	}
	
}
