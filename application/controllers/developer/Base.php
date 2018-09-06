<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base extends CI_Controller
{
  /**
   * Constructor (loading the important the class)
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->library('session');

    $this->load->helper('cookie');

  }

  /**
   * Default view for the user
   *
   * @return void
   */
  public function index()
  {
    if (isset($_SESSION['logged_in']))
    {
      if($_SESSION['logged_in'] == TRUE)
      {
        redirect('developer/profile');
      }
    }
    else
    {
      $this->form_view();
    }

  }

  /**
   * Default Form view
   */
  public function form_view()
  {
    $csrf['name'] = $this->security->get_csrf_token_name();
    $csrf['hash'] = $this->security->get_csrf_hash();
    $this->load->view('developer/login', $csrf);
  }
  /**
   * Authenticating the user
   *
   * @return void
   */
  public function login()
  {

    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE)
    {
      $this->form_view();
      return false;
    }
    else
    {
      $username = $this->input->post('username');
      $passowrd = $this->input->post('password');

      $key = $this->Login_model->authentication($username, 'tbl_developer', 'dev_username');

      if ($key == false)
      {
        $this->form_view();
        return false;
      }

      $result = $this->Login_model->get_user_details('tbl_developer', $key, 'devid');

      $db_password = $result[0]->dev_userpassword;

      if ($passowrd == $db_password)
      {
        $session_data = array(
        'username' => $result[0]->dev_username,
        'email' => $result[0]->dev_useremail,
        'user_id' => $result[0]->devid,
        'logged_in' => TRUE
        );

        $this->session->set_userdata($session_data);

        $this->session->set_flashdata('message','Login successfull Redirecting...');
        redirect('developer/profile');
        exit;
      }
      else
      {
        $this->session->set_flashdata('message','Invalid Credentials');
        $this->form_view();
      }

    }

  }

  /**
   * Destroying the session
   *
   * @return void
   */
  public function logout()
  {
    // Removing session data
    $session_data = array(
    'username' => '',
    'email'=> '',
    'logged_in' => FALSE
    );

    $this->session->unset_userdata($session_data);
    $this->session->sess_destroy();

    delete_cookie('ci_sessions');

    redirect('developer');
    exit;
  }

}
?>
