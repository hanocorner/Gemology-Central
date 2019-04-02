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

    $this->load->model('admin/gem/Gem_model', 'gem');

  }

  /** */
  public function add()
  {
    $this->_data['name'] = $this->input->post('name');
    $this->_data['description'] = $this->input->post('description');

    if($this->form_validation->run('gemstone') == FALSE) return $this->json_output(false, validation_errors());

    $rows = $this->gem->insert_gem($this->_data);
    if($rows < 1) return $this->json_output(false, 'Error was encountered while inserting...');

    return $this->json_output(true, 'Variety added successfully');
  }

  /** */
  public function populate()
  {
    $this->_data = $this->gem->list($this->input->get('q'));

    $this->output->set_content_type('application/json', 'utf-8');
    $this->output->set_output(json_encode($this->_data));
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
