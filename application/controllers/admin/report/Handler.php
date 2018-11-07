<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Handler extends Admin_Controller
{
  /**
   * Report Type
   *
   * @var string
   */
  protected $_report = '';

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

    $this->load->helper('directory');
    $this->load->library('image');
    $this->load->model(array('Lab_model', 'Report_model'));
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
    if($this->customer() == FALSE) redirect('admin/report');
    $this->_title = 'Add Report';
    $this->form_report();
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


  /****/
  public function insert()
  {
    if(!$this->ajax_login_status())
    {
      return $this->json_output(true,'','admin/home');
    }

    $this->_id = $this->input->post('rmid');
    $this->_report = $this->input->post('repo-type');
    $img_name = '';

    if($this->form_validation->run('report') == FALSE) return $this->json_output(false, validation_errors());

    if(is_uploaded_file($_FILES['imagegem']['tmp_name']))
    {
      $img_name = $this->image->img_name($_FILES['imagegem']['name'], $this->_id);
      $upload = $this->image->img_upload('imagegem');
      if($upload == false) return $this->json_output(false, $this->image->errors);
      $img_name = $upload;
    }



    // CALL SP



    return $this->json_output(true, 'Your Report was successfully created', 'admin/report');
  }

  /****/
  protected function set_image_properties($image)
  {

  }





  /**
   * Creating Sub directory inside Main directory
   * (assets/images/Memocard/GCL-100001)
   *
   * @param null
   * @return string sub folder
   */
  public function create_directory()
  {
    $directory = array('Memocard', 'Certificate', 'Verbal');
    foreach ($directory as $folder)
    {
      $basedir = $this->config->item('img_basepath').$key_folder;
      $current_year_folder = date('Y');
      $current_month_folder = date('m');
      if(!file_exists($basedir.'/'.$current_year_folder.'/'.$current_month_folder))
      {
        mkdir($basedir.'/'.$current_year_folder.'/'.$current_month_folder, 0777, true);
      }

      return $current_year_folder.'/'.$current_month_folder;
    }
  }

  /*****/
  public function edit()
  {
    if($this->customer() == FALSE) redirect('admin/report');
    $this->_title = 'Edit Report';
    $this->form_report();
  }

  /****/
  public function FunctionName($value='')
  {
    // code...
  }



}
?>
