<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Edit extends RP_Controller
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

  /****/
  public function news()
  {
    $this->customer();
    $this->_data['id'] = $this->uri->segment(5);
    $this->layout->set_title('Edit Report');
    $this->layout->add_include('assets/admin/css/file-upload-with-preview.min.css');
    $this->layout->add_include('assets/admin/js/report.js');
    $this->layout->add_include('assets/admin/js/file-upload-with-preview.min.js');

    $this->layout->view('admin/lab/report/edit', $this->_data, 'admin/layouts/admin');
  }

  /****/
  public function append_toedit()
  {
    $id = $this->input->get('labrepid');
    $this->_json_reponse = $this->Report_model->get_data_by_mrid($id);
    echo json_encode($this->_json_reponse);
  }

  /****/
  public function update_todb()
  {
    $this->_id = $this->input->post('rmid');
    $this->_labreport_id = $this->input->post('labrepid');
    $this->_report_type = $this->input->post('report_type');

    if(!$this->form_verification())
    {
      return $this->_json_reponse = array('authentication'=>false, 'message'=>validation_errors());
    }

    $this->Report_model->update_lab_report($this->lab_data(), $this->session->customerid, $this->_labreport_id);

    $this->create_directory();
    if(is_uploaded_file($_FILES['imagegem']['tmp_name']))
    {
      $this->set_imagename($_FILES['imagegem']['name']);
      $upload_status = $this->upload_image('imagegem');
      if($upload_status != null)
      {
        return $this->_json_reponse = array('authentication'=>false, 'message'=>$upload_status);
      }

      if ($this->Report_model->update_image($this->image_data(), $this->_labreport_id) < 0 )
      {
        return $this->_json_reponse = array('authentication'=>false, 'message'=>'Error when updating image, Please try again...');
      }
    }

    if($this->_report_type == 'memo')
    {
      echo 'hello';
      $this->set_reportid($this->_id);
      $this->Report_model->update_memo($this->memo_data(), $this->_labreport_id);
    }
    elseif ($this->_report_type == 'repo')
    {
      $this->set_reportid($this->_id);
      $this->Report_model->update_repo($this->certificate_data(), $this->_labreport_id);
    }
    elseif ($this->_report_type == 'verb')
    {
      $this->Report_model->update_verbal($this->verbal_data(), $this->_labreport_id);
    }

    return $this->_json_reponse = array('authentication'=>true, 'message'=>'Data Updated successfully, Redirecting...');
  }

}
?>
