<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( ! function_exists('create_directory'))
{
  /**
   * Creating Sub directories inside Main directory
   * (assets/images/Memocard/2018/11)
   *
   * 2018 - current year folder
   * 11 - current month folder
   *
   * @param null
   * @return string sub folder
   */
  function create_directory($base_folder, $sub_folder = null)
  {
    $CI = get_instance();

    $CI->config->load('general');

    foreach ($CI->config->item('base_folder') as $key => $value)
    {
      if($key == $base_folder)
      {
        $basedir = $value;
      }
      else {
        log_message('error', 'specified folder path does not exist, Please recheck');
      }
    }

    if($sub_folder == null)
    {
      $file_path = $CI->config->item('img_basepath').$basedir.'/';
    }
    else {
      $file_path = $CI->config->item('img_basepath').$basedir.'/'.$sub_folder.'/';
    }

    if(!file_exists($file_path))
    {
      mkdir($file_path, 0777, true);
    }

    return $file_path;
  }
}
?>
