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
    $this->load->model('Customer_model');

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
    $this->layout->set_title('My Customer List');

    $this->layout->add_include('assets/admin/js/sweetalert.min.js');
    $this->layout->add_include('assets/admin/js/loglevel.min.js');
    $this->layout->add_include('assets/admin/js/customer.js');

    $data['form'] = array('class'=>'form-inline');

    $this->layout->view('admin/report/index', $data, 'admin/layouts/admin');
  }

  /**
  * Creating AJAX view for table grid
  *
  * @return void
  */
  public function all()
  {
    $params = $_POST;

    $results = $this->Customer_model->get_customer_data($params);

    $html = array();
    foreach ($results as $data)
    {
      $html[] = $data;
    }

    $totalRecords = $this->Customer_model->get_total('tbl_customer');

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
    $data['customer'] = $this->Customer_model->get_customer_name($id);

    $this->layout->set_title('Report');

    $this->layout->add_include('assets/admin/css/jquery.dataTables.min.css');

    $this->layout->add_include('assets/admin/js/jquery.dataTables.min.js');
    $this->layout->add_include('assets/admin/js/sweetalert.min.js');
    $this->layout->add_include('assets/admin/js/report.js');

    $this->layout->view('admin/report/gem', $data, 'admin/layouts/admin');
  }

  /****/
  public function get_data_bundle()
  {
    $customer_id = $_GET['id'];

    $data['results'] = $this->Customer_model->get_certificate_data($customer_id);
    //var_dump($this->Customer_model->get_certificate_data($customer_id));
    $this->load->view('admin/report/specific_data', $data);
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
      $customer_id = $this->Customer_model->insert_customer($data);

      if($this->Customer_model->get_affected_rows() > 0)
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
   * HTML xmlHTTPRequest to parse csutomer data to admin
   *
   * @param none
   * @return none
   */
  public function xmlHttpReq_customer()
  {
    $page = $this->uri->segment(4);
    $rows_per_page = 3;

    $total_rows = $this->Customer_model->count_all('tbl_customer');
    $data['links'] = $this->html_pagination($page, $rows_per_page, $total_rows);

    if ($page == 0) $page = 1;
    $start = ($page - 1) * $rows_per_page;

    $data['results'] = $this->Customer_model->get_customer_data($rows_per_page, $start);
    $this->load->view('admin/report/customer_list', $data);
  }

  /**
   *
   */
  public function search()
  {
    $string = $this->input->get('q');
    $string = urlencode($string);
    $keywords = explode('+', $string);

    $data['results'] = $this->Customer_model->search_data($keywords);
    $data['links'] = null;
    return $this->load->view('admin/report/customer_list',$data);
  }

  /**
   * CI HTML Table library
   *
   * @param $data | array
   * @return html table | string
   */
  public function html_table($data = array())
  {
    $template = array(
      'table_open'            => '<table border="0" cellpadding="4" cellspacing="0">',
      'thead_open'            => '<thead>',
      'thead_close'           => '</thead>',

      'heading_row_start'     => '<tr>',
      'heading_row_end'       => '</tr>',
      'heading_cell_start'    => '<th>',
      'heading_cell_end'      => '</th>',

      'tbody_open'            => '<tbody>',
      'tbody_close'           => '</tbody>',

      'row_start'             => '<tr>',
      'row_end'               => '</tr>',
      'cell_start'            => '<td>',
      'cell_end'              => '</td>',

      'row_alt_start'         => '<tr>',
      'row_alt_end'           => '</tr>',
      'cell_alt_start'        => '<td>',
      'cell_alt_end'          => '</td>',

      'table_close'           => '</table>'
    );

    $this->table->set_heading('Name', 'Color', 'Size');
    $this->table->set_template($template);
    $this->table->add_row($data);

    return $this->table->generate();
  }

  /**
   * CI HTML Pagination library
   *
   * @param $start
   * @param $length
   */
  public function html_pagination($page, $rows_per_page, $total_rows)
  {
    $config['base_url'] = '#';
    $config["total_rows"] = $total_rows;
    $config["per_page"] = $rows_per_page;
    $config["uri_segment"] = 4;
    $config["use_page_numbers"] = TRUE;
    $config["full_tag_open"] = '<ul class="pagination">';
    $config["full_tag_close"] = '</ul>';
    $config["first_tag_open"] = '<li class="page-item">';
    $config["first_tag_close"] = '</li>';
    $config['next_link'] = 'Next';
    $config["next_tag_open"] = '<li class="page-item">';
    $config["next_tag_close"] = '</li>';
    $config["prev_link"] = "Previous";
    $config["prev_tag_open"] = "<li class='page-item'>";
    $config["prev_tag_close"] = "</li>";
    $config["cur_tag_open"] = "<li class='page-item active'><a href='#' class='page-link'>";
    $config["cur_tag_close"] = "</a></li>";
    $config["num_tag_open"] = "<li class='page-item'>";
    $config["num_tag_close"] = "</li>";
    $config["num_links"] = 2;
    $config['attributes'] = array('class' => 'page-link', 'data-action'=>'pagination');
    $this->pagination->initialize($config);

    return $this->pagination->create_links();
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
   * Public view for admin to edit existing customer
   *
   * @param none
   * @return void
   */
  public function edit_customer()
  {
    $id = $this->uri->segment(4);
    $this->layout->set_title('Edit Customer');
    $data['data'] = $this->Customer_model->get_specific_data($id, 'tbl_customer', 'custid');
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
    $data['data'] = $this->Customer_model->get_report_data($id);
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
      $data['data'] = $this->Customer_model->get_gem_data($gemid, 'cerno');
      $data['img_url'] = $this->qr_generator($gemid);
      $this->load->view('admin/report/certificate', $data);
    }

    if ($type == 'memo-card')
    {
      $data['data'] = $this->Customer_model->get_gem_data($gemid, 'cerno');
      $this->load->view('admin/report/memo_card', $data);
    }

  }



  /****/
  public function payment()
  {
    $status=$this->input->post('status');
    $cerno=$this->input->post('id');

    $data = array('cer_paymentStatus'=>$status);

    if($this->Customer_model->update('tbl_certificate','cerno', $cerno, $data))
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
    if($this->Customer_model->delete_data('tbl_certificate','cerno',$id))
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

    if($this->Customer_model->update('tbl_customer','custid', $data['custid'], $data))
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
  private function set_certificate_id()
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
   * Creating Customer ID for unique identification
   *
   * @param null
   * @return id string
   */
  private function set_customer_id()
  {
    $prefix = "GCLC";
    $number = 1000;

    $customerid = $this->Customer_model->get_customer_id();

    if(is_null($customerid))
    {
      $number += 1;
      $number = str_pad($number, 4, '0', STR_PAD_LEFT);
      return $prefix."-".$number;
    }
    else
    {
      $customerid = preg_replace('/[^0-9]/', '', $customerid);
      $customerid = substr($customerid, 6, 4);
      $customerid += 1;
      return $prefix."-".$customerid;
    }
  }

  /**
   * Creating Memo Card ID for unique identification
   *
   * @param null
   * @return id string
   */
  private function set_memo_id()
  {
    //$prefix = "MC";
    $number = 00000;

    $memoid = $this->Customer_model->get_memo_id();

    if(is_null($memoid))
    {
      $number += 1;
      $number = str_pad($number, 4, '0', STR_PAD_LEFT);
      return $number;
    }
    else
    {
      $memoid = preg_replace('/[^0-9]/', '', $memoid);
      $memoid = substr($memoid, 6, 4);
      $memoid += 1;
      return $memoid;
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
