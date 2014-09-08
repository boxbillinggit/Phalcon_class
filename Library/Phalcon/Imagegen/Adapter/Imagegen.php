<?php
namespace Phalcon\Imagegen\Adapter;

use \Phalcon\Config as PhConfig;

class Imagegen
{

	public function __construct()
    {

		
    }

	public function generate($filename) {

							try {
							$img = new \Phalcon\Image\Adapter\Imagick("files/" . $filename);
							$img->resize(210, 140);
							$img->save("files/thumbnail/thumb_" . $filename, 80);
							} catch (\Exception $e) {
								echo 'Caught exception: ',  $e->getMessage(), "\n";
							}
							
	}

}
?>
