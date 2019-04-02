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

 /** */
  public function get_list($name)
  { 
    $name = (string) $name;
    $sql = "SELECT distinct gemid, name FROM tbl_gem WHERE name LIKE '".$name."%' ORDER BY name ASC LIMIT 5";
    $query = $this->db->query($sql);
    return $query->result('array');
  }

}
?>
