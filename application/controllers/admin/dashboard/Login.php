<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends Admin_Controller
{
    /**
     * Login Constructor
     * 
     * @param null
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        if ($this->session->has_userdata('logged_in') && $this->session->logged_in == TRUE) 
        {
            redirect('admin/dashboard');
        }

        
    }

    /**
     * Admin Login Form
     * 
     * @param null
     * @return void
     */
	public function index()
	{	
        $this->layout->title = 'Administrator - Gemology Central Laboratory';  
        $this->layout->view('admin/dashboard/login', '', 'without');
    }

    /**
     * Authenticating admin
     * 
     * @param null
     * @return JSON data
     */
    public function authenticate()
    {
        $this->load->model('admin/dashboard/login_model');

        $this->load->library('encryption');

        $this->encryption->initialize(array('driver' => 'mcrypt'));

        $this->_data = $this->input->post();

        if($this->form_validation->run('admin_auth') == FALSE) return $this->json_output(false, validation_errors());

        // DB stored data 
        $credentials = $this->login_model->validate_credentials($this->_data);

        if($credentials[0]->admin_exists == 0)
        {
            return $this->json_output(false, $this->lang->line('error_invalid_adminuser'));
        }

        if ($this->_data['password'] == $this->encryption->decrypt($credentials[0]->u_pass)) 
        {
            $session_data = array('adminid' => $credentials[0]->admin_id, 'logged_in' => TRUE);

            $this->session->set_userdata($session_data);

            return $this->json_output(true, $this->lang->line('success_adminauth'), 'admin/dashboard');
            
        }
        else 
        {
            return $this->json_output(false, $this->lang->line('error_invalid_adminpasss'));
        }
    }
}
?>