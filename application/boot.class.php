<?php
defined('SYSPATH') or die('No direct script access.');
/**
 * Class Boot to bootstrap the application.
 *
 *
 */
class Boot{
    
    /**
     * Method config to call Routes. Also loads application classes
     *
     *@return  void
     */
    private static function config(){
        
        //Include app_controller
        Config::load('controllers/app_controller');
        //Include routes
        Routes::dispatch();
        
    }
    
    
    /**
     * Method calls config method of the same class.
     *
     *@return  void
     */
    public static function run(){
        return self::config();
    }
    
           
}

?>