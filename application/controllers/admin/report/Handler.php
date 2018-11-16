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
  protected $_img_name = "";

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


    $this->load->library(array('encryption', 'image'));
    $this->load->model(array('Lab_model', 'Report_model', 'admin/report/Data_model'));

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

    $this->load->helper('dir');

    $this->next_id = $this->input->post('rmid');
    $this->report_type = $this->input->post('repotype');

    if($this->form_validation->run('report') == FALSE) return $this->json_output(false, validation_errors());

    if(isset($_FILES['imagegem']['tmp_name']))
    {
      $this->image->img_path(create_directory($this->report_type, $this->config->item('img_subdir')));
      $img_name = $this->image->img_name($_FILES['imagegem']['name'], $this->next_id);

      $upload = $this->image->img_upload('imagegem');
      if($upload == false) return $this->json_output(false, $this->image->errors);
      $this->_img_name = $upload;
    }

    $this->_data = $_POST;
    $this->_data['img_gem'] = $this->_img_name;
    $this->_data['cdate'] = date('Y-m-d');
    $this->_data['qrcode'] = base_url()."report/GCL-1000001";

    $result = $this->Data_model->insert_report($this->_data);

    if($result < 1 )
    {
      return $this->json_output(false, 'Insertion unsuccessful');
    }

    return $this->json_output(true, 'Insertion successfull', 'admin/report');
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


  /**
   * Setting id according to report type selected by user
   *
   * @param null
   * @return null
   */
  public function id()
  {
    $this->report_type = $this->input->get('repotype');

    $this->load->library('id');
    $this->load->model('admin/report/Id_model', 'idm');

    $lastid = '';
    $format = array();

    if($this->report_type === 'memo')
    {
      $this->idm->set_table('tbl_gem_memocard');
      $lastid = $this->idm->get_id('id');
      $format = array('separator'=>'-');
    }
    elseif ($this->report_type === 'repo')
    {
      $this->idm->set_table('tbl_gemstone_report');
      $lastid = $this->idm->get_id('id');
      $format = array('identifier'=>date('Y'), 'separator'=>'-', 'month'=>date('m'));
    }
    elseif ($this->report_type === 'verb')
    {
      $this->idm->set_table('tbl_gem_verbal');
      $lastid = $this->idm->get_id('id');
      $format = array('identifier'=>'V', 'separator'=>'-');
    }

    $this->id->set_lastid($lastid);
    $this->id->set_format($format);
    echo $this->id->create_id();
  }


}
?>
