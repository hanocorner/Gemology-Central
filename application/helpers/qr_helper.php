<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( ! function_exists('qrcode'))
{
  /**
   * Generating the qr code
   *
   * @param string qr url
   * @return string qrcode
   */
  function qrcode($qrdata)
  {
    $CI =& get_instance();

    $CI->load->library('ciqrcode');

    $CI->config->load('general');

    $qrcode = 'tempQr'.'png';
    $params['data'] = $qrdata;
    $params['level'] = 'H';
    $params['size'] = 8;
    $params['savename'] = $CI->config->item('base_folder').'/'.'qr/'.$qrcode;

    if($CI->ciqrcode->generate($params)) return $qrcode;

    return null;
  }

}

// ------------------------------------------------------------------------

if ( ! function_exists('remove_qr'))
{
  /**
   * Removing the qr image from server location
   *
   * @param null
   * @return bool
   */
  function remove_qr()
  {
    $CI =& get_instance();

    $CI->load->library('ciqrcode');

    $CI->config->load('general');

    $qrcode = 'tempQr'.'png';
    $params['data'] = $qrdata;
    $params['level'] = 'H';
    $params['size'] = 8;
    $params['savename'] = $CI->config->item('base_folder').'/'.'qr/'.$qrcode;

    if($CI->ciqrcode->generate($params)) return $qrcode;

    return null;
  }

}
?>
