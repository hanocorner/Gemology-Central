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
    }

    /** */
    public function receipt()
    {
        $receipt_no = 'GCL-'.rand(10000, 10000);

        $this->_data['results'] = $this->Receipt_model->all();
        $this->load->view('admin/report/print/receipt', $this->_data);
    }
}
?>