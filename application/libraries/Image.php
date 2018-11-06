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
  protected function img_path()
  {
    return $this->CI->config->item('img_basepath').$current_year_folder.'/'.$current_month_folder;
  }

  /****/
  public function img_name($image, $id)
  {
    if(!isset($image['name']))
    {
      return $this->_image = '';
    }

    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $img = $id.".".$ext;
    if(file_exists($this->get_imgpath().'/'.$img))
    {
      $file_parts = pathinfo($image['name']);
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
    $config['upload_path'] = $this->img_path();
    $config['allowed_types'] = $this->config->item('img_types');
    $config['max_size'] = $this->CI->config->item('img_size');
    $config['max_width'] = $this->CI->config->item('img_width');
    $config['max_height'] = $this->CI->config->item('img_height');

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload($field))
    {
      return $this->upload->display_errors();
    }
    return null;
  }
}

?>
