<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends CI_Controller
{
  /**
   * Authenticating form data
   * @var $valid bool
   */
  private $valid = false;

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
   *
   */
  public function add()
  {
    $this->layout->set_title('Report');
    $this->layout->add_include('assets/admin/css/file-upload-with-preview.min.css');

    $this->layout->add_include('assets/admin/js/report.js');
    $this->layout->add_include('assets/admin/js/jquery.form-validator.min.js');
    $this->layout->add_include('assets/admin/js/file-upload-with-preview.min.js');

    return $this->layout->view('admin/lab/report/add', '', 'admin/layouts/admin');
  }

  /*****/
  public function gem_list()
  {
    $data = $this->Lab_model->get_gem_list();
    echo json_encode($data);
  }

  /**
   *
   */
  public function insert_default_data()
  {
    if ($this->input->post('repo-type') == '0')
    {
      $this->valid = true;
    }
    else
    {
      $repo_type = $this->input->post('repo-type');
    }

    $rep_mem_id = $this->input->post('rmid');
    $date = date('Y-m-d');

    $this->form_validation->set_rules('amount','Amount','required|decimal');
    $this->form_validation->set_rules('rmid','ID','required|alpha_dash');

    if(empty($_FILES['imagegem']['name']))
    {
      $this->form_validation->set_rules('imagegem','Document','required');
    }
    else {
      $image = $_FILES['imagegem']['name'];
      $imgnewname = $this->set_image_name($image, $rep_mem_id);
    }

    if ($this->form_validation->run() == FALSE)
    {
      $this->add();
      $this->set_message('Some or all of fields are empty, Please Check...', $status);
      return false;
    }
    else
    {
      $gem_name = $this->input->post('gem-name');
      $gem_des = $this->input->post('gem-des');

      $gem_id = $this->input->post('gem-type');

      if (!empty($gem_name) && !empty($gem_des))
      {
        $gemdata = array(
          'gem_name'=>$gem_name,
          'gem_description'=>$gem_des
        );
        $gem_id = $this->Report_model->insert_gem($gemdata);
      }

      $customer_id = $this->session->customerid;
      $this->session->unset_userdata('customerid');

      $labdata = array(
        'rep_customerID'=>$customer_id,
        'rep_gemID'=>$gem_id,
        'rep_date'=>$date,
        'rep_imagename'=>$imgnewname,
        'rep_type'=>$repo_type
      );
      $labrepo_id = $this->Report_model->insert_lab_report($labdata);

      if (!is_null($labrepo_id))
      {
        switch ($repo_type) {
          case 'memo':
            // code...
            break;

          case 'repo':
            // code...
            break;
        }
        if($repo_type == 'memo')
        {
          $memo_data = array(
            'memoid'=>$rep_mem_id,
            'reportid'=>$labrepo_id,
            'mem_date'=>$date,
            'mem_paymentStatus'=>$this->input->post('pstatus'),
            'mem_amount'=>$this->input->post('amount')
          );

          $mid = $this->Report_model->insert_memocard($memo_data);

          if (!is_null($this->upload_image($imgnewname)))
          {
            $this->set_message('Problem when uploading the image ', 'error');
            redirect('admin/report/add');
          }

          if (!is_null($mid)) redirect('admin/report/add-lab-report');

        }
        elseif ($repo_type == 'repo')
        {
          $repo_data = array(
            'gsrid'=>$rep_mem_id,
            'reportid'=>$labrepo_id,
            'gsr_date'=>$date,
            'gsr_paymentStatus'=>$this->input->post('pstatus'),
            'gsr_amount'=>$this->input->post('amount')
          );

          $gsr_id = $this->Report_model->insert_certificate($repo_data);
          if (!is_null($gsr_id))
          {
            $this->upload_image($imgnewname);
            redirect('admin/report/add-lab-report');
          }
        }
      }
      redirect('admin/report/add');
    }
  }

  /****/
  public function add_lab_report()
  {
    $this->layout->set_title('Lab Report');
    $this->layout->add_include('assets/admin/css/file-upload-with-preview.min.css');

    $this->layout->add_include('assets/admin/js/report.js');
    $this->layout->add_include('assets/admin/js/jquery.form-validator.min.js');
    $this->layout->add_include('assets/admin/js/file-upload-with-preview.min.js');

    return $this->layout->view('admin/lab/report/add_lab_report', '', 'admin/layouts/admin');
  }

  /****/
  public function set_image_name($image, $img_name)
  {
    if(empty($image)) return false;
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $newname = "gcl"."-".$img_name.".".$ext;
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
      return $this->upload->display_errors();
    }
    return null;
  }
  /**
   * Function to insert new gemstone record
   *
   * @param none
   * @return void
   */
  public function insert_gemstone_data()
  {
    $gemid = $this->input->post('gemid');
    $customerID = $this->input->post('cstid');

    $data = array(
      'cerno'=>$gemid,
      'cer_date'=>date('Y-m-d'),
      'cer_object'=>$this->input->post('object'),
      'cer_type'=>$this->input->post('cert-type'),
      'cer_identification'=>$this->input->post('identification'),
      'cer_weight'=>$this->input->post('weight'),
      'cer_gemWidth'=>$this->input->post('gemWidth'),
      'cer_gemHeight'=>$this->input->post('gemHeight'),
      'cer_gemlength'=>$this->input->post('gemLength'),
      'cer_cut'=>$this->input->post('gemcut'),
      'cer_shape'=>$this->input->post('shape'),
      'cer_color'=>$this->input->post('color'),
      'cer_comment'=>$this->input->post('comment'),
      'customerID'=>$customerID
    );

    $filename = $_FILES['image']['name'];
    $exp = explode('.', $filename);
    $ext = end($exp);

    $img_allowed_types = array('gif', 'png', 'jpg', 'jpeg', 'tif');
    if (in_array($ext, $img_allowed_types))
    {
      $newname = $gemid.".".$ext;

      $config['file_name'] = $newname;
      $config['upload_path']='./assets/admin/images/gem/';
      $config['allowed_types']='gif|jpg|png|jpeg|tif';
      $config['max_size']='200000';
      $config['max_width']='1024';
      $config['max_height']='1024';
      $this->load->library('upload',$config);
      $this->upload->do_upload('image');
      $data['cer_imagename']=$newname;
    }
    else
    {
      $data['cer_imagename'] = 'null';
    }

    $this->form_validation->set_rules('object','Object','required');
    $this->form_validation->set_rules('identification','Identification','required');
    $this->form_validation->set_rules('weight','Weight','required');

    if($this->form_validation->run()==FALSE)
    {
      $this->add_gemstone();
      return false;
    }
    else
    {
      if($this->Customer_model->add_gemstone($data)<>0)
      {
        $this->set_message("Gemstone added successfully", "success");
        $this->session->unset_userdata('customer_id');
        $this->session->set_userdata('cerno', $gemid);
      }
      else
      {
        $this->set_message("gemstone adding failed", "danger");
      }
      redirect('admin/report/add-gemstone/'.$customerID);
    }
  }

  /**
   * Public view for admin to edit existing gemstone
   *
   * @param none
   * @return void
   */
  public function edit_gemstone()
  {
    $id = $this->uri->segment(4);
    $this->layout->set_title('Edit Report');
    $data['data'] = $this->Customer_model->get_specific_data($id, 'tbl_certificate', 'cerno');
    $data['name'] = $this->security->get_csrf_token_name();
    $data['hash'] = $this->security->get_csrf_hash();

    $this->layout->view('admin/report/update_gemstone', $data, 'admin/layouts/admin');
  }



  /**
   * Public view for admin to preview existing report data
   *
   * @param none
   * @return void
   */
  public function preview_modal()
  {
    // code
  }

  /**
   * Function to delete gemstone record
   *
   * @param $id String
   * @return void
   */
  public function delete()
  {
    // code
  }

  /**
   * Function to update gemstone record
   *
   * @param none
   * @return void
   */
  public function update_gemstone_data()
  {
    $gemid = $this->input->post('gem-no');
    $data = array(
      'cerno'=>$gemid,
      'cer_date'=>$this->input->post('date'),
      'cer_object'=>$this->input->post('object'),
      'cer_identification'=>$this->input->post('identification'),
      'cer_weight'=>$this->input->post('weight'),
      'cer_gemWidth'=>$this->input->post('gemWidth'),
      'cer_gemHeight'=>$this->input->post('gemHeight'),
      'cer_gemlength'=>$this->input->post('gemLength'),
      'cer_cut'=>$this->input->post('gemcut'),
      'cer_shape'=>$this->input->post('shape'),
      'cer_color'=>$this->input->post('color'),
      'cer_comment'=>$this->input->post('comment')
    );

    $filename=$_FILES['image']['name'];
    $exp=  explode('.', $filename);
    $ext=  end($exp);
    $newname=$gemid.".".$ext;

    $config['file_name']=$newname;
    $config['upload_path']='./assets/img/';
    $config['allowed_types']='gif|jpg|png';
    $config['max_size']='200000';
    $config['max_width']='1024';
    $config['max_height']='1024';
    $config['file_name'] = $newname;
    $this->load->library('upload',$config);
    $this->upload->do_upload('image');
    $data['cer_imagename']=$newname;

    if($this->Customer_model->update('tbl_certificate','cerno', $data['cerno'], $data))
    {
      $this->set_message('Report updated successfully','success');
      redirect('admin/report');
    }else
    {
      $this->set_message('Report updated failed','danger');
      redirect('admin/report/edit-gemstone');
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
    $number = 000001;

    $memoid = $this->Lab_model->get_memo_id();

    if(is_null($memoid))
    {
      $number += 1;
      $number = str_pad($number, 6, '0', STR_PAD_LEFT);
      return $number;
    }
    else
    {
      $memoid = preg_replace('/[^0-9]/', '', $memoid);
      $memoid += 1;
      echo str_pad($memoid, 6, '0', STR_PAD_LEFT);
    }
  }

  /**
   * QR Code generator
   *
   * @param $gemid
   * @return qr image url
   */
  public function qr_generator($gemid)
  {
    $this->load->library('ciqrcode');

    $img_url="";

    $qr_image=$gemid.'.png';
    $params['data'] = base_url()."report";
    $params['level'] = 'H';
    $params['size'] = 8;
    $params['savename'] ="assets/admin/images/qr/".$qr_image;

    if($this->ciqrcode->generate($params))
    {
      return $qr_image;
    }
    return false;
  }

  /**
   * Function to set user message after form completion
   *
   * @param none
   * @return void
   */
  public function set_message($msg, $status)
  {
    $data = array(
      'message'=> $msg,
      'status'=> $status
    );
    $this->session->set_flashdata($data);
  }

}
?>
