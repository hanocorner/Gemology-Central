<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller
{
  /**
   * Constructor (loading the important class)
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->library('session');

    $this->load->library('encryption');

    $this->load->helper(array('html', 'cookie'));

    if (!isset($_SESSION['logged_in']))
    {
      redirect('developer/base');
    }

  }

  /**
   * Default view for the user
   *
   * @return void
   */
  public function index()
  {

    $header['title'] = "Welcome ".$_SESSION['username'];

    // Current username & password
    $data['c_username'] = $this->preview_username();
    $data['c_passwowrd'] = $this->preview_password();
    $data['name'] = $this->security->get_csrf_token_name();
    $data['hash'] = $this->security->get_csrf_hash();

    $this->load->view('developer/header', $header);
    $this->load->view('developer/profile', $data);
    $this->load->view('developer/footer');
  }

  private function preview_password()
  {
    $this->encryption->initialize(array('driver' => 'mcrypt'));

    $result = $this->Login_model->get_user_data('adm_userpassword', 'tbl_administrator');
    $password = $result[0]->adm_userpassword;
    return $this->encryption->decrypt($password);
  }

  private function preview_username()
  {
    $result = $this->Login_model->get_user_data('adm_username', 'tbl_administrator');
    return $result[0]->adm_username;
  }

  /****/
  public function change_username()
  {
    $old_username = $this->preview_username();
    $new_username = $this->input->post('c-username');

    $data = array(
      'adm_username'=>$new_username
    );
    $result = $this->Login_model->update_admin_data('tbl_administrator', 'adm_username', $old_username, $data);

    if($result == TRUE)
    {
      $this->session->set_flashdata(array('message'=>'Username successfully updated', 'status'=>'success'));
      redirect('developer/profile');
      exit;
    }
    else {
      $this->session->set_flashdata('message','Trouble when updating Username');
      redirect('developer/profile');
    }
  }

  /****/
  public function change_password()
  {
    $username = $this->preview_username();
    $new_pass = $this->input->post('new-pass');
    $con_pass = $this->input->post('con-pass');

    if ($new_pass == $con_pass)
    {
      $data = array(
        'adm_userpassword'=>$this->encryption->encrypt($new_pass)
      );
      $result = $this->Login_model->update_admin_data('tbl_administrator', 'adm_username', $username, $data);

      if($result)
      {
        $this->session->set_flashdata('message','Password successfully updated');
        redirect('developer/profile');
        exit;
      }
      else {
        $this->session->set_flashdata('message','Trouble when updating password');
        redirect('developer/profile');
      }
    }
    else {
      $this->session->set_flashdata('message','Passwords did not match. Please try again');
      redirect('developer/profile');
    }
  }


}

?>
