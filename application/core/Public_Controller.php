<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Public_Controller extends AP_Controller
{
  /**
   * Default Controller
   *
   * @param null
   * @return void
   */
  public function __construct()
  {
    parent::__construct();

    $this->set_layout('public');

    $this->layout->assets('assets/public/css/main.css');
    $custom_script = 'var baseurl = "'.base_url().'";';
    $this->layout->script($custom_script, 'header');

    $this->layout->assets('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', 'footer');
    $this->layout->assets('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', 'footer');
    $this->layout->assets(base_url('assets/public/js/base.js'), 'footer');
  }
}
?>
