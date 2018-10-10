<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Add extends RP_Controller
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

    //$this->load->helper(array('form', 'encrypt'));
    $this->load->model(array('Lab_model', 'Report_model'));

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }
  }

  /*****/
  public function index()
  {
    $this->customer();

    $this->layout->set_title('Add Report');
    $this->layout->add_include('assets/admin/css/file-upload-with-preview.min.css');
    $this->layout->add_include('assets/admin/js/report.js');
    $this->layout->add_include('assets/admin/js/file-upload-with-preview.min.js');

    $this->layout->view('admin/lab/report/add', $this->_data, 'admin/layouts/admin');
  }

  /*****/
  public function insert_todb()
  {
    $this->_id = $this->input->post('rmid');
    $this->_report_type = $this->input->post('repo-type');

    if(!$this->form_verification())
    {
      echo validation_errors();
      return $this->_json_reponse = array('authentication'=>false, 'message'=>validation_errors());
    }

    $this->_labreport_id = $this->Report_model->insert_lab_report($this->lab_data());

    if(is_null($this->_labreport_id))
    {
      return $this->_json_reponse = array('authentication'=>false, 'message'=>'Error when inserting, Please try again...');
    }

    $this->create_directory();
    if(is_uploaded_file($_FILES['imagegem']['tmp_name']))
    {
      $this->set_imagename($_FILES['imagegem']['name']);
      $upload_status = $this->upload_image('imagegem');
      if($upload_status != null)
      {
        return $this->_json_reponse = array('authentication'=>false, 'message'=>$upload_status);
      }

      if ($this->Report_model->insert_image($this->image_data()) < 0 )
      {
        return $this->_json_reponse = array('authentication'=>false, 'message'=>'Error when inserting image, Please try again...');
      }
    }

    if($this->_report_type == 'memo')
    {
      $this->set_reportid($this->_id);
      $this->Report_model->insert_memocard($this->memo_data());
    }
    elseif ($this->_report_type == 'repo')
    {
      $this->set_reportid($this->_id);
      $this->Report_model->insert_certificate($this->certificate_data());
    }
    elseif ($this->_report_type == 'verb')
    {
      $this->Report_model->insert_verbal($this->verbal_data());
    }

    return $this->_json_reponse = array('authentication'=>true, 'message'=>'Data added successfully, Redirecting...');
  }
}
?>
