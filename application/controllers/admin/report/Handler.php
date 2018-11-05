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



  /****/
  protected function check_default($post_string)
  {
    return $post_string == 'default' ? FALSE : TRUE;
  }

  /****/
  protected function form_verification()
  {
    if($this->_report != 'verb')
    {
      $this->form_validation->set_rules('pstatus','PaymentStatus','required|callback_check_default', array('check_default'=>'Please select your payment status'));
      $this->form_validation->set_rules('amount','Amount','trim|required|decimal');
    }
    $this->form_validation->set_rules('gemid','Gemstone','required|callback_check_default', array('check_default'=>'Please select a gemstone from the list'));
    $this->form_validation->set_message('check_gemstone', 'Please select a gemstone from the list');
    $this->form_validation->set_rules('rmid','ID','trim|required|alpha_dash');
    $this->form_validation->set_rules('object','Object','trim|required');
    $this->form_validation->set_rules('variety','Variety','trim|required');
    $this->form_validation->set_rules('weight','Weight','trim|required|decimal');
    $this->form_validation->set_rules('spgroup','Species/Group','trim');
    $this->form_validation->set_rules('gemWidth','Width','trim|decimal');
    $this->form_validation->set_rules('gemHeight','Height','trim|decimal');
    $this->form_validation->set_rules('gemLength','Length','trim|decimal');
    $this->form_validation->set_rules('color','Color','trim');
    $this->form_validation->set_rules('shapecut','Shape','trim');
    $this->form_validation->set_rules('other','Other','trim');
    $this->form_validation->set_rules('comment','Comment','trim');

    if($this->form_validation->run() == FALSE) return false;

    return true;
  }

  /****/
  public function insert()
  {
    $this->_id = $this->input->post('rmid');
    $this->_report = $this->input->post('repo-type');

    if(!$this->form_verification()) return $this->json_output(false, validation_errors());

    $img_name = $this->create_image_name();

    // CALL SP

    $upload_status = $this->upload_image('imagegem', $img_name);

    if($upload_status != null) return $this->json_output(false, $upload_status);

    return $this->json_output(true, 'Your Report was successfully created', 'admin/report');
  }

  /****/
  protected function set_image_properties($image)
  {

  }

  /****/
  public function create_image_name()
  {
    $image_name = $_FILES['imagegem']['name'];
    if(!isset($image_name))
    {
      $img_string = '';
      return $img_string;
    }

    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
    $img_string = $this->_id.".".$ext;
    if(file_exists($this->_img_path.'/'.$img_string))
    {
      $file_parts = pathinfo($image);
      $extension = $file_parts['extension'];
      $filename = $file_parts['filename'];
      $renamed_image = $filename.'-'.rand(1, 10).'.'.$extension;
    }
    else {
      $renamed_image = $img_string;
    }
    return $renamed_image;
  }

  /*****/
  public function upload_image($file_input, $image_name)
  {
    if(is_uploaded_file($_FILES['imagegem']['tmp_name'])) return null;

    $config = array();

    $config['file_name'] = $image_name;
    $config['upload_path'] =
    $config['allowed_types'] = $this->config->item('img_types');
    $config['max_size'] = $this->config->item('img_size');
    $config['max_width'] = $this->config->item('img_width');
    $config['max_height'] = $this->config->item('img_height');

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload($file_input))
    {
      return $this->upload->display_errors();
    }
    return null;
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

  /**
   * Creating Sub directory inside Main directory
   * (assets/images/Memocard/GCL-100001)
   *
   * @param null
   * @return null
   */
  public function create_directory()
  {
    switch ($this->_report_type) {
      case 'memo':
        $base_directory = $this->config->item('img_basepath').$this->config->item('img_folder_a');
        if (file_exists($base_directory))
        {
          $this->_img_path = $base_directory.'/'.$this->_labreport_id;

          if (!file_exists($this->_img_path)) mkdir($this->_img_path, 0777, true);
        }
        else
        {
          mkdir($base_directory, 0777, true);
        }
        break;

      case 'repo':
        $base_directory = $this->config->item('img_basepath').$this->config->item('img_folder_b');
        if (file_exists($base_directory))
        {
          $this->_img_path = $base_directory.'/'.$this->_labreport_id;

          if (!file_exists($this->_img_path)) mkdir($this->_img_path, 0777, true);
        }
        else
        {
          mkdir($base_directory, 0777, true);
        }
        break;

      case 'verb':
        $base_directory = $this->config->item('img_basepath').$this->config->item('img_folder_c');
        if (file_exists($base_directory))
        {
          $this->_img_path = $base_directory.'/'.$this->_labreport_id;

          if (!file_exists($this->_img_path)) mkdir($this->_img_path, 0777, true);
        }
        else
        {
          mkdir($base_directory, 0777, true);
        }
        break;
    }
  }

}
?>
