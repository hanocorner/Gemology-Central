<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Controller extends AP_Controller
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

    $this->set_layout('admin');

    $this->layout->assets('assets/admin/css/main.css');
    $custom_script = 'var baseurl = "'.base_url().'";';
    $this->layout->script($custom_script, 'header');

    $this->layout->assets(base_url('assets/admin/js/app.bundle.js'), 'footer');
    $this->layout->assets(base_url('assets/vendors/hullabaloo/hullabaloo.js'), 'footer');
    $this->layout->assets(base_url('assets/admin/js/main.js'), 'footer');

  }

  /**
   * Function to check admin logged in status
   *
   * @param null
   * @return void
   */
  protected function check_login_status()
  {
    if (!$this->session->has_userdata('logged_in') && $this->session->logged_in != true)
    {
      redirect('admin');
    }
  }

  /**
   * This will return json array with status message
   *
   * @param mixed $auth success | error | warning | info
   * @param string $message actual message string
   * @param mixed $url url to be redirected
   *
   * @return null
   */
  protected function json_output($auth = null, $message = '', $url = null)
  {
    if(is_null($auth)) return;

    $json_response = array();

    if($auth === false)
    {
      $json_response['auth'] = false;
    }

    if($auth === true)
    {
      $json_response['auth'] = true;
      $json_response['url'] = base_url($url);
    }

    $json_response['message'] = $message;
    $json_response['csrf'] = $this->security->get_csrf_hash();

    $this->output->set_content_type('application/json', 'utf-8');
    $this->output->set_output(json_encode($json_response));
  }
}
?>
