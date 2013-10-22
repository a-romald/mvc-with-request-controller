<?php
defined('SYSPATH') or die('No direct script access.');
/**
 * Abstract controller class. Controllers should only be created using a [Request].
 *
 * Controllers methods will be automatically called in the following order by
 * the request:
 *
 */
 
abstract class Controller {
     
    /**
	 * Creates a controller request.
	 *
	 * @param   Request to call the controller action and GET id parameter if exists.
	 * @return  void
	 */ 
	public function request($action, $id = null)
	{
		$this->before();
		$this->$action($id);
		$this->after();
	}
    
    /**
	 * Automatically executed before the controller action. Can be used to set
	 * class properties, do authorization checks, and execute other custom code.
	 *
	 * @return  void
	 */
	protected function before()
	{
		// Nothing by default
	}

	/**
	 * Automatically executed after the controller action. Can be used to apply
	 * transformation to the request response, add extra output, and execute
	 * other custom code.
	 *
	 * @return  void
	 */
	protected function after()
	{
		// Nothing by default
	}
     
     
}


?>