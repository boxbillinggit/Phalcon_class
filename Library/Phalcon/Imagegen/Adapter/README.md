Bootstrap

```php
	protected function imagegen() {
			$gen = new \Phalcon\Imagegen\Adapter\Imagegen();
			return $gen;
	}
```

Usage

```php

$FileName = "Your File.png/jpg/itp";

$gen = new \Phalcon\Imagegen\Adapter\Imagegen();
$gen->generate($FileName);
```
