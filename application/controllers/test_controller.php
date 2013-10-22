<?php
defined('SYSPATH') or die('No direct script access.');

class TestController extends AppController {
    
    private $a = 4;
    
    
    public function before(){
		$this->get_value();
    }
    
    
    
    public function index() {
        
        echo 'This is Test index';
        
    }
    
    
    private function get_value() {
        $a = $this->a;
        if ($a == 4) {
            header("Location: /main/show/".$a);
        }
        else {
            header("Location: /");
        }
    }
    
}


?>