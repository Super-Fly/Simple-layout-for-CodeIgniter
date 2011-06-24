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

  private $CI;
  private $layout;
  private $view = NULL;
  private $displayLayout = TRUE;
  private $data = array();
  private $returns = FALSE;
  public $viewString = '';
  
  public function __construct($layout = "mainLayout") {
    $this->layout = $layout;
    $this->CI = get_instance();
    
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
    // load variables data
    $this->CI->load->vars($data);
    
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
  
  /**
   * Add CSS Files to load in layout header
   * 
   * add if (isset($CSS_Files)) echo $CSS_Files; in your header
   *
   * @access	public
   * @param	  array/string
   */
  public function css($filename = array()) {
    
    // if is only file name not array make it array
    if (is_array($filename)) {
      $array_filenames = $filename;
    } else {
      $array_filenames = array($filename);
    }
    
    // file url
    $domain  = (config_item('media_url') == '' ? config_item('base_url') : config_item('media_url'));
    $folder  = (config_item('css_folder') == '' ? 'css/' : config_item('css_folder'));
    $fileUrl = $domain . $folder;
    
    // if have CSS with name like controller load it
    $controllerNameCss     = $this->CI->router->class;
    $controllerNameCssPath = './' . $folder. $controllerNameCss . '.css';
    
    if ( is_file($controllerNameCssPath) ) {
      $array_filenames = array_push($array_filenames, $controllerNameCss);
    }

    $cssHtml = '';
    foreach ($array_filenames as $key => $css) {
      
      if ($key === 'ie6') {
        $before = '<!--[if IE 6]>';
        $after  = '<![endif]-->';
      } elseif ($key === 'ie7') {
        $before = '<!--[if IE 7]>';
        $after  = '<![endif]-->';
      } else {
        $before = '';
        $after  = '';
      }

      if ($key === 'print') {
        $media = 'print';
      } else {
        $media = 'all';
      }
      
      $cssHtml .= $before . '<link href="' . $fileUrl . $css . '.css" rel="stylesheet" media="' . $media . '" />' . $after . "\r\n";
    }

    $data['CSS_Files'] = $cssHtml;
    self::setData($data);
  }
  // --------------------------------------------------------------------


  /**
   * Add JavaScript Files to load in layout header
   *
   * add if (isset($JS_Files)) echo $JS_Files; in your header
   * 
   * @access public
   * @param  string/array
   */
  public function js($filename = array()) {
    
    if (is_array($filename)) {
      $array_filenames = $filename;
    } else {
      $array_filenames = array($filename);
    }

    // file url
    $domain  = (config_item('media_url') == '' ? config_item('base_url') : config_item('media_url'));
    $folder  = (config_item('js_folder') == '' ? 'js/' : config_item('js_folder'));
    $fileUrl = $domain . $folder;

    $configJsFiles = array();

    // if have JS with name like controller load it
    $controllerNameJs = $this->CI->router->class;
    $controllerNameJsPath = './' . config_item('js_folder') . $controllerNameJs . '.js';
    
    if (is_file($controllerNameJsPath)) {
      $array_filenames = array_push($array_filenames, $controllerNameJs);
    }

    $jsHtml = '';
    foreach ($array_filenames as $js) {
      $jsHtml .= '<script src="' . $fileUrl . $js . '.js"></script>'."\r\n";
    }

    $data['JS_Files'] = $jsHtml;
    self::setData($data);
  }
  // --------------------------------------------------------------------
  
}
/* End of file Layout.php */
/* Location: ./application/libraries/Layout.php */
