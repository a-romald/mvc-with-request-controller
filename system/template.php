<?php
defined('SYSPATH') or die('No direct script access.');

/**
 * Acts as an object wrapper for HTML pages with embedded PHP.
 * Variables can be assigned with the view object and referenced locally within
 * the view.
 *
 */
class Template {
    
    private $vName ;
    private $lName ;
    private $varsHolder = array() ;
    
    /**
	 * Returns a new Template object.
	 *
	 *     $view = new Template($file);
	 *
	 * @param   string  view filename
	 * @return  Template
	 */
    public function __construct($vName, $lName = 'default') {
            $config = Config::load('config/view');
			$this->vName = ROOT_DIR."/application/views/". $vName . '.tpl' ;
			//$this->lName = ROOT_DIR."/application/views/layouts/". $lName . '.tpl' ;
            $this->lName = ROOT_DIR."/application/views/". $config['default']['template'] . '.tpl' ;
		}
    
    /**
	 * Renders the template object to a string. Global and local data are merged
	 * and extracted to create local variables within the view file.
	 *
	 *     $output = $view->display();
	 *
	 * @return   string
	 */
    public function display() {
			extract($this->varsHolder) ;
			ob_start() ;
			include $this->vName ;
			$content_for_layout = ob_get_clean() ;
			include $this->lName ;
		}
    
    /**
	 * Magic method with  parameters.
     * Assigns a variable by name. Assigned values will be available as a
	 * variable within the view file:
	 *
	 *     $view->foo = 'something';
	 *
	 * @param   string  variable name
	 * @param   mixed   value
	 * @return  void
	 */
    public function __set($name,  $value) {
			$this->varsHolder[$name] = $value ;
		}


    /**
	 * Magic method, searches for the given variable and returns its value.
	 *
	 *     $value = $view->foo;
	 *
	 *
	 * @param   string  variable name
	 * @return  mixed
	 */
    public function __get($name) {
			return $this->varsHolder[$name] ;
		}
        
     
}

?>