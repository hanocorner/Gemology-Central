<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller
{
  /**
   * Constructor (loading the important class)
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->library('session');

    $this->load->library('encryption');

    $config = array('layoutManager'=>'admin');
    $this->load->library('layout', $config);

    $this->load->helper(array('html', 'cookie'));

    if (!isset($_SESSION['logged_in']))
    {
      redirect('admin/home','location');
    }

  }

  /****/
  public function change_information()
  {
    $this->layout->set_title('Change Information');
    $this->layout->view('admin/settings/change_information', '', 'admin/layouts/admin');
  }

  /****/
  public function change_password()
  {
    $this->layout->set_title('Change Password');
    $this->layout->view('admin/settings/change_password', '', 'admin/layouts/admin');
  }

  private function preview_username()
  {
    $result = $this->Login_model->get_user_data('adm_username', 'tbl_administrator');
    return $result[0]->adm_username;
  }

  public function update_username()
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
      redirect('developer/profile','location');
      exit;
    }
    else {
      $this->session->set_flashdata('message','Trouble when updating Username');
      redirect('developer/profile','location');
    }
  }

  public function update_password()
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
        redirect('developer/profile','location');
        exit;
      }
      else {
        $this->session->set_flashdata('message','Trouble when updating password');
        redirect('developer/profile','location');
      }
    }
    else {
      $this->session->set_flashdata('message','Passwords did not match. Please try again');
      redirect('developer/profile','location');
    }
  }
}
?>
