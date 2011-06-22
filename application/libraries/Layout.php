<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Layout Class
 *
 * This class control Layout System for CodeIgniter
 *
 * @package		SimpleLayout
 * @subpackage  libraries
 * @license   http://creativecommons.org/licenses/by-sa/3.0/
 * @link      http://langelov.com/simple-layout-system-for-codeigniter/144
 * @author		Lubomir T. Angelov
 * @version   1.0
 */
class Layout {

  private $layout;
  private $view = NULL;
  private $displayLayout = TRUE;
  private $data = array();
  private $returns = FALSE;
  public $viewString = '';
  
  public function __construct($layout = "mainLayout") {
    $this->layout = $layout;
    
    log_message('debug', 'Simple layout library loaded.');
  }

  public function setLayout($layout) {
    $this->layout = $layout;
  }

  public function setView($view) {
    $this->view = $view;
  }
      
  public function displayIt($displayLayout) {
    $this->displayLayout = $displayLayout;
  }
  
  /**
   * Set layout variables data to views
   * 
   * @param array
   * @param string
   * @param boolean
   */
  public function setData($data, $view = NULL, $return = FALSE) {
    // set variables data
    $this->data = $data;
    
    // if set different view
    if ($view != NULL) {
      $this->setView($view);
    }
    
    // if you want to return view as string
    $this->returns = $return;
  }
  
  /**
   * Get Layout data
   * 
   * @returns   array
   */
  public function getLayoutData() {
    
    $data = array();
    $data['layout']    = $this->layout;
    $data['displayIt'] = $this->displayLayout;
    $data['view']      = $this->view;
    $data['data']      = $this->data;
    $data['return']    = $this->returns;
    
    return $data;
    
  }

}
/* End of file Layout.php */
/* Location: ./application/libraries/Layout.php */
