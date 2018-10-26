<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Comment extends CI_Controller
{
  /**
    * Constructor for this class & module initialization
    *
    * @param none
    * @return none
    */
  public function __construct()
  {
    parent::__construct();

    $this->load->model('Comment_model');

    $this->load->library('session');

    //$this->load->helper('uri');

    $config = array('layoutManager'=>'admin');
    $this->load->library('layout', $config);

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }

  }

  /**
    * Default view for comment section
    *
    * @param none
    * @return none
    */
  public function index()
  {
    $this->layout->set_title('Comment Section');

    // Css & Js files
    $this->layout->add_include('assets/admin/css/jquery.dataTables.min.css');
    $this->layout->add_include('assets/admin/js/jquery.dataTables.min.js');
    $this->layout->add_include('assets/admin/js/comment.js');
    $this->layout->add_include('assets/admin/js/sweetalert.min.js');

    $this->layout->view('admin/blog/comment', '', 'admin/layouts/admin');

  }

  /**
   *
   */
  public function all()
  {
    $params = $_POST;

    $results = $this->Comment_model->all_comments($params);

    $html = array();
    foreach ($results as $data)
    {
      $html[] = $data;
    }

    $totalRecords = $this->Comment_model->count_all();

    $json_data = array(
      "draw"            => $params['draw'],
		  "recordsTotal"    => $totalRecords,
		  "recordsFiltered" => $totalRecords,
		  "data"            => $html
    );
    echo json_encode($json_data);
  }

  /****/
  public function status()
  {
    $id = $this->uri->segment(4);
    $status = $this->uri->segment(5);

    $data = array("cmnt_status"=>$status);
    if($this->Comment_model->update_status($data, $id))
    {
      $this->session->set_flashdata('success','Comment was successfully published');
    }
    redirect("admin/comment");
  }

  /****/
  public function delete()
  {
    $id = $this->uri->segment(4);

    if ($this->Comment_model->delete_data('commentid', $id))
    {
      $this->session->set_flashdata('success','You have successfully deleted the comment');
    }
    else {
      $this->session->set_flashdata('error','Error when deleting the comment');
    }
    redirect("admin/comment");
  }
}
?>
