<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gemstone extends Admin_Controller
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

    $this->load->helper(array('url'));
    $this->load->model(array('Gem_model'));

  }

  /****/
  public function add()
  {
    $data = array(
      "gem_name"=>$this->input->post('gemName'),
      "gem_description"=>$this->input->post('gemDesc')
    );
    if($this->form_validation->run('gemstone') == FALSE) return $this->json_output(false, validation_errors());
    $rows = $this->Gem_model->insert_gem($data);
    if($rows < 1) return $this->json_output(false, 'Error was encountered while inserting data');

    return $this->json_output(true, 'Gemstone added successfully');
  }

  /*****/
  public function gem_list()
  {
    $string = $this->input->get('q');
    $data = $this->Gem_model->get_gem_list($string);
    echo json_encode($data);
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
}
?>
