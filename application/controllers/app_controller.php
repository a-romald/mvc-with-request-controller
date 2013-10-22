<?php
defined('SYSPATH') or die('No direct script access.');

//Abstract Controller class
abstract class AppController extends Controller {
    
    protected $keywords;		
	protected $description;
    protected $title;
    
    public function before(){
        $this->keywords = 'Our Website,';
		$this->description = 'Before and After Website,';
        $this->title = 'This is our Website';
    }
    
}

?>