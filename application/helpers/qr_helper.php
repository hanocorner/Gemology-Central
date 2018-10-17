<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function qrcode($id, $img_path)
{
  $CI =& get_instance();
  $CI->load->library('ciqrcode');

  $qrcode = 'QR-'.$id.'.'.'png';
  $params['data'] = "https://gemologycentral.com/report/".$id;
  $params['level'] = 'H';
  $params['size'] = 8;
  $params['savename'] = $img_path.'/'.$qrcode;

  if($CI->ciqrcode->generate($params)) return $qrcode;

  return null;
}
?>
