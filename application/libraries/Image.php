<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Image
{
  /**
   * CodeIgniter Instance
   */
  private $CI;

  /**
   * Constructor for this class & module initialization
   *
   * @param $config layoutManager must be admin or public | String
   * @return none
   */
  public function __construct($config)
  {
    $this->CI =& get_instance();
  }

  /****/
  public function create_image_name()
  {
    $image_name = $_FILES['imagegem']['name'];
    if(!isset($image_name))
    {
      $img_string = '';
      return $img_string;
    }

    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
    $img_string = $this->_id.".".$ext;
    if(file_exists($this->_img_path.'/'.$img_string))
    {
      $file_parts = pathinfo($image);
      $extension = $file_parts['extension'];
      $filename = $file_parts['filename'];
      $renamed_image = $filename.'-'.rand(1, 10).'.'.$extension;
    }
    else {
      $renamed_image = $img_string;
    }
    return $renamed_image;
  }

  /*****/
  public function upload_image($file_input, $image_name)
  {
    if(is_uploaded_file($_FILES['imagegem']['tmp_name'])) return null;

    $config = array();

    $config['file_name'] = $image_name;
    $config['upload_path'] =
    $config['allowed_types'] = $this->config->item('img_types');
    $config['max_size'] = $this->config->item('img_size');
    $config['max_width'] = $this->config->item('img_width');
    $config['max_height'] = $this->config->item('img_height');

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload($file_input))
    {
      return $this->upload->display_errors();
    }
    return null;
  }
}

?>
