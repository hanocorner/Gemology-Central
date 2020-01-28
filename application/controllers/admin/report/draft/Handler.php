<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Handler extends Admin_Controller
{
  /**
   * Qr Code 
   * 
   * @var string
   */
  private $_qrcode = '';

  /**
   * Constructor initializing  all the the required classes
   *
   * @param none
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->check_login_status();

    $this->load->model('admin/report/Report_model');
  }

  /*** */
  public function index()
  {
    $this->layout->title = 'Draft Reports';
    $this->layout->assets('assets/vendors/jqueryui/jquery-ui.min.css');    
    $this->layout->assets(base_url('assets/vendors/jqueryui/jquery-ui.min.js'), 'footer');
    $this->layout->assets(base_url('assets/admin/js/report.draft.js'), 'footer');
    $this->layout->view('admin/report/draft/index');
  }

  /** */
  public function populate_draft()
  {
    $page = $this->input->get('page');
    $rows_per_page = $this->input->get('rows');

    if ($page == 0) $page = 1;
    $start = ($page - 1) * $rows_per_page;

    if($this->input->get('search') == true)
    {
      $this->_data['results'] = $this->Report_model->search_draft($this->input->get('id')); 
    }
    else {
      $this->_data['results'] = $this->Report_model->get_draft_data($rows_per_page, $start);
      
    }
    $this->_data['links'] = $this->html_pagination($page, $rows_per_page, $this->Report_model->_result_count);
    $this->load->view('admin/report/draft/table', $this->_data);

  }

  /**
   * CI HTML Pagination library
   *
   * @param $start
   * @param $length
   */
  public function html_pagination($page, $rows_per_page, $total_rows)
  {
    $this->load->library('pagination');

    $config['base_url'] = '#';
    $config["total_rows"] = $total_rows;
    $config["per_page"] = $rows_per_page;
    $config["uri_segment"] = 6;
    $config["use_page_numbers"] = TRUE;
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
    $config["cur_tag_open"] = "<li class='page-item active'><a href='' class='page-link'>";
    $config["cur_tag_close"] = "</a></li>";
    $config["num_tag_open"] = "<li class='page-item'>";
    $config["num_tag_close"] = "</li>";
    $config["num_links"] = 2;
    $config['attributes'] = array('class' => 'page-link', 'data-action'=>'pagination');
    $this->pagination->initialize($config);

    return $this->pagination->create_links();
  }

  /****/
  public function add()
  {
    $id = $this->input->post('reportid');
    
    if($this->form_validation->run('draft') == FALSE) return $this->json_output(false, validation_errors());

    $this->_data = $this->input->post();
    $this->_data['qrtoken'] = $this->qrcode($id);
    $this->_data['status'] = FALSE;

    $result = $this->Report_model->insert_draft($this->_data);

    if($result == FALSE)
    {
      log_message('error', 'Error Encountered when adding a new report');
      return $this->json_output(false, 'Insertion unsuccessful');
    }

    return $this->json_output(true, 'Report Created successfully', 'admin/report/draft/handler/download/'.$this->_qrcode);
  }

  /**
   * AJAX Request to download Qr
   *
   * @param null
   * @return void
   */
  public function download()
  {
    $this->load->helper('download');
    $qrcode = $this->uri->segment(6);
    $qrcode = $qrcode;
    $data = file_get_contents(base_url('assets/images/qr/'.$qrcode));
    force_download($qrcode, $data);
  }

  /****/
  public function qrcode($id)
  {
    $this->load->library('ciqrcode');
    $this->load->helper('string');

    $string = random_string('alnum', 16);

    $this->_qrcode = $id.'.png';

    $params['data'] = 'https://gemologycentral.com/report/'.$string;
    $params['level'] = 'H';
    $params['size'] = 8;
    $params['savename'] = './assets/images/qr/'.$this->_qrcode;

    if($this->ciqrcode->generate($params)) return $string;

    return $id;
  }

  /** */
  public function payment()
  {
    $this->form_validation->set_rules('price', 'Amount', 'trim|required|integer');
    $this->form_validation->set_rules('advance', 'Advance', 'trim|integer');
    if ($this->form_validation->run() == FALSE) return $this->json_output(false, validation_errors());

    $this->_data = $this->input->post();

    $result = $this->Report_model->update_payment($this->_data);
    if($result == FALSE)
    {
      return $this->json_output(false, 'Insertion unsuccessful');
    }
    $json_response = array('auth'=>TRUE, 'message'=>'Update Successful', 'total'=>$this->Report_model->get_receipt_count());
    $this->output->set_content_type('application/json', 'utf-8');
    $this->output->set_output(json_encode($json_response));
    
  }

  /*** */
  public function delete()
  {
    $this->_data['repid'] = $this->input->get('id');
    $this->_data['type'] = $this->input->get('type');

    $result = $this->Report_model->delete_draft($this->_data);

    if($result == FALSE) 
    {
      return $this->json_output(false, 'Deletion unsuccessful');
    }
    
    return $this->json_output(true, 'Record was successfully deleted');
  }

  

}