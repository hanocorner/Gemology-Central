<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends Admin_Controller
{
    /*** */
    private $_html = '';

    /**
     * Account Constructor
     * 
     */
    public function __construct()
    {
        parent::__construct();

        $this->check_login_status();

        //$this->load->model('admin/dashboard/account_model', 'account');
    }

    /*** */
    public function index()
    {
        $this->layout->title = 'Dashboard - Gemology Central Laboratory';
        $this->layout->view('admin/dashboard/account');
    }

    /*** */
    public function logout()
    {
        $session_data = $this->session->all_userdata();
        foreach ($session_data as $key => $value) 
        {
            if($key == 'session_id' || $key == 'logged_in' || $key == 'userid') 
            {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();

        redirect('admin');
    }

    /**** */
    public function latest_activities()
    {
        $this->load->model('admin/dashboard/account_model', 'account');

        $results = $this->account->get_log($this->session->adminid);
        
        if(!isset($results))
        {
            return $this->_html = 'Unable to fetch data';
        }

        $this->_html .= '<div class="d-flex flex-row mt-4">'; 
        $this->_html .= '<div class="d-flex flex-column mr-4">';

        $this->_html .= '<div class="my-2">';
        $this->_html .= '<h6>Last Login</h6>';
        $this->_html .= '<p class="text-muted">'.$results['timestamp'].'</p>';
        $this->_html .= '</div>';

        $this->_html .= '<div>';
        $this->_html .= '<h6>Platform</h6>';
        $this->_html .= '<p class="text-muted">'.$results['platform'].'</p>';
        $this->_html .= '</div>';

        $this->_html .= '</div>';

        $this->_html .= '<div class="d-flex flex-column ml-4">';

        $this->_html .= '<div class="my-2">';
        $this->_html .= '<h6>IP Address</h6>';
        $this->_html .= '<p class="text-muted">'.$results['ip_address'].'</p>';
        $this->_html .= '</div>';

        $this->_html .= '<div>';
        $this->_html .= '<h6>Browser</h6>';
        $this->_html .= '<p class="text-muted">'.$results['user_agent'].'</p>';
        $this->_html .= '</div>';

        $this->_html .= '</div>';

        $this->_html .= '</div>'; // End of flex row

        echo $this->_html;
    }
}