<?php

namespace Phalcon\Flash;
use \Phalcon\Session\Adapter\Files;
use \Phalcon\Config as PhConfig;

class FlashSession
{
    /**
     * Messages collection
     * @var array
     */
    protected $messages;
	
	protected $session;

    /**
     * Css classes collection
     * @var array
     */
    protected $cssClasses = [];

    /**
     * Constructor
     * @param array $cssClasses
     * @return void
     */
    public function __construct(array $cssClasses = null)
    {
        if (!is_null($cssClasses)) {
            if (count($cssClasses)) {
                foreach($cssClasses as $type => $class) {
                    $this->cssClasses[$type] = $class;
                }
            }
        }
		
		//Get From BootStrap Settings
		$di     = \Phalcon\DI::getDefault();
		$this->session = $di->get('sessionDB', true);
		
    }
	
    /**
     * Returns current messages
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Adds message to stack
     * @param string $type
     * @param string $text
     * @return Flash
     */
    public function message($type, $text)
    {
        $this->messages[] = [
            'type' => $type,
            'text' => $text,
        ];
		
		$this->session->write("_flashMessages", json_encode($this->messages));
		
        return $this;
    }    

    /**
     * Adds error message to stack and save to database
     * @param string $text
     * @return Flash
     */
    public function error($text)
    {
        $this->messages[] = [
            'type' => 'error',
            'text' => $text,
        ];
		
		$this->session->write("_flashMessages", json_encode($this->messages));
		
        return $this;
    }    

    /**
     * Adds notice message to stack and save to database
     * @param string $text
     * @return Flash
     */
    public function notice($text)
    {
        $this->messages[] = [
            'type' => 'notice',
            'text' => $text,
        ];
		
		$this->session->write("_flashMessages", json_encode($this->messages));
		
        return $this;
    }    

    /**
     * Adds success message to stack and save to database
     * @param string $text
     * @return Flash
     */
    public function success($text)
    {
        $this->messages[] = [
            'type' => 'success',
            'text' => $text,
        ];
				
		$this->session->write("_flashMessages", json_encode($this->messages));
			
        return $this;
    }

    /**
     * Adds warning message to stack and save to database
     * @param string $text
     * @return Flash
     */
    public function warning($text)
    {
        $this->messages[] = [
            'type' => 'warning',
            'text' => $text,
        ];
		
		$this->session->write("_flashMessages", json_encode($this->messages));
		
        return $this;
    }
	
	/**
     * Adds dismissable message to stack and save to database
     * @param string $text
     * @return Flash
     */
	public function dismissable($text)
	{
		$this->messages[] = [
            'type' => 'warning',
            'text' => $text,
        ];
		
		$this->session->write("_flashMessages", json_encode($this->messages));
		
        return $this;
	}

    /**
     * Outputs messages from database session
     * @return string
     */
    public function output()
    {
        $output = '';
		
		$json = json_decode($this->session->read("_flashMessages"));

        if (count($json)) {
						
            foreach($json as $message) {
                // Configure css class
                $cssClass = 'flash-message';
                if (!empty($this->cssClasses[$message->type])) {
                    $cssClass = $this->cssClasses[$message->type];
                }

                // Append output
                $output.= '<div class="' . $cssClass . '">' 
                        . $message->text 
                        . '</div>';
            }
        }
		
		$this->session->destroy("_flashMessages");
		
        return $output;
    }

    /**
     * Outputs all messages
     * @return string
     */
    public function __toString()
    {
        return $this->output();
    }

}
?>
