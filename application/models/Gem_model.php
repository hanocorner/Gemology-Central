<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gem_model extends CI_Model
{
  /**
   * Default Constructor init Database
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Inserting a gemstone
   *
   * @param $data Post values | array
   * @return Last insert id
   */
  public function insert_gem($data)
  {
    $this->db->insert('tbl_gem', $data);
    return $this->db->affected_rows();
  }

  /**
   * Fetching Gemstones
   *
   * @param none
   * @return Results
   */
  public function get_gem_list()
  {
    $this->db->select("gemid, gem_name");
    $this->db->from('tbl_gem');

    $query = $this->db->get();
    return $query->result();
  }
}
?>
