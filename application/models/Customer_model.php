<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer_model extends CI_Model
{
  /**
   * Default Constructor init Database
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Inserting a new customer
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
   * This will return no.of affected rows after
   * insert/update/delete/select
   *
   * @param none
   * @return value | int
   */
  public function get_affected_rows()
  {
    return $this->db->affected_rows();
  }

  /**
   * Fetcing all Customer data
   *
   * @param $limit | int
   * @param $start | int
   * @return results
   */
  public function get_alldata($limit, $start)
  {
    $this->db->select("custid, cus_firstname, cus_lastname");
    $this->db->from('tbl_customer');
    $this->db->order_by("custid", "DESC");
    $this->db->limit($limit, $start);

    $query = $this->db->get();
    return $query->result();
  }

  /**
   * Total number of rows in customer table
   *
   * @param none
   * @return no.of rows | int
   */
  public function count_all()
  {
    return $this->db->count_all('tbl_customer');
  }

  /**
   * Query to search customers by first name and last name
   *
   * @param $keywords | array
   * @return Results
   */
  public function search_query($keywords)
  {
    $sql = '';
    if(!is_array($keywords)) return false;

    $sql .= "SELECT * FROM tbl_customer";

    if(isset($keywords[0]))
    {
      $fname = $keywords[0];
      $sql .= " WHERE (CONCAT(cus_firstname, cus_lastname) LIKE '%$fname%')";
    }
    if(isset($keywords[1]))
    {
      $lname = $keywords[1];
      $sql .= " AND (CONCAT(cus_firstname, cus_lastname) LIKE '%$lname%')";
    }

    $query = $this->db->query($sql);
    return $query->result();
  }

  /**
   * Fetcing existing customer id to generate a new id
   *
   * @param none
   * @return id | string
   */
  public function get_customer_id()
  {
    $this->db->select("custid");
    $this->db->from('tbl_customer');
    $this->db->order_by("custid", "DESC");
    $this->db->limit(1);

    return $this->db->get()->row()->custid;
  }

  /**
   * Fetcing a specific customer by id
   *
   * @param none
   * @return id | string
   */
  public function get_customer_by_id($customerid)
  {
    $this->db->select("*");
    $this->db->from('tbl_customer');
    $this->db->where("custid", $customerid);

    $query = $this->db->get();
    return $query->result();
  }

}
?>
