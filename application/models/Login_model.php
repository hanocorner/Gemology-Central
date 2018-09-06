<?php
class Login_model extends CI_Model
{
  public function __construct()
  {
      parent::__construct();

      $this->table = null;
  }

  public function authentication($field, $table_name, $column)
  {
     $this->table = $table_name;

     $this->db->select('*');
     $this->db->from($this->table);
     $this->db->where($column, $field);
     $this->db->limit(1);

     $result_set = $this->db->get();

     if($result_set->num_rows() > 0)
     {
       $result = $result_set->row();
       return $result->admid;
     }
     return false;
  }

  public function get_user_details($table_name, $field, $column)
  {
    $this->table = $table_name;

    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where($column, $field);
    $this->db->limit(1);

    $result_set = $this->db->get();

    if ($result_set->num_rows() > 0) {
      return $result_set->result();
    }
    return 'empty';
  }

  public function get_user_data($column, $table_name)
  {
    if(empty($column)) return false;

    $this->table = $table_name;

    $this->db->select($column);
    $this->db->from($this->table);

    $result_set = $this->db->get();

    if ($result_set->num_rows() > 0) {
      return $result_set->result();
    }
    return 'empty';

  }

  public function update_admin_data($table_name, $column, $colVal, $data)
  {

    if(empty($column) || empty($colVal)) return false;

    $this->table = $table_name;

    $this->db->where($column, $colVal);
    $query = $this->db->update($this->table, $data);

    return $query;
  }
}
?>
