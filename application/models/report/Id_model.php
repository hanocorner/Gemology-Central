<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Id_model extends CI_Model
{
  /**
   * Table name to be assigned
   *
   * @var string
   */
  private $_table = '';

  /**
   * Default Constructor
   *
   * @param none
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Set table name according to controller
   *
   * @param string table name
   * @return void
   */
  public function set_table($table_name)
  {
    $this->_table = $table_name;
  }

  /**
   * Get Id based on report type
   *
   * @param string $id report id
   * @return string last id on DB
   */
  public function get_id($columnid)
  {
    $this->db->select($columnid." AS id");
    $this->db->from($this->_table);
    $this->db->order_by($columnid, "DESC");
    $this->db->limit(1);

    $query = $this->db->get();
    $row = $query->row();

    if(isset($row->id)) return $row->id;
    return null;
  }
}
?>
