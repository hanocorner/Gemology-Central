<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Handler extends Admin_Controller
{
  /**
   * Report ID
   *
   * @var string
   */
  protected $next_id = '';

  /**
   * Report Type
   *
   * @var string
   */
  protected $report_type = '';

  /**
   * Report Image name
   *
   * @var string
   */
  protected $_img_name = "";

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

    $this->load->model('admin/report/Data_model');
  }

  /**
   *
   *
   */
  public function index()
  {
    $this->layout->title = 'All Reports';
    $this->layout->assets(base_url('assets/vendors/hullabaloo/hullabaloo.js'), 'footer');
    $this->layout->view('admin/lab/report/index');
  }

  /** */
  public function fetch_all()
  {
    $page = $this->input->get('page');
    $rows_per_page = $this->input->get('rows');

    $total_rows = $this->Data_model->get_total_rows();
    
    $this->_data['links'] = $this->html_pagination($page, $rows_per_page, $total_rows);
  
    if ($page == 0) $page = 1;
    $start = ($page - 1) * $rows_per_page;

    if($this->input->get('search') == true)
    {
      $this->_data['results'] = $this->Data_model->search_data($this->input->get());
      $this->load->view('admin/lab/report/all_report_data', $this->_data);
    }
    else 
    {
      $this->_data['results'] = $this->Data_model->fetch_all_report_data($rows_per_page, $start);
      $this->load->view('admin/lab/report/all_report_data', $this->_data);
    }

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
    $config["uri_segment"] = 5;
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
    $config["cur_tag_open"] = "<li class='page-item active'><a href='#' class='page-link'>";
    $config["cur_tag_close"] = "</a></li>";
    $config["num_tag_open"] = "<li class='page-item'>";
    $config["num_tag_close"] = "</li>";
    $config["num_links"] = 2;
    $config['attributes'] = array('class' => 'page-link', 'data-action'=>'pagination');
    $this->pagination->initialize($config);

    return $this->pagination->create_links();
  }

  /** */
  public function update_payment()
  {
    $this->_data = $this->input->get();

    if($this->Data_model->update_payment_status($data)) 
    {
      return $this->json_output(true, 'Payment status was successfully updated');
    }
    return $this->json_output(false, 'Problem when updating payment status');
  }


  /****/
  public function add()
  {
    $this->layout->title = 'Add Report';
    $this->layout->assets('assets/vendors/jqueryui/jquery-ui.min.css');
    $this->layout->assets(base_url('assets/vendors/editor/ckeditor.js'), 'header');
    
    $this->layout->assets(base_url('assets/vendors/jqueryui/jquery-ui.min.js'), 'footer');
    $this->layout->assets(base_url('assets/admin/js/report.js'), 'footer');

    $this->layout->view('admin/lab/report/add');
  }

  /****/
  public function insert()
  {
    $this->next_id = $this->input->post('rmid');
    $this->report_type = $this->input->post('repotype');
    
    if($this->form_validation->run('report') == FALSE) return $this->json_output(false, validation_errors());

    if(is_uploaded_file($_FILES['imagegem']['tmp_name']))
    {
      $this->load->library('image');
      $upload = $this->image->img_upload($_FILES, 'imagegem', $this->next_id, 'gem');
      if(!$upload) return $this->json_output(false, $this->image->errors);
      $this->_img_name = $upload;
    }

    $this->_data = $this->input->post();
    $this->_data['img_gem'] = date('Y').'/'.date('m').'/'.$this->_img_name;
    $this->_data['created_date'] = $this->_date;
    $this->_data['qrtoken'] = $this->qrcode($this->next_id);
    $this->_data['report_status'] = 0;

    $result = $this->Data_model->insert_report($this->_data);

    if($result == FALSE)
    {
      log_message('error', 'Error Encountered when adding a new report');
      return $this->json_output(false, 'Insertion unsuccessful');
    }

    return $this->json_output(true, 'Report Created successfully', 'admin/report/handler/download/'.$this->_qrcode);
    
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
    $qrcode = $this->uri->segment(5);
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

    $params['data'] = base_url('report/'.$string);
    $params['level'] = 'H';
    $params['size'] = 8;
    $params['savename'] = './assets/images/qr/'.$this->_qrcode;

    if($this->ciqrcode->generate($params)) return $string;

    return $id;
  }

  /*****/
  public function edit()
  {
    $this->report_type = $this->uri->segment(4);
    $this->next_id = $this->uri->segment(5);
    $params['id'] = $this->next_id;
    $params['type'] = $this->report_type;

    $this->_data['results'] = $this->Data_model->get_report_edit($params);

    if(empty($this->_data['results'])) redirect('admin/report/all');
    
    $this->layout->title = 'Add Report';
    $this->layout->assets('assets/vendors/jqueryui/jquery-ui.min.css');
    $this->layout->assets(base_url('assets/vendors/editor/ckeditor.js'), 'header');
    $this->layout->assets(base_url('assets/vendors/jqueryui/jquery-ui.min.js'), 'footer');
    $this->layout->assets(base_url('assets/admin/js/report.js'), 'footer');

    $this->layout->view('admin/lab/report/edit', $this->_data);
  }

  /****/
  public function update()
  {
    $this->next_id = $this->input->post('rmid');
    // radio-1 = Report Type (Form Validation)
    $this->report_type = $this->input->post('repotype');

    if($this->form_validation->run('report') == FALSE) return $this->json_output(false, validation_errors());

    if(is_uploaded_file($_FILES['imagegem']['tmp_name']))
    {
      $this->load->library('image');
      $upload = $this->image->img_upload($_FILES, 'imagegem', $this->next_id, 'gem');
      if(!$upload) return $this->json_output(false, $this->image->errors);
      $this->_img_name = $upload;
    }

    $this->_data = $this->input->post();

    // Lab Report ID
    $this->_data['reportid'] = $this->input->post('reportid');
    

    $this->_data['img_gem'] = date('Y').'/'.date('m').'/'.$this->_img_name;

    // CALL SP
    $result = $this->Data_model->update_report($this->_data);

    // if($result == FALSE)
    // {
    //   log_message('error', 'Error Encountered when Updating the report');
    //   return $this->json_output(false, 'Update unsuccessful');
    // }
    
    return $this->json_output(true, 'Report was successfully updated, Redirecting...', 'admin/report/all');
  }



  /**
   * This check the dropdown list default value
   *
   * @param string $post_string value from dropdown
   * @return bool
   */
  public function check_default($post_string)
  {
    return $post_string == 'default' ? FALSE : TRUE;
  }

  /**
   * This check the dropdown list default value
   *
   * @param string $post_string value from dropdown
   * @return bool
   */
  public function special_chars($post_string)
  {
    if($post_string != null || $post_string != '')
    {
      if(!preg_match('/^[a-z0-9 .\-]+$/i', $post_string)) return false;
      return true;
    }

    return;
  }

  /**
   * Setting id according to report type selected by user
   *
   * @param null
   * @return null
   */
  public function id()
  {
    $this->report_type = $this->input->get('repotype');

    $this->load->library('id');
    $this->load->model('admin/report/Id_model', 'idm');

    $lastid = '';
    $format = array();

    if($this->report_type === 'memo')
    {
      $this->idm->set_table('tbl_gem_memocard');
      $lastid = $this->idm->get_id('id');
      $format = array('separator'=>'-');
    }
    elseif ($this->report_type === 'repo')
    {
      $this->idm->set_table('tbl_gemstone_report');
      $lastid = $this->idm->get_id('id');
      $format = array('identifier'=>date('Y'), 'separator'=>'-', 'month'=>date('m'));
    }
    elseif ($this->report_type === 'verb')
    {
      $this->idm->set_table('tbl_gem_verbal');
      $lastid = $this->idm->get_id('id');
      $format = array('identifier'=>'V', 'separator'=>'-');
    }

    $this->id->set_lastid($lastid);
    $this->id->set_format($format);
    echo $this->id->create_id();
  }

  public function populate_spgroup()
  {
    $string = $this->input->get('q');
    $this->_data = $this->Data_model->get_species_group($string);
    echo json_encode($this->_data);
  }

  public function populate_shapecut()
  {
    $string = $this->input->get('q');
    $this->_data = $this->Data_model->get_shapecut($string);
    echo json_encode($this->_data);
  }

  public function populate_color()
  {
    $string = $this->input->get('q');
    $this->_data = $this->Data_model->get_color($string);
    echo json_encode($this->_data);
  }
}
?>
