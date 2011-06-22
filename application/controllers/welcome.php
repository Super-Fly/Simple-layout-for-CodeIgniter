<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
		parent::__construct();
    
    $this->layout->setLayout('layoutName');
	}

	function index() {
		
    $data['title'] = 'some title';
    $data['variableName'] = 'variableValue';
     
    $this->layout->setData($data);

    //if you whant different view
    //$this->layout->setView('viewName');
    
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
