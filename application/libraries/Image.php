<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Image
{
  /**
   * CodeIgniter Instance
   *
   * @var object
   */
  private $CI;

  /**** */
  private $_path_string = '';

  /*****/
  public $errors = '';

  /**
   * Constructor for this class & module initialization
   *
   * @param $config layoutManager must be admin or public | String
   * @return null
   */
  public function __construct()
  {
    $this->CI =& get_instance();
  }

  /*****/
  private function directory_path($parent)
  {
    $grandparent_dir = './assets/images';
    $parent_dir = $parent.'/'.date('Y');
    $child_dir = date('m');

    $this->_path_string = $grandparent_dir.'/'.$parent_dir.'/'.$child_dir;

    if(!file_exists($this->_path_string)) mkdir($this->_path_string, 0777, true);

    return $this->_path_string;
  }

  /****/
  public function img_name($image, $id, $parent_dir)
  {
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $image_renamed = $id.".".$ext;
    if(file_exists($this->directory_path($parent_dir).'/'.$image_renamed))
    {
      $file_parts = pathinfo($image_renamed);
      $extension = $file_parts['extension'];
      $filename = $file_parts['filename'];
      $image_name = $filename.'-'.rand(1, 10).'.'.$extension;
    }
    else {
      $image_name = $image_renamed;
    }
    return $image_name;
  }

  /*****/
  public function img_upload($file, $field, $id, $parent_dir)
  {
    $this->CI->config->load('report');

    $config = array();

    $config['file_name'] = $this->img_name($file[$field]['name'], $id, $parent_dir);
    $config['upload_path'] = $this->_path_string;
    $config['allowed_types'] = $this->CI->config->item('allowed_types');
    $config['max_size'] = $this->CI->config->item('max_size');
    $config['max_width'] = $this->CI->config->item('max_width');
    $config['max_height'] = $this->CI->config->item('max_height');

    $this->CI->load->library('upload', $config);

    if ($this->CI->upload->do_upload($field))
    {
      return $this->CI->upload->data('file_name');
    }
    else {
      $this->errors = $this->CI->upload->display_errors('<p>', '</p>');
      return false;
    }
  }
}

?>
