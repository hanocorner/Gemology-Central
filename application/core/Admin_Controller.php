<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Controller extends LB_Controller
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
    $this->load->library(array('session'));

    $this->form_validation->set_error_delimiters('<span>', '</span>');
  }

  /**
   * User logged in status and set layout as admin
   *
   * @param null
   * @return bool
   */
  protected function check_login_status()
  {
    if (!$this->session->has_userdata('logged_in') && $this->session->logged_in != true)
    {
      if($this->input->is_ajax_request())
      {
        return true;
      }
      else {
        redirect('admin/home');
      }
    }
    else {
      $this->set_layout('admin');
    }
  }

  /**
   * User logged in status check via ajax
   *
   * @param null
   * @return bool
   */
  protected function ajax_login_status()
  {
    if (!$this->session->has_userdata('logged_in') && $this->session->logged_in != true)
    {
      return false;
    }
    return true;
  }

  /**
   * Regenerate CSRF token
   *
   * @param null
   * @return string
   */
  protected function regenerate_csrf()
  {
    return $this->security->get_csrf_hash();
  }

  /**
   * This will return json array with status message
   *
   * @param mixed $auth success | error | warning | info
   * @param string $message actual message string
   * @param mixed $url url to be redirected
   *
   * @return array json data
   */
  protected function json_output($auth = null, $message = '', $url = null)
  {
    if(is_null($auth)) return;

    $json_response = array();

    if($auth === false)
    {
      $json_response['auth'] = false;
      $json_response['csrf'] = $this->regenerate_csrf();
      $json_response['message'] = $message;
    }

    if($auth === true)
    {
      $json_response['auth'] = true;
      $json_response['message'] = $message;
      $json_response['url'] = base_url().$url;
    }
    echo json_encode($json_response);
  }
}
?>
