<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends Admin_Controller
{
  /**
   * Constructor method
   *
   * @param null
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->check_login_status();

    $this->load->library('id');
    $this->config->load('report');
  }

  /**
   * Default view for the customer page
   * 
   * @param null
   * @return void
   */
  public function index()
  {
    $this->layout->title = 'Customers';
    $this->layout->assets('assets/vendors/hullabaloo/hullabaloo.css');
    $this->layout->assets(base_url('assets/admin/js/customer.js'), 'footer');
    $this->layout->assets(base_url('assets/vendors/hullabaloo/hullabaloo.js'), 'footer');

    $this->_data['add_modal'] = $this->load->view('admin/customers/customer_add_modal', '', TRUE);
    $this->layout->view('admin/customers/index', $this->_data);
  }

  /**
   * Populating the customers grid 
   *
   * @param null
   * @return void
   */
  public function populate()
  {
    $page = $this->input->get('page');
    $rows_per_page = $this->input->get('rows');

    if ($page == 0) $page = 1;
    $start = ($page - 1) * $rows_per_page;

    $this->load->model('admin/customer/Customer_model', 'custdb');

    $this->_data['results'] = $this->custdb->all($rows_per_page, $start);
    $total_rows = $this->custdb->total_results;
    
    $this->_data['links'] = $this->html_pagination($rows_per_page, $total_rows);
    
    $this->load->view('admin/customers/customer_table', $this->_data);
  }

  /**
   * CI HTML Pagination library
   *
   * @param int $rows_per_page
   * @param int $total_rows
   * 
   * @return string
   */
  public function html_pagination($rows_per_page, $total_rows)
  {
    $this->load->library('pagination');
    
    $config['base_url'] = '/'.uri_string();
    $config["total_rows"] = $total_rows;
    $config["per_page"] = $rows_per_page;
    $config["use_page_numbers"] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
    $config["full_tag_open"] = '<ul class="pagination justify-content-end">';
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
    $config['attributes'] = array('class' => 'page-link', 'data-action'=>'pagination', 'data-rows'=>$rows_per_page);
    $this->pagination->initialize($config);

    return $this->pagination->create_links();
  }

  /**
   * This will insert a new customer to DB
   *
   * @param null
   * @return mixed
   */
  public function add()
  {
    $this->load->model('admin/customer/Customer_model', 'custdb');
    $this->id->set_lastid($this->custdb->get_customer_id());
    $this->id->set_format(array('identifier'=>'C', 'separator'=>'-'));

    $this->_data = $this->input->post();
    $this->_data['custid'] = $this->id->create_id();
    $this->_data['created_date'] = $this->_date;

    $this->form_validation->set_rules('firstname','First name','trim|required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('lastname','Last name','trim|required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('number','Phone number','trim|required|is_natural|min_length[7]|max_length[10]');
    $this->form_validation->set_rules('email','Email','trim|valid_email|min_length[15]|max_length[80]');

    if($this->form_validation->run()==FALSE)
    {
      return $this->json_output(false, validation_errors());
    }

    if($this->custdb->insert($this->_data) < 0)
    {
      return $this->json_output(false, 'Error when adding data, Please try again');
    }

    return $this->json_output(true, 'Customer added successfully','admin/customer');
  }

  

  /****/
  public function delete()
  {
    $this->load->model('admin/customer/Customer_model', 'custdb');
    if($this->custdb->delete_customer($this->input->post('cid')) < 1)
    {
      return $this->json_output(false, "Couldn't delete your customer as requested, Please try again...");
    }
    return $this->json_output(true, "Customer has been deleted");
  }

  /**
   * Public view for admin to edit existing customer
   *
   * @param null
   * @return void
   */
  public function populate_edit()
  {
    $this->load->model('admin/customer/Customer_model', 'custdb');
    $this->_data = $this->custdb->get_customer_by_id($this->input->post('cid'));
    $this->output->set_content_type('application/json', 'utf-8');
    $this->output->set_output(json_encode($this->_data));
  }

  /**
   * Function to update customer record to db
   *
   * @param null
   * @return void
   */
  public function update()
  {
    $this->load->model('admin/customer/Customer_model', 'custdb');
    $this->_data = $this->input->post(); 

    $this->form_validation->set_rules('firstname','First name','trim|required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('lastname','Last name','trim|required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('number','Phone number','trim|required|is_natural|min_length[7]|max_length[10]');
    $this->form_validation->set_rules('email','Email','trim|valid_email|min_length[15]|max_length[80]');

    if($this->form_validation->run()==FALSE)
    {
      return $this->json_output(false, validation_errors());
    }

    if(!$this->custdb->update_customer($this->_data))
    {
      return $this->json_output(false, "Problem when updating, Please try again");
    }

    return $this->json_output(true, "Customer updated successfully", "admin/customer");

  }

  /*** */
  public function append_customer()
  {
    $customer = $this->input->get('q');
    $this->_data = $this->Customer_model->get_customer_by_name($customer);
    echo json_encode($this->_data);
  }

}
?>
