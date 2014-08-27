Phalcon_class
=============

Usage

BootStrap.php

<code>
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
</code>

FlashSession to bootstrap

<code>
$this->_di->set('flashSession', function() {
			return new \Phalcon\Flash\FlashSession();
});
</code>
