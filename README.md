Phalcon_class
=============

Usage

BootStrap.php

<pre>
	$this->_di->set('session', function() use ($config) {
	
		// Create a connection
		$connection = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
			"host" => $config->database->host,
			"username" => $config->database->username,
			"password" => $config->database->password,
			"dbname" => $config->database->dbname
		));
						
		$session = new Phalcon\Session\Adapter\Database(array(
			'db' => $connection,
			'table' => 'session_data'
		));
	
		$session->start();
	
		return $session;
	});
</pre>

FlashSession to bootstrap

<code>
$this->_di->set('flashSession', function() {
			return new \Phalcon\Flash\FlashSession();
});
</code>


Database

<pre>
 CREATE TABLE `session_data` (
  `session_id` varchar(35) NOT NULL,
  `data` text NOT NULL,
  `created_at` int(15) unsigned NOT NULL,
  `modified_at` int(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`session_id`)
)
</pre>
