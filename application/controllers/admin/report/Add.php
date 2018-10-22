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
    $this->layout->add_include('assets/admin/css/bootstrap-select.min.css');
    $this->layout->add_include('assets/admin/css/easy-autocomplete.min.css');
    $this->layout->add_include('assets/admin/css/file-upload-with-preview.min.css');
    $this->layout->add_include('assets/admin/js/report.js');
    $this->layout->add_include('assets/admin/js/file-upload-with-preview.min.js');
    $this->layout->add_include('assets/admin/js/jquery.easy-autocomplete.min.js');
    $this->layout->add_include('assets/admin/js/bootstrap-select.min.js');

    $this->layout->view('admin/lab/report/add', $this->_data, 'admin/layouts/admin');
  }

  /*****/
  public function insert_todb()
  {
    $this->_id = $this->input->post('rmid');
    $this->_report_type = $this->input->post('repo-type');

    if(!$this->form_verification())
    {
      echo json_encode(array('authentication'=>false, 'message'=>validation_errors()));
      return false;
    }

    $this->_labreport_id = $this->Report_model->insert_lab_report($this->lab_data());

    if(is_null($this->_labreport_id))
    {
      return $this->_json_reponse = array('authentication'=>false, 'message'=>'Error when inserting, Please try again...');
    }

    if($this->_report_type == 'memo')
    {
      $this->set_reportid($this->_id);
      $this->Report_model->insert_memocard($this->memo_data());
      $this->_json_reponse = array('isvalid'=>true, 'url'=>base_url().'admin/report/download/'.$this->_labreport_id, 'message'=>'Data Updated successfully, Redirecting...');
    }
    elseif ($this->_report_type == 'repo')
    {
      $this->set_reportid($this->_id);
      $this->Report_model->insert_certificate($this->certificate_data());
      $this->_json_reponse = array('isvalid'=>true, 'url'=>base_url().'admin/report/download/'.$this->_labreport_id, 'message'=>'Data Updated successfully, Redirecting...');
    }
    elseif ($this->_report_type == 'verb')
    {
      $this->Report_model->insert_verbal($this->verbal_data());
      $this->_json_reponse = array('isvalid'=>true, 'url'=>base_url().'admin/customer', 'message'=>'Data Updated successfully, Redirecting...');
    }

    $this->create_directory();
    if(is_uploaded_file($_FILES['imagegem']['tmp_name']))
    {
      $this->set_imagename($_FILES['imagegem']['name']);
      $upload_status = $this->upload_image('imagegem');
      if($upload_status != null)
      {
        echo json_encode(array('authentication'=>false, 'message'=>$upload_status));
        return false;
      }

      if ($this->Report_model->insert_image($this->image_data()) < 0 )
      {
        echo json_encode(array('authentication'=>false, 'message'=>'Error when inserting image, Please try again...'));
        return false;
      }
    }

    echo json_encode($this->_json_reponse);
  }
}
?>
