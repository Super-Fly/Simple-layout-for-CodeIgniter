<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
    
    //$this->layout->setLayout('layoutName');
	}

	public function index() {
		
    $data['title'] = 'some title';
    $data['variableName'] = 'variableValue';
     
    $this->layout->setData($data);
    
    // add css file or files
    $this->layout->css('cssFilename');
    // add js file or files
    $this->layout->js('jsFilename');

    //if you whant different view
    //$this->layout->setView('viewName');
    
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
