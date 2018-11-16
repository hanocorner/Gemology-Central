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

  /****/
  private $_image = '';

  /****/
  private $_image_path = '';

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
    $this->CI->config->load('report');
  }

  /*****/
  public function img_path($filepath)
  {
    $this->_img_path = $filepath;
  }

  /****/
  public function img_name($image, $id)
  {
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $img = $id.".".$ext;
    if(file_exists($this->_img_path.'/'.$img))
    {
      $file_parts = pathinfo($image);
      $extension = $file_parts['extension'];
      $filename = $file_parts['filename'];
      $this->_image = $filename.'-'.rand(1, 10).'.'.$extension;
    }
    else {
      $this->_image = $img;
    }
    return $this->_image;
  }

  /*****/
  public function img_upload($field)
  {
    $config = array();

    $config['file_name'] = $this->_image;
    $config['upload_path'] = $this->_img_path;
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
