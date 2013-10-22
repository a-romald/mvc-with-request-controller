<?php
defined('SYSPATH') or die('No direct script access.');

class MainController extends AppController {
    
    public function before(){
		parent::before();
        Config::load('models/tags');
    }
    
    
    public function after(){
        parent::after();
		echo '<h3>Hello, After</h3>';
	}
    
    
    public function index() {
        
        $view = new Template('main/index') ;
        $view->title = $this->title.' | Main Page' ;
        $view->keywords = $this->keywords;
		$view->description = $this->description;
        $view->hello = 'Hello, World!';
        $view->display();
        
    }
    
    
    
    public function show($id = null) {
        
        $id = !empty($id) ? (int) $id : 1;
        $db = Tag::getInstance();
        $stmt = $db->prepare("SELECT * FROM tags WHERE id = ?");
        $stmt->execute(array($id));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $view = new Template('main/show') ;
        $view->title = $this->title.' | Tag Page' ;
        $view->keywords = $this->keywords . ' tags';
		$view->description = $this->description . ' website tags';
        $view->result = $result;
        $view->display();
    }
    
    
}


?>