<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends CI_Controller
{
  /**
   * System generated report id
   *
   * @var string
   */
  private $_id = '';

  /**
   * MYSQL generated lab report id
   *
   * @var mixed
   */
  private $_labreport_id = null;

  /**
   * Report type selected by the user
   *
   * @var string
   */
  private $_reptype = '';

  /*****/
  public $_date_format = 'Y-m-d';

  /****/
  protected $_renamed_image = '';

  /****/
  protected $_file_name = '';

  /****/
  private $_qr = null;

  /****/
  private $__weight= '';

  /*****/
  public function add()
  {
    $customer = $this->set_customer();
    if(!$customer) redirect('admin/customer');

    $data['name'] = ucwords($customer[0]->cus_firstname)." ".$customer[0]->cus_lastname;
    $data['cid'] = $customer[0]->custid;
    $this->report_form($data);
  }

  /*****/
  public function insert_todb()
  {
    $this->_id = $this->input->post('rmid');
    $this->_reptype = $this->input->post('repo-type');
    //$this->_weight = $this->input->post('weight');

    if($this->_reptype != 'verb')
    {
      $this->form_validation->set_rules('amount','Amount','trim|required|decimal');
    }

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

    if($this->form_validation->run() == FALSE)
    {
      $this->add();
      return false;
    }

    if($this->insert_labdata() == FALSE)
    {
      $this->set_message('Problem when uploading data to the database');
      return $this->add();
    }

    if(is_uploaded_file($_FILES['imagegem']['tmp_name']))
    {
      $this->_file_name = $_FILES['imagegem']['name'];
      $this->_renamed_image = $this->set_imagename();
      $upload = $this->upload_image('imagegem');
      if($upload != null) return $this->set_message($upload);
    }

    $this->_qr = $this->qr();
    $this->insert_imagedata();
    $this->session->set_userdata('qrcode', $this->_id);

    if($this->_reptype == 'memo')
    {
      if($this->insert_memodata() == FALSE)
      {
        $this->add();
        $this->set_message('Problem when uploading data to the database');
      }
    }
    elseif ($this->_reptype == 'repo')
    {
      if($this->insert_certificatedata() == FALSE)
      {
        $this->add();
        $this->set_message('Problem when uploading data to the database');
      }
    }
    elseif ($this->_reptype == 'verb')
    {
      if($this->insert_verbaldata() == FALSE)
      {
        $this->add();
        $this->set_message('Problem when uploading data to the database');
      }
      redirect('admin/customer');
    }

    $this->session->unset_userdata('customerid');
    redirect('admin/report/download');
  }

  /*****/
  protected function insert_labdata()
  {
    $repodata = array(
      'rep_customerID'=>$this->session->customerid,
      'rep_date'=>date($this->_date_format),
      'rep_type'=>$this->_reptype,
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

    $this->_labreport_id = $this->Report_model->insert_lab_report($repodata);
    if(is_null($this->_labreport_id)) return false;

    return true;
  }

  /****/
  protected function insert_memodata()
  {
    $data = array(
      'memoid'=>$this->_id,
      'reportid'=>$this->_labreport_id,
      'mem_date'=>date($this->_date_format),
      'mem_paymentStatus'=>$this->input->post('pstatus'),
      'mem_amount'=>$this->input->post('amount')
    );

    $fkey = $this->Report_model->insert_memocard($data);
    if ($fkey < 1) return $fkey;
    return false;
  }

  /*****/
  protected function insert_certificatedata()
  {
    $certdata = array(
      'gsrid'=>$this->_id,
      'reportid'=>$this->_labreport_id,
      'gsr_date'=>date($this->_date_format),
      'gsr_paymentStatus'=>$this->input->post('pstatus'),
      'gsr_amount'=>$this->input->post('amount')
    );

    $fkey = $this->Report_model->insert_certificate($certdata);
    if ($fkey < 1) return true;
    return false;
  }

  /*****/
  protected function insert_verbaldata()
  {
    $verbdata = array(
      'verbid'=>$this->_id,
      'reportid'=>$this->_labreport_id,
      'veb_date'=>date($this->_date_format),
    );

    $affected_rows = $this->Report_model->insert_verbal($verbdata);
    if ($affected_rows > 0) return true;
    return false;
  }

  /*****/
  protected function insert_imagedata()
  {
    $imgdata = array(
      'reportid'=>$this->_labreport_id,
      'img_gemstone'=>$this->_renamed_image,
      'img_qrcode'=>$this->_qr,
      'img_date'=>date($this->_date_format)
    );

    $fkey = $this->Report_model->insert_image($imgdata);
    if ($fkey < 1) return true;
    return false;
  }

  /****/
  protected function set_imagename()
  {
    $ext = pathinfo($this->_file_name, PATHINFO_EXTENSION);
    return $this->_id.".".$ext;
  }

  /*****/
  protected function upload_image($file_input)
  {
    $config['file_name'] = $this->_renamed_image;
    $config['upload_path'] ='./assets/admin/images/gem/';
    $config['allowed_types'] ='gif|jpg|png|jpeg';
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

  /****/
  public function download()
  {

  }

  /*****/
  public function download_qr()
  {
    $this->_id = $this->session->qrcode;
    $this->load->helper('download');
    $qrcode = $this->qr();
    $data = file_get_contents(base_url().'assets/admin/images/qr/'.$qrcode);
    force_download($qrcode, $data);
  }

  /*****/
  protected function report_form($data)
  {
    $this->layout->set_title('Add Report');
    $this->layout->add_include('assets/admin/css/file-upload-with-preview.min.css');
    $this->layout->add_include('assets/admin/js/report.js');
    $this->layout->add_include('assets/admin/js/file-upload-with-preview.min.js');

    $this->layout->view('admin/lab/report/add_report', $data, 'admin/layouts/admin');
  }

  /*****/
  public function edit()
  {
    $id = $this->uri->segment(5);
    $type = $this->uri->segment(4);

    if (!$this->uri->segment(4) || !$this->uri->segment(5)) redirect('admin/customer');

    if(!$this->session->has_userdata('repid'))
    {
      $items = array('repid'=>$id, 'reptype'=>$type);
      $this->session->set_userdata($items);
    }

    if (!$this->session->has_userdata('customerid')) redirect('admin/customer');

    $cid = $this->session->customerid;
    $result = $this->Customer_model->get_customer_by_id($cid);
    if (!isset($result)) redirect('admin/customer');

    $data['cname'] = ucwords($result[0]->cus_firstname)." ".$result[0]->cus_lastname;
    $data['cid'] = $result[0]->custid;

    $this->layout->set_title('Edit Report');
    $this->layout->add_include('assets/admin/css/file-upload-with-preview.min.css');

    $this->layout->add_include('assets/admin/js/report.js');
    $this->layout->add_include('assets/admin/js/file-upload-with-preview.min.js');

    return $this->layout->view('admin/lab/report/edit', $data, 'admin/layouts/admin');
  }

  /****/
  public function append_data_toedit()
  {
    $data = $this->Report_model->get_data_by_mrid($this->session->repid);
    echo json_encode($data);
  }

  /**
   * Function to update gemstone record
   *
   * @param none
   * @return void
   */
  public function update()
  {
    $date = date('Y-m-d');
    $rep_mem_id = $this->input->post('rmid');
    $lab_repid = $this->input->post('lab_repid');
    $gem_type = $this->input->post('gem-type');
    $payment_status = $this->input->post('pstatus');

    if ($payment_status == 'default')
    {
      $this->set_message('Please Select Payment Status');
      return $this->edit();
    }

    if ($gem_type == '0')
    {
      $this->set_message('Please Select Gem Type');
      return $this->edit();
    }

    $repodata = array(
      'rep_date'=>$date,
      'rep_object'=>$this->input->post('object'),
      'rep_variety'=>$this->input->post('identification'),
      'rep_weight'=>$this->input->post('weight'),
      'rep_gemID'=>$gem_type,
      'rep_shapecut'=>$this->input->post('shapecut'),
      'rep_gemWidth'=>$this->input->post('gemWidth'),
      'rep_gemHeight'=>$this->input->post('gemHeight'),
      'rep_gemLength'=>$this->input->post('gemLength'),
      'rep_color'=>$this->input->post('color'),
      'rep_spgroup'=>$this->input->post('spgroup'),
      'rep_comment'=>$this->input->post('comment'),
      'rep_other'=>$this->input->post('other')
    );

    $this->form_validation->set_rules('amount','Amount','trim|required|decimal');
    $this->form_validation->set_rules('rmid','ID','trim|required|alpha_dash');
    $this->form_validation->set_rules('object','Object','trim|required|callback_alpha_dash_space');
    $this->form_validation->set_rules('variety','Variety','trim|required|callback_alpha_dash_space');
    $this->form_validation->set_rules('weight','Weight','trim|required|decimal');
    $this->form_validation->set_rules('shapecut','Shape & Cut','trim');
    $this->form_validation->set_rules('gemWidth','Width','trim|decimal');
    $this->form_validation->set_rules('gemHeight','Height','trim|decimal');
    $this->form_validation->set_rules('gemLength','Length','trim|decimal');
    $this->form_validation->set_rules('color','Color','trim|alpha');
    $this->form_validation->set_rules('spgroup','Species/Group','trim|alpha');
    $this->form_validation->set_rules('comment','Comment','trim');
    $this->form_validation->set_rules('other','Other','trim');

    if ($this->form_validation->run() == FALSE) return $this->edit();

    if (!empty($_FILES['imagegem']['name']))
    {
      $image = $_FILES['imagegem']['name'];
      $imgnewname = $this->set_image_name($image, $rep_mem_id);
      $repodata['rep_imagename'] = $imgnewname;
    }
    else
    {
      $imgnewname = null;
      $repodata['rep_imagename'] = $this->input->post('oldimage');
    }

    if($this->Report_model->update_lab_report($repodata, $this->session->customerid, $lab_repid) == FALSE)
    {
      $this->set_message('Problem when updating data');
      return $this->edit();
    }

    if(!is_null($imgnewname))
    {
      if (!is_null($this->upload_image($imgnewname))) return $this->edit();
    }

    switch ($this->session->reptype) {
      case 'memo':
        $data = array('mem_amount'=>$this->input->post('amount'), 'mem_paymentStatus'=>$payment_status);
        if ($this->Report_model->update_memo($data, $this->session->repid))
        {
          $array_items = array('customerid', 'reptype', 'repid');
          $this->session->unset_userdata($array_items);
          redirect('admin/customer');
        }
        else
        {
          $this->set_message('Problem when updating data');
          return $this->edit();
        }

        break;

      case 'repo':
        $data = array('gsr_amount'=>$this->input->post('amount'), 'gsr_paymentStatus'=>$payment_status);
        if($this->Report_model->update_repo($data, $this->session->repid))
        {
          $array_items = array('customerid', 'reptype', 'repid');
          $this->session->unset_userdata($array_items);
          redirect('admin/customer');
        }
        else
        {
          $this->set_message('Problem when updating data');
          return $this->edit();
        }
        break;
    }
  }

  /*****/
  protected function set_customer()
  {
    if ($this->session->has_userdata('customerid'))
    {
      $result = $this->Customer_model->get_customer_by_id($this->session->customerid);
      return $result;
    }
    return false;
  }

  /**
   * Creating Memo Card ID for unique identification
   *
   * @param null
   * @return id string
   */
  public function verbalid()
  {
    $this->load->library('id');
    $id = $this->Lab_model->get_verb_id();
    $this->id->set_lastid($id);

    $this->id->set_format(array('identifier'=>'V', 'separator'=>'-'));
    echo $this->id->create_id();
  }

  /**
   * Creating Memo Card ID for unique identification
   *
   * @param null
   * @return id string
   */
  public function certificateid()
  {
    $this->load->library('id');
    $id = $this->Lab_model->get_certificate_id();
    $this->id->set_lastid($id);

    $this->id->set_format(array('identifier'=>date('Y'), 'separator'=>'-', 'month'=>date('m')));
    echo $this->id->create_id();
  }

  /**
   * Creating Memo Card ID for unique identification
   *
   * @param null
   * @return id string
   */
  public function memoid()
  {
    $this->load->library('id');
    $id = $this->Lab_model->get_memo_id();
    $this->id->set_lastid($id);

    $this->id->set_format(array('separator'=>'-'));
    echo $this->id->create_id();
  }



  /**
   * Function to set user message after form completion
   *
   * @param none
   * @return void
   */
  public function set_message($msg)
  {
    return $this->session->set_flashdata('status', $msg);
  }

  /*****/
  public function alpha_dash_space($string = '')
  {
    if (!preg_match("/^([-a-z0-9_ ])+$/i", $string))
    {
      $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha-numeric characters, spaces, underscores, and dashes.');
      return FALSE;
   }
   return TRUE;
  }
}
?>
