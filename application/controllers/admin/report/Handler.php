<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Handler extends Admin_Controller
{
  /**
   * Report ID
   *
   * @var string
   */
  protected $next_id = '';

  /**
   * Report Type
   *
   * @var string
   */
  protected $report_type = '';

  /**
   * Report Image name
   *
   * @var string
   */
  protected $_img_name = '';

  /**
   * Constructor initializing  all the the required classes
   *
   * @param none
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->check_login_status();

    $this->load->helper('dir');
    $this->load->library(array('encryption', 'image'));
    $this->load->model(array('Lab_model', 'Report_model'));

    $this->config->load('report');

    $this->encryption->initialize(array('driver' => 'mcrypt'));
  }

  /**
   *
   *
   */
  public function index()
  {
    $this->layout->set_title('My Reports');
    $this->layout->view('admin/lab/report/index', '', 'admin/layouts/admin');
  }

  /****/
  public function add()
  {
    $this->layout->set_title('Add Report');
    $this->layout->add_include('assets/admin/css/bootstrap-select.min.css');
    $this->layout->add_include('assets/admin/css/easy-autocomplete.min.css');
    $this->layout->add_include('assets/admin/css/file-upload-with-preview.min.css');
    $this->layout->add_include('assets/admin/js/report.js');
    $this->layout->add_include('assets/admin/js/report/add.js');
    $this->layout->add_include('assets/admin/js/file-upload-with-preview.min.js');
    $this->layout->add_include('assets/admin/js/jquery.easy-autocomplete.min.js');
    $this->layout->add_include('assets/admin/js/bootstrap-select.min.js');

    $this->layout->view('admin/lab/report/add', '', 'admin/layouts/admin');
  }

  /****/
  public function insert()
  {
    if(!$this->ajax_login_status())
    {
      return $this->json_output(true,'','admin/home');
    }

    $this->next_id = $this->input->post('rmid');
    $this->report_type = $this->input->post('repo-type');

    if($this->form_validation->run('report') == FALSE) return $this->json_output(false, validation_errors());

    if(is_uploaded_file($_FILES['imagegem']['tmp_name']))
    {
      $img_name = $this->image->img_name($_FILES['imagegem']['name'], $this->next_id);
      $this->image->img_path(create_directory($this->report_type, $this->config->item('img_subdir')));

      $upload = $this->image->img_upload('imagegem');
      if($upload == false) return $this->json_output(false, $this->image->errors);
      $this->_img_name = $upload;
    }

    // CALL SP

    return $this->json_output(true, 'Your Report was successfully created', 'admin/report');
  }

  /*****/
  public function edit()
  {

  }

  /****/
  public function update()
  {
    if(!$this->ajax_login_status())
    {
      return $this->json_output(true,'','admin/home');
    }

    $this->next_id = $this->input->post('rmid');
    $this->report_type = $this->input->post('repo-type');

    if($this->form_validation->run('report') == FALSE) return $this->json_output(false, validation_errors());

    if(is_uploaded_file($_FILES['imagegem']['tmp_name']))
    {
      $img_name = $this->image->img_name($_FILES['imagegem']['name'], $this->next_id);
      $this->image->img_path(create_directory($this->report_type, $this->config->item('img_subdir')));

      $upload = $this->image->img_upload('imagegem');
      if($upload == false) return $this->json_output(false, $this->image->errors);
      $this->_img_name = $upload;
    }

    qrcode($this->qr_data());
    $this->_data['nextid'] = $this->next_id;
    $this->_data['type'] = $this->report_type;
    $this->_data['qr'] = $this->qr_data();
    $this->_data['imgname'] = $this->_img_name;

    $this->Data_model->insert_report($this->_data);
    // CALL SP

    return $this->json_output(true, 'Your Report was successfully created', 'admin/report');
  }

  /****/
  public function qr_data()
  {
    //$this->encryption->encrypt($this->next_id)
    return base_url().'report/'.$this->next_id;
  }

  /**
   * This check the dropdown list default value
   *
   * @param string $post_string value from dropdown
   * @return bool
   */
  public function check_default($post_string)
  {
    return $post_string == 'default' ? FALSE : TRUE;
  }


}
?>
