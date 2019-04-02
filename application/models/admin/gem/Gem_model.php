<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gem_model extends CI_Model
{
  /**
   * Default Constructor
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Inserting a gemstone
   *
   * @param $data Post values
   * @return Last insert id
   */
  public function insert_gem($data)
  {
    $this->db->insert('tbl_gem', $data);
    return $this->db->affected_rows();
  }

  /**
   * Gemstone List
   *
   * @param string $name
   * @return Results
   */
  public function list($name)
  { 
    $query = $this->db->query("SELECT distinct gemid, name FROM tbl_gem WHERE name LIKE '$name%' Order by name ASC LIMIT 5");
    return $query->result('array');
  }
}
?>
