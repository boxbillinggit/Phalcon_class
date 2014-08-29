Phalcon_class
=============

Usage

BootStrap.php

```php
	$this->_di->set('sessionDB', function() use ($config) {
	
		// Create a connection
		$connection = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
			"host" => $config->database->host,
			"username" => $config->database->username,
			"password" => $config->database->password,
			"dbname" => $config->database->dbname
		));
						
		$sessionDB = new Phalcon\Session\Adapter\Database(array(
			'db' => $connection,
			'table' => 'session_data'
		));
		
		//Check session_start
	
		if(session_status() == PHP_SESSION_NONE)
        		$sessionDB->start();
	
		return $sessionDB;
	});
```

FlashSession to bootstrap

```php
		$this->_di->set('flashSession', function() {
			return new \Phalcon\Flash\FlashSession(array(
                        'warning' => 'alert alert-warning',
                        'notice' => 'alert alert-info',
                        'success' => 'alert alert-success',
                        'error' => 'alert alert-danger',
                        'dismissable' => 'alert alert-dismissable',
                    ));
		});
```

Database

```sql
 CREATE TABLE `session_data` (
  `session_id` varchar(35) NOT NULL,
  `data` text NOT NULL,
  `created_at` int(15) unsigned NOT NULL,
  `modified_at` int(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`session_id`)
)
```

```php
$this->flashSession->notice("Message Notice");
$this->flashSession->warning("Message Warning");
$this->flashSession->success("Message Success");
$this->flashSession->error("Message Error");
$this->flashSession->dismissable("Message Dismissable");
```

Show message to view

```php
<?php echo $this->flashSession->output(); ?>
```
