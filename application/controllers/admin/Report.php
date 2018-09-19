<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends CI_Controller
{
  /**
   * Constructor (loading the important classes)
   *
   * @param none
   * @return void
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->library(array('session', 'pagination', 'table'));

    $config = array('layoutManager'=>'admin');
    $this->load->library('layout', $config);

    $this->load->helper(array('url', 'form'));
    $this->load->model(array('Customer_model', 'Lab_model', 'Report_model'));

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }

  }

  /**
   * Form to add new Report i.e. Memocard | Certificate
   *
   * @param none
   * @return layout
   */
  public function index()
  {
    if (!$this->session->has_userdata('customerid')) redirect('admin/customer');

    $cid = $this->session->customerid;
    $result = $this->Customer_model->get_customer_by_id($cid);
    if (!isset($result)) redirect('admin/customer');

    $data['cname'] = ucwords($result[0]->cus_firstname)." ".$result[0]->cus_lastname;
    $data['cid'] = $result[0]->custid;

    $this->layout->set_title('New Report');
    $this->layout->add_include('assets/admin/css/file-upload-with-preview.min.css');

    $this->layout->add_include('assets/admin/js/report.js');
    $this->layout->add_include('assets/admin/js/file-upload-with-preview.min.js');

    return $this->layout->view('admin/lab/report/add_report', $data, 'admin/layouts/admin');
  }

  /**
   * Insert Post Report data to DB
   *
   * @param none
   * @return none
   */
  public function add()
  {
    $date = date('Y-m-d');
    $rep_mem_id = $this->input->post('rmid');
    $repo_type = $this->input->post('repo-type');
    $gem_type = $this->input->post('gem-type');

    if($repo_type == '0')
    {
      $this->set_message('Please Select Report Type First');
      return $this->index();
    }

    if ($gem_type == '0')
    {
      $this->set_message('Please Select Gem Type');
      return $this->index();
    }

    $repodata = array(
      'rep_customerID'=>$this->session->customerid,
      'rep_date'=>$date,
      'rep_type'=>$repo_type,
      'rep_object'=>$this->input->post('object'),
      'rep_identification'=>$this->input->post('identification'),
      'rep_weight'=>$this->input->post('weight'),
      'rep_gemID'=>$gem_type,
      'rep_cut'=>$this->input->post('gemcut'),
      'rep_gemWidth'=>$this->input->post('gemWidth'),
      'rep_gemHeight'=>$this->input->post('gemHeight'),
      'rep_gemLength'=>$this->input->post('gemLength'),
      'rep_color'=>$this->input->post('color'),
      'rep_shape'=>$this->input->post('shape'),
      'rep_comment'=>$this->input->post('comment')
    );

    $this->form_validation->set_rules('amount','Amount','trim|required|decimal');
    $this->form_validation->set_rules('rmid','ID','trim|required|alpha_dash');
    $this->form_validation->set_rules('object','Object','trim|required|callback_alpha_dash_space');
    $this->form_validation->set_rules('identification','Identification','trim|required|callback_alpha_dash_space');
    $this->form_validation->set_rules('weight','Weight','trim|required|decimal');
    $this->form_validation->set_rules('gemcut','Cut','trim');
    $this->form_validation->set_rules('gemWidth','Width','trim|decimal');
    $this->form_validation->set_rules('gemHeight','Height','trim|decimal');
    $this->form_validation->set_rules('gemLength','Length','trim|decimal');
    $this->form_validation->set_rules('color','Color','trim|alpha');
    $this->form_validation->set_rules('shape','Shape','trim|alpha');
    $this->form_validation->set_rules('comment','Comment','trim|callback_alpha_dash_space');

    $image = $_FILES['imagegem']['name'];
    $imgnewname = $this->set_image_name($image, $rep_mem_id);
    $repodata['rep_imagename'] = $imgnewname;

    if ($this->form_validation->run() == FALSE) return $this->index();

    $labrepo_id = $this->Report_model->insert_lab_report($repodata);

    if(is_null($labrepo_id))
    {
      $this->set_message('Problem when uploading data to the database');
      return $this->index();
    }

    if (!is_null($this->upload_image($imgnewname))) return $this->index();

    switch ($repo_type) {
      case 'memo':
      $id = $this->insert_memo($labrepo_id, $rep_mem_id, $date);
        if (!is_null($id))
        {
          $this->session->unset_userdata('customerid');
          if (isset($_POST['submit']))
          {
            redirect('admin/customer');
          }
          elseif (isset($_POST['print']))
          {
            $this->session->set_userdata('printid', $rep_mem_id);
            redirect('admin/printp');
          }
        }
        else
        {
          $this->set_message('Problem when uploading data to the database');
          return $this->index();
        }

        break;

      case 'repo':
      $id = $this->insert_certificate_data($labrepo_id, $rep_mem_id, $date);
        if(!is_null($id))
        {
          $this->session->unset_userdata('customerid');
          if (isset($_POST['submit']))
          {
            redirect('admin/customer');
          }
          elseif (isset($_POST['print']))
          {
            $this->session->set_userdata('printid', $rep_mem_id);
            redirect('admin/printp/certificate/'.$rep_mem_id);
          }
        }
        else
        {
          $this->set_message('Problem when uploading data to the database');
          return $this->index();
        }
        break;
    }
  }

  /****/
  public function insert_memo($labrepoid, $id, $date)
  {
    $data = array(
      'memoid'=> $id,
      'reportid'=>$labrepoid,
      'mem_date'=>$date,
      'mem_paymentStatus'=>$this->input->post('pstatus'),
      'mem_amount'=>$this->input->post('amount')
    );

    $mid = $this->Report_model->insert_memocard($data);
    if ($mid < 1) return $mid;
    return FALSE;
  }

  /****/
  public function insert_certificate_data($labrepoid, $id, $date)
  {
    $certdata = array(
      'gsrid'=>$id,
      'reportid'=>$labrepoid,
      'gsr_date'=>$date,
      'gsr_paymentStatus'=>$this->input->post('pstatus'),
      'gsr_amount'=>$this->input->post('amount')
    );

    $gsr_id = $this->Report_model->insert_certificate($certdata);

    if ($gsr_id < 1) return $gsr_id;
    return FALSE;
  }

  /****/
  public function set_image_name($image, $img_name)
  {
    if(empty($image)) return false;
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $newname = $img_name.".".$ext;
    return $newname;
  }

  /*****/
  public function upload_image($image)
  {
    $config['file_name'] = $image;
    $config['upload_path'] ='./assets/admin/images/gem/';
    $config['allowed_types'] ='gif|jpg|png|jpeg';
    $config['max_size'] ='200000';
    $config['max_width'] ='1024';
    $config['max_height'] ='1024';

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('imagegem'))
    {
      return $this->set_message($this->upload->display_errors());
    }
    return null;
  }

  /**
   * Function to delete
   *
   * @param $id String
   * @return void
   */
  public function delete()
  {
    // code
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
      'rep_identification'=>$this->input->post('identification'),
      'rep_weight'=>$this->input->post('weight'),
      'rep_gemID'=>$gem_type,
      'rep_cut'=>$this->input->post('gemcut'),
      'rep_gemWidth'=>$this->input->post('gemWidth'),
      'rep_gemHeight'=>$this->input->post('gemHeight'),
      'rep_gemLength'=>$this->input->post('gemLength'),
      'rep_color'=>$this->input->post('color'),
      'rep_shape'=>$this->input->post('shape'),
      'rep_comment'=>$this->input->post('comment')
    );

    $this->form_validation->set_rules('amount','Amount','trim|required|decimal');
    $this->form_validation->set_rules('rmid','ID','trim|required|alpha_dash');
    $this->form_validation->set_rules('object','Object','trim|required|callback_alpha_dash_space');
    $this->form_validation->set_rules('identification','Identification','trim|required|callback_alpha_dash_space');
    $this->form_validation->set_rules('weight','Weight','trim|required|decimal');
    $this->form_validation->set_rules('gemcut','Cut','trim');
    $this->form_validation->set_rules('gemWidth','Width','trim|decimal');
    $this->form_validation->set_rules('gemHeight','Height','trim|decimal');
    $this->form_validation->set_rules('gemLength','Length','trim|decimal');
    $this->form_validation->set_rules('color','Color','trim|alpha');
    $this->form_validation->set_rules('shape','Shape','trim|alpha');
    $this->form_validation->set_rules('comment','Comment','trim|callback_alpha_dash_space');

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

  /**
   * Creating Gemstone report ID for unique identification
   *
   * @param null
   * @return id string
   */
  public function set_certificate_id()
  {
    $prefix = "GCL";
    $current_year = date("Y");
    $current_month = date("m");

    $number = 1000;

    $dbnumber = $this->Lab_model->get_certificate_id();

    if(is_null($dbnumber))
    {
      $number += 1;
      $number = str_pad($number, 4, '0', STR_PAD_LEFT);
      echo $prefix.$current_year."-".$current_month.$number;
    }
    else
    {
      $dbnumber = preg_replace('/[^0-9]/', '', $dbnumber);
      $dbnumber = substr($dbnumber, 6, 4);
      $dbnumber += 1;
      echo $prefix.$current_year."-".$current_month.$dbnumber;
    }
  }

  /**
   * Creating Memo Card ID for unique identification
   *
   * @param null
   * @return id string
   */
  public function set_memo_id()
  {
    $prefix = "GCL";
    $number = 000000;

    $memoid = $this->Lab_model->get_memo_id();

    if(is_null($memoid))
    {
      $number += 1;
      $numb = str_pad($number, 6, '0', STR_PAD_LEFT);
      echo $prefix."-".$numb;
    }
    else
    {
      $memoid = preg_replace('/[^0-9]/', '', $memoid);
      $memoid += 1;
      $memoid = str_pad($memoid, 6, '0', STR_PAD_LEFT);
      echo $prefix."-".$memoid;
    }
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
