<?php 
defined('SYSPATH') or die('No direct script access.');

/**
 * Contains configuration. Configuration readers can be
 * attached to allow loading configuration from files, database, etc.
 */
class Config {
    
    /**
	 * Loads a file within a totally empty scope and returns the output:
	 *
	 *    Config::load('foo.php');
	 *
	 * @param   string
	 * @return  mixed
	 */
    public static function load($file)
	{
		return include ROOT_DIR."/application/".$file.".php";
	}
    
    
}


?>