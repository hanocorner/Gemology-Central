<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Layout
{
  /**
   * CodeIgniter Instance
   */
  private $CI;

  /**
   * Layout Title
   */
  private $title_for_layout = null;

  /**
   * Array that holds all the css & js files
   */
  private $file_includes = array();

  /**
   * Setting layout manager to admin or public
   */
  private $layout_manager = null;

  /**
   * Constructor for this class & module initialization
   *
   * @param $config layoutManager must be admin or public | String
   * @return none
   */
  public function __construct($config)
  {
    $this->CI =& get_instance();

    $this->layout_manager = $config['layoutManager'];
  }

  /**
   * Function to set layout title
   *
   * @param $title name of the page
   * @return none
   */
  public function set_title($title)
  {
    $this->title_for_layout = $title;
  }

  /**
   * Overriding codeigniter view to set a custom view
   *
   * @param $view_name name of the view in views folder | string
   * @param $params parameters to be passed as values | array
   * @param $params layout name of the layout | string
   * @return none
   */
  public function view($view_name, $params = array(), $layout = 'default')
  {
    if ($this->title_for_layout !== null)
    {
      $layout_title = $this->title_for_layout;
    }

    $content = $this->CI->load->view($view_name, $params, TRUE);

    if ($this->layout_manager == 'admin')
    {
      $header = $this->CI->load->view('admin/layouts/header', '', TRUE);
      $footer = $this->CI->load->view('admin/layouts/footer', '', TRUE);
    }
    elseif ($this->layout_manager == 'public')
    {
      $header = $this->CI->load->view('public/layouts/header', '', TRUE);
      $footer = $this->CI->load->view('public/layouts/footer', '', TRUE);
    }

    $this->CI->load->view($layout, array(
      'title'=>$layout_title,
      'header'=>$header,
      'content'=>$content,
      'footer'=>$footer
    ));

  }

  /**
   * Function to add css and js files
   *
   * @param $path file path | string
   * @param $prepend_base_url to set codeigniter base_url function | bool
   * @return $this all files
   */
  public function add_include($path, $prepend_base_url = TRUE)
  {
    if ($prepend_base_url)
    {
      $this->CI->load->helper('url');
      $this->file_includes[] = base_url().$path;
    }
    else
    {
      $this->file_includes[] = $path;
    }

    return $this;
  }

  /**
   * Rendering css and js files to layout
   *
   * @param none
   * @return $final_includes css & js files
   */
  public function print_includes()
  {
    $final_includes = '';

    foreach ($this->file_includes as $include)
    {
      // Check if it's a JS or a CSS file
      if (preg_match("/^.*\.(js)$/i", $include))
      {
        $final_includes .= '<script type="text/javascript" src="'.$include.'"></script>';
      }
      elseif (preg_match('/css$/', $include))
      {
        $final_includes .= '<link href="'.$include.'" rel="stylesheet" type="text/css" />';
      }
    }
    return $final_includes;
  }

}

?>
