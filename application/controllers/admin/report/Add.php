<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Add extends GCL_Report
{
  /**
   * Constructor initializing  all the the required classes
   *
   * @param none
   * @return void
   */
  public function __construct()
  {
    parent::__construct();

    $config = array('layoutManager'=>'admin');
    $this->load->library('layout', $config);
    $this->load->library(array('session'));

    $this->load->helper(array('form'));
    $this->load->model(array('Lab_model', 'Report_model'));

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }


  }

  public function index()
  {
    $this->customer();

    $this->layout->set_title('Add Report');
    $this->layout->add_include('assets/admin/css/file-upload-with-preview.min.css');
    $this->layout->add_include('assets/admin/js/report.js');
    $this->layout->add_include('assets/admin/js/file-upload-with-preview.min.js');

    $this->layout->view('admin/lab/report/add_report', $this->_data, 'admin/layouts/admin');
  }

  /*****/
  public function insert_todb()
  {
    $this->_id = $this->input->post('rmid');
    $this->set_report_type($this->input->post('repo-type'));

    if(!$this->form_verification())
    {
      $this->_json_reponse = array('authentication'=>false, 'message'=>validation_errors());
      return false;
    }

    $lab_data = $this->lab_data();
    $this->_labreport_id = $this->Report_model->insert_lab_report($lab_data);

    if(is_null($this->_labreport_id))
    {
      $this->_json_reponse = array('authentication'=>false, 'message'=>'Error when inserting, Please try again...');
      return false;
    }

    if(is_uploaded_file($_FILES['imagegem']['tmp_name']))
    {
      $this->set_image_path($dir_name);
      $this->_file_name = $_FILES['imagegem']['name'];
      $this->_renamed_image = $this->set_imagename();
      $upload = $this->upload_image('imagegem');
      if($upload != null) return $this->set_message($upload);
    }

  }
}
?>
