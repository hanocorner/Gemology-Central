<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class RP_Controller extends CI_Controller
{
  /**
   * System generated ID
   *
   * @var string
   */
  protected $_id = '';

  /**
   * MYSQL generated lab report id
   *
   * @var int
   */
  protected $_labreport_id = 100;

  /*****/
  protected $_report_type = '';

  /****/
  protected $_db_result = array();

  /****/
  protected $_data = array();

  /****/
  public $_json_reponse = array();

  /******/
  private $_renamed_image = '';

  /****/
  protected $_img_path = '';

  /****/
  public function __construct(){
    parent::__construct();

    $this->load->library('layout', array('layoutManager'=>'admin'));
    $this->load->helper(array('form'));
    $this->load->library('encrypt');
    $this->load->model(array('Customer_model'));
    $this->config->load('report');
  }

  /*****/
  protected function customer()
  {
    if($this->session->has_userdata('customerid'))
    {
      $this->_db_result = $this->Customer_model->get_customer_by_id($this->session->customerid);
      $this->_data['name'] = ucwords($this->_db_result[0]->cus_firstname)." ".$this->_db_result[0]->cus_lastname;
      $this->_data['cid'] = $this->_db_result[0]->custid;
    }
    else
    {
      redirect('admin/report');
    }
  }


  /****/
  protected function form_verification()
  {
    /*if($this->_reptype != 'verb')
    {
      $this->form_validation->set_rules('amount','Amount','trim|required|decimal');
    }*/

    $this->form_validation->set_rules('rmid','ID','trim|required|alpha_dash');
    $this->form_validation->set_rules('object','Object','trim|required');
    $this->form_validation->set_rules('variety','Variety','trim|required');
    $this->form_validation->set_rules('weight','Weight','trim|required|decimal');
    $this->form_validation->set_rules('spgroup','Species/Group','trim');
    $this->form_validation->set_rules('gemWidth','Width','trim|decimal');
    $this->form_validation->set_rules('gemHeight','Height','trim|decimal');
    $this->form_validation->set_rules('gemLength','Length','trim|decimal');
    $this->form_validation->set_rules('color','Color','trim');
    $this->form_validation->set_rules('shapecut','Shape','trim|alpha');
    $this->form_validation->set_rules('other','Other','trim');
    $this->form_validation->set_rules('comment','Comment','trim');

    if($this->form_validation->run() == FALSE) return false;

    return true;
  }

  /*****/
  public function lab_data()
  {
    $this->_data = array(
      'rep_customerID'=>$this->session->customerid,
      'rep_date'=>date('Y-m-d'),
      'rep_type'=>$this->_report_type,
      'rep_object'=>$this->input->post('object'),
      'rep_variety'=>$this->input->post('variety'),
      'rep_weight'=>$this->input->post('weight'),
      'rep_spgroup'=>$this->input->post('spgroup'),
      'rep_gemID'=>$this->input->post('gemid'),
      'rep_shapecut'=>$this->input->post('shapecut'),
      'rep_gemWidth'=>$this->input->post('gemWidth'),
      'rep_gemHeight'=>$this->input->post('gemHeight'),
      'rep_gemLength'=>$this->input->post('gemLength'),
      'rep_color'=>$this->input->post('color'),
      'rep_other'=>$this->input->post('other'),
      'rep_comment'=>$this->input->post('comment')
    );

    return $this->_data;
  }

  /*****/
  public function memo_data()
  {
    $this->_data = array(
      'memoid'=>$this->_id,
      'reportid'=>$this->_labreport_id,
      'mem_date'=>date('Y-m-d'),
      'mem_paymentStatus'=>$this->input->post('pstatus'),
      'mem_amount'=>$this->input->post('amount')
    );
    return $this->_data;
  }

  /*****/
  public function certificate_data()
  {
    $this->_data = array(
      'gsrid'=>$this->_id,
      'reportid'=>$this->_labreport_id,
      'gsr_date'=>date('Y-m-d'),
      'gsr_paymentStatus'=>$this->input->post('pstatus'),
      'gsr_amount'=>$this->input->post('amount')
    );
    return $this->_data;
  }

  public function verbal_data()
  {
    $this->_data = array(
      'verbid'=>$this->_id,
      'reportid'=>$this->_labreport_id,
      'veb_date'=>date('Y-m-d'),
    );
    return $this->_data;
  }

  /****/
  public function image_data()
  {
    $this->_data = array(
      'reportid'=>$this->_labreport_id,
      'img_gemstone'=>$this->get_imagename(),
      'img_date'=>date('Y-m-d'),
      'img_path'=>$this->_img_path
    );
    return $this->_data;
  }

  /****/
  public function set_imagename($image_name)
  {
    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
    $image = $this->_id.".".$ext;
    if(file_exists($this->_img_path.'/'.$image))
    {
      $file_parts = pathinfo($image);
      $extension = $file_parts['extension'];
      $filename = $file_parts['filename'];
      $this->_renamed_image = $filename.'-'.rand(1, 10).'.'.$extension;
    }
    else {
      $this->_renamed_image = $image;
    }
  }

  /*****/
  public function get_imagename()
  {
    return $this->_renamed_image;
  }

  public function upload_image($file_input)
  {
    $config = array();

    $config['file_name'] = $this->get_imagename();
    $config['upload_path'] = $this->_img_path;
    $config['allowed_types'] = $this->config->item('allowed_types');
    $config['max_size'] ='200000';
    $config['max_width'] ='1024';
    $config['max_height'] ='1024';

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

  /*****/
  protected function set_reportid($reportid)
  {
    if(!$this->session->has_userdata('reportid'))
    {
      $this->session->set_userdata('reportid', $this->encrypt->encode($reportid));
    }
  }

  /****/
  protected function get_reportid()
  {
    return $this->encrypt->decode($this->session->reportid);
  }
}
?>
