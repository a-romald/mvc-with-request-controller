<?php
/**
 * Set the PHP error reporting level. If you set this in php.ini, you remove this.
 * @see  http://php.net/error_reporting
 *
 */
error_reporting(E_ALL | E_STRICT);
/**
 * Website document root
 * 
 */
define('ROOT_DIR', dirname(__FILE__));
/**
 * Website url address
 * 
 */
define('URL_DIR', 'http://'.$_SERVER['HTTP_HOST'].'/');
/**
 * The system directory for protection
 * 
 */
define('SYSPATH', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

//Bootstrap the application
require_once ROOT_DIR.'/application/boot.class.php';



//Autoload of system classes
function autoload($className) {
    //list comma separated directory name
    $directory = array('', 'system/');

    //list of comma separated file format
    $fileFormat = array('%s.class.php', '%s.php');

    foreach ($directory as $current_dir) {
        foreach ($fileFormat as $current_format) {

            $path = $current_dir.sprintf($current_format, $className);
            
            if (file_exists($path)) {
                include $path;
                return ;
            }
        }
    }
}
spl_autoload_register('autoload');



//Boot website
try{
    Boot::run();
}
catch(Exception $e){}

?>