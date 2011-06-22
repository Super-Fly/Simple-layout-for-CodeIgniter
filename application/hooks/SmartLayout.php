<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SmartLayout Class
 *
 * This class enables Layout System for CodeIgniter
 *
 * @package		SimpleLayout
 * @subpackage	Hooks
 * @license   http://creativecommons.org/licenses/by-sa/3.0/
 * @link      http://langelov.com/simple-layout-system-for-codeigniter/144
 * @author		Lubomir T. Angelov
 * @version   1.0
 */
class SmartLayout {

    private $layoutSettings = array();
    private $CI;

    public function __construct() {
        $this->CI =& get_instance();
        
        $this->layoutSettings = $this->CI->layout->getLayoutData();
    }

    public function runLayout() {
      
      // if will display layout
      if ( $this->layoutSettings['displayIt'] ) {
        
        // if has other view than default controller/method run it
        if ($this->layoutSettings['view'] == NULL) {
          $view = $this->CI->router->method;
        } else {
          $view = $this->layoutSettings['view'];
        }
        
        // default folder for every controller
        $viewFolder = $this->CI->router->class;
        
        // view name with folder and extention
        $viewName = $viewFolder . '/' . $view . EXT;
        
        // full path to views
        $viewPath = FCPATH . APPPATH . 'views/';
        
        // full file path to include view in layout
        $viewFile = $viewPath . $viewName;
        
        // layout
        $layoutFile = 'layouts/' . $this->layoutSettings['layout'];
        
        // default layout variables
        $data['viewPath']  = $viewPath;
        $data['innerView'] = $viewFile;
        
        // merge layout variables with view variables
        $data = array_merge($data, $this->layoutSettings['data']);
        
        // if layout exist
        if (is_file($viewPath . $layoutFile . EXT)) {
          // if view file exist
          if (is_file($viewFile)) {
            
            // load layout and assing view file to load it
            if ($this->layoutSettings['return'] === FALSE)  {
              $this->CI->load->view($layoutFile, $data);
            } else {
              $this->CI->layout->viewString = $this->CI->load->view($layoutFile, $data, TRUE);
            }
            
          } else {
            show_error('View file [' . $viewName . '] is missing');
            log_message('error', 'View file [' . $viewName . '] is missing');
          }
          
        } else {
          show_error('Layout file [' . $layoutFile . EXT . '] is missing');
          log_message('error', 'Layout file [' . $layoutFile . EXT . '] is missing');
        }
        
      }
      
    }
}
/* End of file Smart.php */
/* Location: ./application/hooks/Smart.php */
