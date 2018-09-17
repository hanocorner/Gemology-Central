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

    $this->load->library(array('session', 'pagination', 'table'));

    $config = array('layoutManager'=>'admin');
    $this->load->library('layout', $config);

    $this->load->helper(array('url', 'form'));
    $this->load->model(array('Customer_model', 'Gem_model'));

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }
  }

  public function index()
  {
    // code...
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
}
?>
