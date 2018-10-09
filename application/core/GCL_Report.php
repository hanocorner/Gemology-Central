<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GCL_Report extends CI_Controller
{
  /**
   * MYSQL generated lab report id
   *
   * @var mixed
   */
  protected $_labreport_id = null;

  /*****/
  protected $_id = '';

  /*****/
  protected $_report_type = '';

  /****/
  protected $_result = array();

  /****/
  protected $_data = array();

  /****/
  public $_json_reponse = array();

  /******/
  private $_renamed_image = '';

  /****/
  public function __construct(){
    parent::__construct();

    $this->load->library('layout', array('layoutManager'=>'admin'));
    $this->load->helper(array('form'));
    $this->load->model(array('Customer_model'));
    $this->config->load('report');
  }

  /*****/
  protected function customer()
  {
    if($this->session->has_userdata('customerid'))
    {
      $this->_result = $this->Customer_model->get_customer_by_id($this->session->customerid);
      $this->_data['name'] = ucwords($this->_result[0]->cus_firstname)." ".$this->_result[0]->cus_lastname;
      $this->_data['cid'] = $this->_result[0]->custid;
    }
    redirect('admin/report');
  }


  /****/
  protected function form_verification()
  {
    /*if($this->_reptype != 'verb')
    {
      $this->form_validation->set_rules('amount','Amount','trim|required|decimal');
    }*/

    $this->form_validation->set_rules('rmid','ID','trim|required|alpha_dash');
    $this->form_validation->set_rules('object','Object','trim|required|callback_alpha_dash_space');
    $this->form_validation->set_rules('variety','Variety','trim|required|callback_alpha_dash_space');
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
      'rep_customerID'=>$this->encrypt->decode($this->session->customerid),
      'rep_date'=>date($this->_date_format),
      'rep_type'=>$this->get_report_type(),
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
      'gsr_date'=>date($this->_date_format),
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
      'veb_date'=>date($this->_date_format),
    );

    return $this->_data;
  }

  /****/
  public function image_data()
  {
    $this->_data = array(
      'reportid'=>$this->_labreport_id,
      'img_gemstone'=>$this->_renamed_image,
      'img_qrcode'=>$this->_qr,
      'img_date'=>date($this->_date_format)
    );

    return $this->_data;
  }

  /****/
  protected function set_imagename($file_name)
  {
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $this->_renamed_image = $this->_id.".".$ext;
  }

  /*****/
  public function get_imagename()
  {
    return $this->_renamed_image;
  }

  public function upload_image()
  {
    $config = array();

    $config['file_name'] = $this->get_imagename();
    $config['upload_path'] =
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
   * Creating Main directory inside images folder
   * (assets/images/Memocard)
   *
   * @param null
   * @return mixed bool | null
   */
  public function create_main_directory()
  {
    $folder_a = $this->config->item('img_basepath').$this->config->item('img_folder_a');
    $folder_b = $this->config->item('img_basepath').$this->config->item('img_folder_b');
    $folder_c = $this->config->item('img_basepath').$this->config->item('img_folder_c');

    if (!file_exists($folder_a))
    {
      mkdir($folder_a, 0777, true);
    }
    elseif (!file_exists($folder_b))
    {
      mkdir($folder_b, 0777, true);
    }
    elseif (!file_exists($folder_c))
    {
      mkdir($folder_c, 0777, true);
    }
    else
    {
      return;
    }
  }

  /**
   * Creating Sub directory inside Main directory
   * (assets/images/Memocard/GCL-100001)
   *
   * @param null
   * @return mixed bool | null
   */
  public function create_sub_directory($dir_name)
  {
    if(!is_int($dir_name)) return false;

    if ($this->_report_type == 'memo')
    {
      $directory = $this->config->item('img_basepath').$this->config->item('img_folder_a').'/'.$dir_name;
    }
    elseif ($this->_report_type == 'repo')
    {
      $directory = $this->config->item('img_basepath').$this->config->item('img_folder_b').'/'.$dir_name;
    }
    elseif ($this->_report_type == 'verb')
    {
      $directory = $this->config->item('img_basepath').$this->config->item('img_folder_c').'/'.$dir_name;
    }
    mkdir($directory, 0777, true);
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
