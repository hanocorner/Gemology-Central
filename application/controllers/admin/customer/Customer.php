<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends Admin_Controller
{
  /**
   * Constructor (loading the important classes)
   *
   * @param null
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->check_login_status();

    $this->load->library(array('pagination', 'table', 'id'));
    $this->load->model(array('admin/customer/Customer_model', 'Lab_model'));
    $this->load->helper('date');
    $this->config->load('report');
  }

  public function index()
  {
    $this->layout->set_title('My Customer List');

    $this->layout->add_include('assets/admin/css/jquery.dataTables.min.css');
    $this->layout->add_include('assets/admin/js/jquery.dataTables.min.js');
    $this->layout->add_include('assets/admin/js/sweetalert.min.js');

    $this->layout->view('admin/lab/customer/index', '', 'admin/layouts/admin');
  }

  /**
   *
   *
   */
  public function populate()
  {
    $params = $_GET;
    $results = $this->Customer_model->get_all($params);

    $html = array();
    foreach ($results as $result)
    {
      $html[] = $result;
    }

    $totalRecords = $this->Customer_model->count_all();

    $this->_data = array(
      "draw"            => $params['draw'],
		  "recordsTotal"    => $totalRecords,
		  "recordsFiltered" => $totalRecords,
		  "data"            => $html
    );
    echo json_encode($this->_data);
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
   * @return mixed
   */
  public function insert()
  {
    if(!$this->ajax_login_status())
    {
      return $this->json_output(true,'','admin/home');
    }

    $this->id->set_lastid($this->Customer_model->get_customer_id());
    $this->id->set_format(array('identifier'=>'C', 'separator'=>'-'));

    $this->_data = array(
      'custid'=>$this->id->create_id(),
      'cus_firstname'=>$this->input->post('fname'),
      'cus_lastname'=>$this->input->post('lname'),
      'cus_number'=>$this->input->post('number'),
      'cus_email'=>$this->input->post('email'),
      'cus_createdDate'=>mdate($this->config->item('date_format'))
    );

    $this->form_validation->set_rules('fname','First name','trim|required|alpha');
    $this->form_validation->set_rules('lname','Last name','trim|required|alpha');
    $this->form_validation->set_rules('number','Phone number','trim|required|regex_match[/^[0-9]{10}$/]');
    $this->form_validation->set_message('regex_match', 'Please enter a valid phone number');
    $this->form_validation->set_rules('email','Email','trim|valid_email');

    if($this->form_validation->run()==FALSE)
    {
      return $this->json_output(false, validation_errors());
    }

    if($this->Customer_model->insert_customer($this->_data) < 0)
    {
      log_message('error', 'Error when inserting customer');
      return $this->json_output(false, 'Problem when adding this customer to database, Please try again');
    }

    return $this->json_output(true, 'Customer added successfully','admin/customer');
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
    $this->_data['links'] = $this->html_pagination($page, $rows_per_page, $total_rows);

    if ($page == 0) $page = 1;
    $start = ($page - 1) * $rows_per_page;

    $this->_data['results'] = $this->Customer_model->get_alldata($rows_per_page, $start);
    $this->load->view('admin/lab/customer/customer_list', $this->_data);
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
      $this->_data['empty'] = "<strong>".$customer_id."</strong>"." "."This Customer owns <strong>zero</strong> memo cards / certificates.";
      return $this->load->view('admin/lab/customer/specific_data', $this->_data);
    }

    $this->_data['customers'] = $this->Customer_model->get_customer_by_id($customer_id);
    $this->_data['mdata'] = $this->Lab_model->memo_data($customer_id);
    $this->_data['cdata'] = $this->Lab_model->certificate_data($customer_id);

    return $this->load->view('admin/lab/customer/specific_data', $this->_data);
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

  /****/
  public function delete()
  {
    if($this->Customer_model->delete_customer($this->input->get('custid')) < 1)
    {
      return $this->json_output(false, "Couldn't delete your customer as requested, Please try again...");
    }
    return $this->json_output(true, "Your customer has been deleted");
  }

  /**
   * Public view for admin to edit existing customer
   *
   * @param null
   * @return void
   */
  public function append_toedit()
  {
    $this->_data = $this->Customer_model->get_customer_by_id($this->input->get('custid'));
    echo json_encode($this->_data);
  }

  /**
   * Function to update customer record to db
   *
   * @param null
   * @return void
   */
  public function update()
  {
    $this->_data = array(
      'cus_firstname'=>$this->input->post('fname'),
      'cus_lastname'=>$this->input->post('lname'),
      'cus_email'=>$this->input->post('email'),
      'cus_number'=>$this->input->post('number')
    );

    $this->form_validation->set_rules('fname','First name','trim|required|alpha');
    $this->form_validation->set_rules('lname','Last name','trim|required|alpha');
    $this->form_validation->set_rules('number','Phone number','trim|required|regex_match[/^[0-9]{10}$/]');
    $this->form_validation->set_message('regex_match', 'Please enter a valid phone number');
    $this->form_validation->set_rules('email','Email','trim|valid_email');

    if($this->form_validation->run()==FALSE)
    {
      return $this->json_output(false, validation_errors());
    }

    if($this->Customer_model->update_customer($this->input->post('custid'), $this->_data) < 1)
    {
      return $this->json_output(false, "Problem when updating data");
    }

    return $this->json_output(true, "Customer updated successfully", "admin/customer");

  }

  public function append_customer()
  {
    $customer = $this->input->get('q');
    $this->_data = $this->Customer_model->get_customer_by_name($customer);
    echo json_encode($this->_data);
  }

}
?>
