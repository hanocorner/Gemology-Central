<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer_model extends CI_Model
{
  /**
   * Total result count for pagination
   * 
   * @var int
   */
  public $total_results = null;

  /**
   * Default Constructor init Database
   */
  public function __construct()
  {
    parent::__construct();
  }

  /** */
  public function all($rows_per_page, $start)
  {
    $sql = '';

    $sql .= 'SELECT SQL_CALC_FOUND_ROWS * FROM tbl_customer ';

    $sql .= 'ORDER BY custid DESC ';

    $sql .= 'LIMIT '.$start.', '.$rows_per_page.' ';

    $query = $this->db->query($sql);

    $result_count = $this->db->query('SELECT FOUND_ROWS() AS total_rows');
    $result_count = $result_count->result('object');
    $this->total_results = (int) $result_count[0]->total_rows;

    return $query->result('array');
  }


  /**
   * Inserting a new customer
   *
   * @param $data Post values | array
   * @return Last insert id
   */
  public function insert($data)
  {
    $this->db->insert('tbl_customer', $data);
    return $this->db->affected_rows();
  }

  /**
   * Updating a new customer
   *
   * @param string $id
   * @param array $data post values
   *
   * @return int affected rows
   */
  public function update_customer($data)
  {
    $this->db->where('custid', $data['custid']);
    return $this->db->update('tbl_customer', $data);
  }

    /*****/
    public function delete_customer($id)
    {
      $this->db->where('custid', $id);
      $query = $this->db->delete('tbl_customer');
      return $this->db->affected_rows();
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
    $query = $this->db->get();
    $result = $query->row();
    return $result->custid;
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
    return $query->row();
  }



  public function get_customer_by_name($name)
  {
    $sql = "SELECT distinct custid, firstname, lastname FROM tbl_customer WHERE firstname LIKE '$name%' OR lastname LIKE '$name%' ORDER BY firstname ASC LIMIT 5";
    $query = $this->db->query($sql);
    return $query->result('array');
  }
}
?>
