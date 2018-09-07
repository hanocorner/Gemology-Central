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

    $this->load->library(array('session'));

    $config = array('layoutManager'=>'admin');
    $this->load->library('layout', $config);

    $this->load->helper(array('html', 'url', 'form'));

    $this->load->model('Report_model');

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }

  }

  /**
   * Default view for the user
   *
   * @return void
   */
  public function index()
  {
    $this->layout->set_title('All Reports');

    $this->layout->add_include('assets/admin/css/jquery.dataTables.min.css');

    $this->layout->add_include('assets/admin/js/jquery.dataTables.min.js');
    $this->layout->add_include('assets/admin/js/sweetalert.min.js');
    $this->layout->add_include('assets/admin/js/report.js');

    $this->layout->view('admin/report/index', '', 'admin/layouts/admin');
  }

  /**
  * Creating AJAX view for table grid
  *
  * @return void
  */
  public function all()
  {
    $params = $_POST;

    $results = $this->Report_model->get_customer_data($params);

    $html = array();
    foreach ($results as $data)
    {
      $html[] = $data;
    }

    $totalRecords = $this->Report_model->get_total('tbl_customer');

    $json_data = array(
      "draw"            => $params['draw'],
      "recordsTotal"    => $totalRecords,
      "recordsFiltered" => $totalRecords,
      "data"            => $html
    );
    echo json_encode($json_data);
  }

  /*****/
  public function gem() 
  {
    $data['id'] = $id;
    $data['customer'] = $this->Report_model->get_customer_name($id);

    $this->layout->set_title('Report');

    $this->layout->add_include('assets/admin/css/jquery.dataTables.min.css');

    $this->layout->add_include('assets/admin/js/jquery.dataTables.min.js');
    $this->layout->add_include('assets/admin/js/sweetalert.min.js');
    $this->layout->add_include('assets/admin/js/report.js');

    $this->layout->view('admin/report/gem', $data, 'admin/layouts/admin');
  }

  /****/
  public function gem_all()
  {
    $params = $_POST;

    $results = $this->Report_model->get_certificate_data($params);

    $html = array();
    foreach ($results as $data)
    {
      $html[] = $data;
    }

    $totalRecords = $this->Report_model->get_total('tbl_certificate');

    $json_data = array(
      "draw"            => $params['draw'],
      "recordsTotal"    => $totalRecords,
      "recordsFiltered" => $totalRecords,
      "data"            => $html
    );
    echo json_encode($json_data);
  }

  /**
   * Public view for admin to add new report
   *
   * @param none
   * @return Customer View Object
   */
  public function add_customer()
  {
    $this->layout->set_title('Add new Customer');
    $this->layout->add_include('assets/admin/js/sweetalert.min.js');
    $this->layout->add_include('assets/admin/js/report.js');
    $this->layout->add_include('assets/admin/js/jquery.form-validator.min.js');

    return $this->layout->view('admin/report/add_customer', '', 'admin/layouts/admin');
  }

  /**
   * Function to insert new customer to DB
   *
   * @param none
   * @return void
   */
  public function insert_customer_data()
  {
    $data = array(
      'cus_firstname'=>$this->input->post('fname'),
      'cus_lastname'=>$this->input->post('lname'),
      'cus_number'=>$this->input->post('number'),
      'cus_email'=>$this->input->post('email')
    );

    $this->form_validation->set_rules('fname','FirstName','trim|required|alpha');
    $this->form_validation->set_rules('lname','LastName','trim|alpha');
    $this->form_validation->set_rules('number','Number','required|regex_match[/^[0-9]{10}$/]');
    $this->form_validation->set_rules('email','Email','trim|valid_email');

    if($this->form_validation->run()==FALSE)
    {
      $this->add_customer();
      return false;
    }
    else
    {
      $customer_id = $this->Report_model->insert_customer($data);

      if($this->Report_model->get_affected_rows() > 0)
      {
        $this->session->set_userdata('customer_id', $customer_id, 300);
        redirect('admin/report/add-gemstone');
      }
      else
      {
        $this->set_message("Problem When adding this customer", "danger");
        redirect('admin/report/add-customer');
      }
    }

  }

  /**
   * Public view for admin to add new report
   *
   * @param none
   * @return void
   */
  public function add_gemstone()
  {
    $this->layout->set_title('Add new Report');
    $this->layout->add_include('assets/admin/js/sweetalert.min.js');
    $this->layout->add_include('assets/admin/js/report.js');
    $this->layout->add_include('assets/admin/js/file-upload.js');

    $gem_id = $this->set_gem_id();
    $data['hidden'] = array('gemid'=>$gem_id, 'cstid' =>$this->session->customer_id);
    $data['gemid'] = $gem_id;

    $this->layout->view('admin/report/add_gemstone', $data, 'admin/layouts/admin');
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
      if($this->Report_model->add_gemstone($data)<>0)
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
    $data['data'] = $this->Report_model->get_specific_data($id, 'tbl_certificate', 'cerno');
    $data['name'] = $this->security->get_csrf_token_name();
    $data['hash'] = $this->security->get_csrf_hash();

    $this->layout->view('admin/report/update_gemstone', $data, 'admin/layouts/admin');
  }

  /**
   * Public view for admin to edit existing customer
   *
   * @param none
   * @return void
   */
  public function edit_customer()
  {
    $id = $this->uri->segment(4);
    $this->layout->set_title('Edit Customer');
    $data['data'] = $this->Report_model->get_specific_data($id, 'tbl_customer', 'custid');
    $data['name'] = $this->security->get_csrf_token_name();
    $data['hash'] = $this->security->get_csrf_hash();

    $this->layout->view('admin/report/update_customer', $data, 'admin/layouts/admin');
  }

  /**
   * Public view for admin to preview existing report data
   *
   * @param none
   * @return void
   */
  public function preview_modal()
  {
    $id = $_POST['id'];
    $data['data'] = $this->Report_model->get_report_data($id);
    $this->load->view('admin/report/preview_modal',$data);
  }

  /**
   * public view for the admin to print the Gemstone report
   *
   * @param none
   * @return void
   */
  public function print_preview()
  {
    $gemid = $this->uri->segment(5);
    $type = $this->uri->segment(4);

    if ($type == 'cert-report')
    {
      $data['data'] = $this->Report_model->get_gem_data($gemid, 'cerno');
      $data['img_url'] = $this->qr_generator($gemid);
      $this->load->view('admin/report/certificate', $data);
    }

    if ($type == 'memo-card')
    {
      $data['data'] = $this->Report_model->get_gem_data($gemid, 'cerno');
      $this->load->view('admin/report/memo_card', $data);
    }

  }

  /**
   *
   */
  public function search()
  {
    $data=$this->input->get('data');

    $result = $this->Report_model->search_data($data);
    echo $this->html_table($result);
  }

  /****/
  public function payment()
  {
    $status=$this->input->post('status');
    $cerno=$this->input->post('id');

    $data = array('cer_paymentStatus'=>$status);

    if($this->Report_model->update('tbl_certificate','cerno', $cerno, $data))
    {
      $this->set_message("Payment status changed", "success");
    }
    else
    {
      $this->set_message("Problem when changing payment status", "error");
    }
  }





  /**
   * Function to delete gemstone record
   *
   * @param $id String
   *
   * @return void
   */
  public function delete()
  {
    $id = $this->input->post('id');
    if($this->Report_model->delete_data('tbl_certificate','cerno',$id))
    {
      $this->set_message("Gemstone report deleted successfully", "success");
    } else
    {
      $this->set_message("problem when deleting this report", "danger");
    }
  }

  /**
   * Function to update customer record
   *
   * @param none
   * @return void
   */
  public function update_customer_data()
  {
    $data = array(
      'custid'=>$this->input->post('custid'),
      'cus_firstname'=>$this->input->post('fname'),
      'cus_lastname'=>$this->input->post('lname'),
      'cus_email'=>$this->input->post('email'),
      'cus_number'=>$this->input->post('number')
    );

    if($this->Report_model->update('tbl_customer','custid', $data['custid'], $data))
    {
      $this->set_message('Customer updated successfully','success');
      redirect('admin/report');
    }else
    {
      $this->set_message('customer update failed','danger');
      redirect('admin/report/edit-gemstone');
    }
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

    if($this->Report_model->update('tbl_certificate','cerno', $data['cerno'], $data))
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
  private function set_gem_id()
  {
    $prefix = "GCL";
    $current_year = date("Y");
    $current_month = date("m");

    $number = 1000;

    $dbnumber = $this->Report_model->get_gem_no();

    if(is_null($dbnumber))
    {
      $number += 1;
      $number = str_pad($number, 4, '0', STR_PAD_LEFT);
      return $prefix.$current_year."-".$current_month.$number;
    }
    else
    {
      $dbnumber = preg_replace('/[^0-9]/', '', $dbnumber);
      $dbnumber = substr($dbnumber, 6, 4);
      $dbnumber += 1;
      return $prefix.$current_year."-".$current_month.$dbnumber;
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
