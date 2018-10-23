<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends Admin_Controller
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
    $this->check_login_status();

    $this->load->library(array('pagination', 'table', 'id'));
    $this->load->model(array('admin/Customer_model', 'Lab_model'));
  }

  public function index()
  {
    $this->layout->set_title('My Customer List');

    $this->layout->add_include('assets/admin/js/sweetalert.min.js');
    $this->layout->add_include('assets/admin/js/customer.js');

    $data['form'] = array('class'=>'form-inline');
    $this->layout->view('admin/lab/customer/index', $data, 'admin/layouts/admin');
  }

  /**
   * Public view for admin to add new report
   *
   * @param none
   * @return Customer View Object
   */
  public function add()
  {
    $this->layout->set_title('Add new Customer');
    $this->layout->add_include('assets/admin/js/report.js');
    $this->layout->add_include('assets/admin/js/jquery.form-validator.min.js');

    return $this->layout->view('admin/lab/customer/add', '', 'admin/layouts/admin');
  }

  /**
   * This will insert a new customer to DB
   *
   * @param null
   * @return bool
   */
  public function insert()
  {
    if(!$this->ajax_login_status())
    {
      echo json_encode(array('auth'=>false, 'url'=>base_url().'admin/home'));
      return false;
    }

    $this->id->set_lastid($this->Customer_model->get_customer_id());
    $this->id->set_format(array('identifier'=>'C', 'separator'=>'-'));

    $this->_data = array(
      'custid'=>$this->id->create_id(),
      'cus_firstname'=>$this->input->post('fname'),
      'cus_lastname'=>$this->input->post('lname'),
      'cus_number'=>$this->input->post('number'),
      'cus_email'=>$this->input->post('email')
    );

    $this->form_validation->set_rules('fname','FirstName','trim|required|alpha');
    $this->form_validation->set_rules('lname','LastName','trim|required|alpha');
    $this->form_validation->set_rules('number','Number','trim|required|regex_match[/^[0-9]{10}$/]');
    $this->form_validation->set_rules('email','Email','trim|valid_email');

    if($this->form_validation->run()==FALSE)
    {
      echo json_encode(array('auth'=>false, 'message'=>validation_errors()));
      return false;
    }

    if($this->Customer_model->insert_customer($this->_data) < 0)
    {
      log_message('error', 'Error when inserting customer');
      echo json_encode(array('auth'=>false, 'message'=>'Problem when adding this customer to database, Please try again'));
      return false;
    }
    echo json_encode(array('auth'=>true, 'url'=>base_url().'admin/customer'));
  }

  /**
   * xmlHTTPRequest Call to parse customer list
   *
   * @param none
   * @return none
   */
  public function customer_list()
  {
    $page = $this->uri->segment(4);
    $rows_per_page = 3;

    $total_rows = $this->Customer_model->count_all('tbl_customer');
    $data['links'] = $this->html_pagination($page, $rows_per_page, $total_rows);

    if ($page == 0) $page = 1;
    $start = ($page - 1) * $rows_per_page;

    $data['results'] = $this->Customer_model->get_alldata($rows_per_page, $start);
    $this->load->view('admin/lab/customer/customer_list', $data);
  }

  /**
   * Search Function to sort a customer
   *
   * @param none
   * @return result
   */
  public function search()
  {
    $string = $this->input->get('q');
    $string = urlencode($string);
    $keywords = explode('+', $string);

    $data['results'] = $this->Customer_model->search_query($keywords);
    $data['links'] = null;
    return $this->load->view('admin/lab/customer/customer_list',$data);
  }

  /**
   * Fetching customer relavant report
   *
   * @param none
   * @return result
   */
  public function customer_report()
  {
    $customer_id = $this->input->post('id');
    $labreportid = $this->Lab_model->get_labreport_id($customer_id);
    $items = array('customerid', 'repid', 'qrcode');
    $this->session->unset_userdata($items);
    $this->session->set_userdata('customerid', $customer_id);

    if (is_null($labreportid))
    {
      $data['empty'] = "<strong>".$customer_id."</strong>"." "."This Customer owns <strong>zero</strong> memo cards / certificates.";
      return $this->load->view('admin/lab/customer/specific_data', $data);
    }

    $data['customers'] = $this->Customer_model->get_customer_by_id($customer_id);
    $data['mdata'] = $this->Lab_model->memo_data($customer_id);
    $data['cdata'] = $this->Lab_model->certificate_data($customer_id);

    return $this->load->view('admin/lab/customer/specific_data', $data);
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
   * Public view for admin to edit existing customer
   *
   * @param none
   * @return void
   */
  public function edit()
  {
    $id = $this->uri->segment(4);
    $this->layout->set_title('Edit Customer');
    $data['data'] = $this->Customer_model->get_specific_data($id, 'tbl_customer', 'custid');
    $data['name'] = $this->security->get_csrf_token_name();
    $data['hash'] = $this->security->get_csrf_hash();

    $this->layout->view('admin/lab/customer/edit', $data, 'admin/layouts/admin');
  }

  /**
   * Function to update customer record to db
   *
   * @param none
   * @return void
   */
  public function update_customer()
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
      redirect('admin/customer');
    }else
    {
      $this->set_message('customer update failed','danger');
      redirect('admin/customer/edit');
    }
  }

}
?>
