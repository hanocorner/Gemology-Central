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
  public function img_path($base_folder, $sub_folder = null, $param = false)
  {
    foreach ($this->CI->config->item('base_folder') as $key => $value)
    {
      if($key == $base_folder)
      {
        $folder = $value;
      }
    }
    if($sub_folder == null)
    {
      $this->_img_path = $this->CI->config->item('img_basepath').$folder.'/';
    }
    else {
      $this->_img_path = $this->CI->config->item('img_basepath').$folder.'/'.$sub_folder.'/';
    }

  }

  /****/
  public function img_name($image, $id)
  {
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $img = $id.".".$ext;
    if(file_exists($this->get_imgpath().'/'.$img))
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
    $config['allowed_types'] = $this->config->item('img_types');
    $config['max_size'] = $this->CI->config->item('img_size');
    $config['max_width'] = $this->CI->config->item('img_width');
    $config['max_height'] = $this->CI->config->item('img_height');

    $this->load->library('upload', $config);

    if ($this->upload->do_upload($field))
    {
      return $this->upload->data('file_name');
    }
    else {
      $this->errors = $this->upload->display_errors('<p>', '</p>');
      return false;
    }
  }
}

?>
