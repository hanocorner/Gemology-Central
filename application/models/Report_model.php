<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report_model extends CI_Model
{
  /**
   * Default Constructor init Database
   *
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Inserting a New customer
   *
   * @param $data Post values | array
   * @return Last insert id
   */
  public function insert_customer($data)
  {
    $this->db->insert('tbl_customer', $data);
    return $this->db->insert_id();
  }

  /**
   * Inserting a new Lab Report
   *
   * @param $data Post values | array
   * @return Last insert id
   */
  public function add_gemstone($data)
  {
    $this->db->insert('tbl_certificate', $data);
    return $this->db->insert_id();
  }

  /**
   * This will return no.of affected rows after
   * insert/update/delete/select
   *
   * @param none
   * @return value
   */
  public function get_affected_rows()
  {
    return $this->db->affected_rows();
  }

  /****/
  public function get_customer_data($limit, $start)
  {
    $this->db->select("*");
    $this->db->from('tbl_customer');
    $this->db->order_by("custid", "DESC");
    $this->db->limit($limit, $start);

    $query = $this->db->get();
    return $query->result();
  }

  /****/
  public function get_certificate_data($customer_id)
  {
    $sql = "SELECT cerno, cer_type, cer_object, cer_identification, cer_paymentStatus, cer_weight, cer_color, customerID FROM tbl_certificate WHERE customerID = $customer_id";

    $query = $this->db->query($sql);
    return $query->result();
  }

  /****/
  public function get_customer_name($key)
  {
    $this->db->select('cus_firstname, cus_lastname');
    $this->db->where('custid', $key);

    $result = $this->db->get('tbl_customer');
    $result = $result->result();

    return $result[0]->cus_firstname." ".$result[0]->cus_lastname;
  }

  /****/
  public function get_gem_no()
  {
    $sql = "SELECT `cerno` FROM `tbl_certificate` ORDER BY cerno DESC LIMIT 1";

    $query = $this->db->query($sql);
    $row = $query->row();

    if (isset($row))
    {
      return $row->cerno;
    }
    return null;
  }

  public function count_all($table)
  {
    $sql = "SELECT COUNT(*) AS total FROM $table ";

    $query = $this->db->query($sql);
    $result = $query->result();

    foreach ($result as $key)
    {
      return $key->total;
    }

  }

  public function get_report_data($id)
  {
    $this->db->select('*');
    $this->db->where('cerno', $id);
    $query = $this->db->get('tbl_certificate');

    return $query->row();
  }

  public function get_gem_data($field, $column)
  {
    $this->db->select('*');
    $this->db->from('tbl_certificate');
    $this->db->where($column, $field);
    $this->db->limit(1);

    $result_set = $this->db->get();

    if($result_set->num_rows() > 0)
    {
      return $result_set->result();
    }

    return false;
  }

  public function delete_data($table,$col,$colVal)
  {
    $this->db->where($col, $colVal);
    $query=$this->db->delete($table);

    if($query) { return true; }

    return false;
  }

  public function get_specific_data($id, $table, $column)
  {
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where($column, $id);
    $query = $this->db->get();

    return $query->row();
  }

  public function update($table,$col,$colVal,$data)
  {
    $this->db->where($col,$colVal);
    $query=$this->db->update($table, $data);

    if($query) {return true; }
    return false;
  }

  public function search_data($keywords)
  {
    if(is_array($keywords)) return false;

    if(sizeof($keywords) < 3)
    {
      
    }
    $sql = "SELECT * FROM tbl_customer WHERE cus_firstname LIKE '%$string%' OR cus_lastname LIKE '%$string%' OR custid LIKE '%$string%' ";

    $query = $this->db->query($sql);

    return $query->result();
  }

}
?>
