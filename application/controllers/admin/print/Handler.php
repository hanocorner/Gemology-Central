<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Handler extends Admin_Controller
{
    /** */
    public function __construct()
    {
        parent::__construct();
        $this->check_login_status();

        $this->load->model('admin/print/Receipt_model');
        $this->load->helper('string');
    }

    /** */
    public function receipt()
    {
        $this->_data['receipt_num'] = random_string('numeric', 8);
        $this->_data['receipt_date'] = date('Y-m-d');
        $ids = $this->uri->segment(5);
        $ids = explode('-', $ids);
        $this->_data['results'] = $this->Receipt_model->all($ids);
        $this->load->view('admin/report/print/receipt', $this->_data);
    }

    /** */
    public function card()
    {
        $this->layout->title = 'Print Report';
        $id = $this->uri->segment(6);
        
        $this->load->model('admin/report/Report_model', 'report');
        $this->_data['result'] = $this->report->get_lab_report($id);
        
        if($this->uri->segment(5) == 'memo')
        {
            $this->load->view('admin/report/print/memocard', $this->_data);
        } 
        elseif ($this->uri->segment(5) == 'repo') 
        {
            $this->load->view('admin/report/print/full_report', $this->_data);
        } 
        elseif ($this->uri->segment(5) == 'verb') 
        {
            redirect('admin/report/published');
        } 
        
    }

    public function data_image()
    {
        $this->layout->title = 'Download Data Image';
        $id = $this->uri->segment(6);
        
        $this->load->model('admin/report/Report_model', 'report');
        $this->_data['result'] = $this->report->get_lab_report($id);

        $this->layout->assets(base_url('assets/vendors/print/html2canvas.min.js'), 'footer'); 
        $this->layout->assets(base_url('assets/admin/js/data_image.js'), 'footer');

        if($this->uri->segment(5) == 'memo')
        {
            $this->layout->view('admin/report/print/data_image', $this->_data, 'without');
        } 

    }
}
?>