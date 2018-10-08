<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gemstone extends CI_Controller
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

    $this->load->library(array('session','table'));

    $config = array('layoutManager'=>'admin');
    $this->load->library('layout', $config);

    $this->load->helper(array('url'));
    $this->load->model(array('Gem_model'));

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }
  }

  public function index()
  {
    // code...
  }

  /*****/
  public function search()
  {
    $this->layout->set_title('Search Report');
    $this->layout->add_include('assets/admin/js/gemstone.js');
    $this->layout->add_include('assets/admin/js/sweetalert.min.js');

    return $this->layout->view('admin/lab/gemstone/search', '', 'admin/layouts/admin');
  }

  /****/
  public function search_data()
  {
    $input['reptype'] = $this->input->get('reportType');
    $input['weight'] = $this->input->get('weight');
    $input['repno'] = $this->input->get('reportNo');
    $input['color'] = $this->input->get('color');
    $input['width'] = $this->input->get('width');

    $data = $this->Gem_model->fetch_search_data($input);
    $table = $this->html_table($data);
    echo $table;
  }

  /****/
  public function html_table($data)
  {
    $template = array('table_open'=>'<table class="table table-bordered table-dark">');
    $this->table->set_template($template);
    $this->table->set_caption('Search Results');
    $this->table->set_heading(array('Report No.', 'Weight', 'Dimensions (W x H x L)', 'Color', 'Shape', 'Comment', 'Other', 'Action'));

    if(empty($data))
    {
      $this->table->add_row('No records found');
      return $this->table->generate();
    }

    foreach ($data as $values)
    {
      $this->table->add_row(
        $values->repid,
        $values->rep_weight,
        $values->rep_gemWidth." x ".$values->rep_gemHeight." x ".$values->rep_gemLength,
        $values->rep_color,
        $values->rep_shapecut,
        $values->rep_comment,
        '#',
        '<button type="button" class="btn btn-sm btn-primary" data-id="'.$values->repid.'" data-action="preview" ><i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;&nbsp;
        <a href="'.base_url().'admin/report/edit/memo/'.$values->repid.'" class="btn btn-sm btn-warning" target="_blank"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
        <button type="button" class="btn btn-sm btn-danger" data-id="'.$values->repid.'" data-action="delete" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i></button>&nbsp;&nbsp;
        <input type="hidden" id="repid" value="'.$values->repid.'">
        '
      );
    }

    return $this->table->generate();
  }

  /****/
  public function add()
  {
    $data = array(
      "gem_name"=>$this->input->post('gemName'),
      "gem_description"=>$this->input->post('gemDesc')
    );

    $rows = $this->Gem_model->insert_gem($data);
    if($rows == 1)
    {
      echo 'success';
      return true;
    }
    else {
      echo 'fail';
      return false;
    }
  }

  /*****/
  public function gem_list()
  {
    $data = $this->Gem_model->get_gem_list();
    echo json_encode($data);
  }

  /****/
  public function delete()
  {
    $id = $this->input->post('repid');
    $report_type = $this->input->post('repoType');

    if($this->Gem_model->delete_report($id, $report_type))
    {
      $this->session->set_flashdata('success', 'Report '.$id.' was successully deleted');
    }
    else
    {
      $this->session->set_flashdata('error', 'Error when deleting this report '.$id);
    }
  }

  /****/
  public function preview()
  {
    $id = $this->input->get('repid');
    $report_type = $this->input->get('repoType');
    $result = $this->Gem_model->get_data_for_preview($id, $report_type);
    echo json_encode($result);
  }
}
?>
