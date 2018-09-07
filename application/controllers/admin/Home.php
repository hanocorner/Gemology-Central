<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
  /**
   * Constructor (loading the important the class)
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->library(array('encryption','session'));

    $this->load->helper(array('cookie', 'date'));
  }

  /**
   * Default view for the user
   *
   * @return void
   */
  public function index()
  {
    if ($this->session->has_userdata('logged_in'))
    {
      redirect('admin/profile');
    }
    else
    {
      $this->form_view();
    }

  }

  /****/
  public function form_view()
  {
    $csrf['name'] = $this->security->get_csrf_token_name();
    $csrf['hash'] = $this->security->get_csrf_hash();
    $this->load->view('admin/login', $csrf);
  }

  /**
   * Authenticating the user
   *
   * @return void
   */
  public function login()
  {
    $this->encryption->initialize(array('driver' => 'mcrypt'));

    $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');

    if ($this->form_validation->run() == FALSE)
    {
      $this->form_view();
      return false;
    }
    else
    {
      $username = $this->input->post('username');
      $passowrd = $this->input->post('password');

      $admin_id = $this->Login_model->authentication($username, 'tbl_administrator', 'adm_username');

      if ($admin_id == false)
      {
        $this->set_message('Username you entered is incorrect...', 'danger');
        $this->form_view();
        return false;
      }

      $result = $this->Login_model->get_user_details('tbl_administrator', $admin_id, 'admid');

      $db_password = $result[0]->adm_userpassword;
      $db_password = $this->encryption->decrypt($db_password);

      if ($passowrd == $db_password)
      {
        $session_data = array(
        'username' => $result[0]->adm_username,
        'user_id' => $admin_id,
        'logged_in' => TRUE
        );

        $datestring = '%Y-%m-%d %h:%i:%s';
        $time = time();
        $date = mdate($datestring, $time);

        $log = array(
          'log_timestamp'=>$date,
          'log_userBrowser'=>'chrome'
        );
        $this->Login_model->update_admin_data('tbl_administrator_log', 'admID', $admin_id, $log);

        $this->session->set_userdata($session_data);

        $this->set_message('Login Successfull...', 'success');
        redirect('admin/profile');
      }
      else
      {
        $this->set_message('Password you entered is incorrect...', 'danger');
        $this->form_view();
        return false;
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
    $session_data = array(
    'username' => '',
    'email'=> '',
    'logged_in' => FALSE
    );

    $this->session->unset_userdata($session_data);
    $this->session->sess_destroy();

    delete_cookie('_gcl');

    $this->set_message('You have successfully logged out', 'success');

    redirect('admin');
    exit;
  }

  /**
   * Function to set user message after form completion
   *
   * @param none
   * @return void
   */
  public function set_message($msg, $status)
  {
    $data = array(
      'message'=> $msg,
      'status'=> $status,
    );
    $this->session->set_flashdata($data);

  }

}
?>
