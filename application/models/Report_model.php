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
  public function get_customer_data($params)
  {
    $sql = '';
    $start = $params['start'];
    $length = $params['length'];
    $search = $params['search']['value'];

    $sql .= 'SELECT custid, cus_firstname, cus_lastname, cus_email FROM tbl_customer';

    if ($search != '')
    {
      $sql .= " WHERE cus_firstname LIKE '%$search%' OR cus_lastname  LIKE '%$search%' OR cus_email LIKE '%$search%' ";
    }
    else
    {
      $sql .= " ORDER BY custid DESC LIMIT $start, $length";
    }
    $query = $this->db->query($sql);
    return $query->result();
  }

  /****/
  public function get_certificate_data($params)
  {
    $sql = '';
    $id = $params['id'];
    $start = $params['start'];
    $length = $params['length'];
    $search = $params['search']['value'];

    $sql .= "SELECT cerno, cer_type, cer_object, cer_identification, cer_paymentStatus, cer_weight, customerID FROM tbl_certificate ";

    if ($search != '')
    {
      $sql .= " WHERE customerID = $id HAVING cerno LIKE '%$search%' OR cer_object LIKE '%$search%' OR cer_weight LIKE '%$search%' ";
    }
    else
    {
      $sql .= " WHERE customerID = $id ORDER BY cerno DESC LIMIT $start, $length";
    }
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

  public function search_data($data)
  {
    /*if (!is_array($data)) { return false; }
    $cus = $data['customer'];
    $shp = $data['shape'];
    $wet = $data['weight'];
    $col = $data['color'];*/

    $sql = "SELECT t1.custid, t1.cus_firstname, t1.cus_lastname, t1.cus_email, t2.cer_color, t2.customerID, t2.cer_shape, t2.cer_weight, t2.cerno, t2.cer_paymentStatus
            FROM tbl_customer AS t1 INNER JOIN tbl_certificate AS t2 ON t1.custid = t2.customerID
            WHERE t1.cus_firstname LIKE '%$data%' ";

    $query = $this->db->query($sql);

    return $query->result();
  }

  /****/
  public function get_total()
  {
    $sql = "SELECT COUNT(*) AS total FROM tbl_customer ";

    $query = $this->db->query($sql);
    $result = $query->result();
    foreach ($result as $key) return $key->total;
  }

}
?>
