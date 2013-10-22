<?php
defined('SYSPATH') or die('No direct script access.');

/**
 * Model base class. All models should extend this class.
 *
 */
class Model {
    
    private static $_instance;
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
    
    /**
	 * Establishes connection according to database settings.
	 *
	 * Models can only be created using the [Model::getInstance] method.
	 *
	 * @return  void
	 */
    private function __construct(){
        $config = Config::load('config/database');
        $this->engine = $config['default']['type'];
        $this->host = $config['default']['connection']['hostname'];
        $this->database = $config['default']['connection']['database'];
        $this->user = $config['default']['connection']['username'];
        $this->pass = $config['default']['connection']['password'];
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        try { // assign PDO object to db variable
            self::$_instance = new PDO($dns, $this->user, $this->pass);
            self::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (PDOException $e) { //Output error – would normally log this to error file rather than output to user.
            echo "Connection Error: " . $e->getMessage();
        }
    }
    
    
    /**
	 * Create a new singleton model instance.
	 *
	 *     $model = Model::getInstance();
	 *
	 * @param   string   model name
	 * @return  Model
	 */
    static public function getInstance() {
        if (self::$_instance == null) {
            new Model();
        }
		return self::$_instance;
    }
    
    
    /**
     * To TRULY ensure there is only 1 instance, need to disable object cloning
     * 
     */
    public function __clone()
    {
        return false;
    }
    
    public function __wakeup()
    {
        return false;
    }

    
}


?>