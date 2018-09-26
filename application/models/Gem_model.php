<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gem_model extends CI_Model
{
  /**
   * Master Table for this model
   *
   * @var string
   */
  protected $tbl_lab = 'tbl_lab_report';

  /**
   * Table Memocard | child table
   *
   * @var string
   */
  protected $tbl_memocard = 'tbl_gem_memocard';

  /**
   * Table Gemstone Report | child table
   *
   * @var string
   */
  protected $tbl_report = 'tbl_gemstone_report';

  /**
   * Table Verbal Gemstone Report | child table
   *
   * @var string
   */
  protected $tbl_verbal = 'tbl_gem_verbal';

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

  /**
   * Fetching search data
   *
   * @param
   */
   public function fetch_search_data($value)
   {
     if(!is_array($value)) return false;

     switch ($value['reptype']) {
       case 'memo':
          $this->db->select('t1.rep_weight, t1.rep_color, t1.rep_shape, t1.rep_comment, t1.rep_gemWidth, t1.rep_gemHeight, t1.rep_gemLength, t2.memoid AS repid');
          $this->db->from($this->tbl_lab.' AS t1 ');
          $this->db->join($this->tbl_memocard.' AS t2', 't1.reportid = t2.reportid','left');
          $this->db->where('t1.rep_type', $value['reptype']);

          if($value['repno'] != '')
          {
            $this->db->like('t2.memoid', $value['repno'], 'both');
          }

          if($value['width'] != '')
          {
            $this->db->like('t1.rep_gemWidth', $value['width'], 'both');
          }

          if($value['weight'] != '')
          {
            $this->db->like('t1.rep_weight', $value['weight'], 'both');
          }

          if($value['color'] != '')
          {
            $this->db->like('t1.rep_color', $value['color'], 'both');
          }

          $query = $this->db->get();
          if($query->num_rows() > 0 ) return $query->result();
         break;

       case 'repo':
          $this->db->select('t1.rep_weight, t1.rep_color, t1.rep_shape, t1.rep_comment, t1.rep_gemWidth, t1.rep_gemHeight, t1.rep_gemLength, t2.gsrid AS repid');
          $this->db->from($this->tbl_lab.' AS t1');
          $this->db->join($this->tbl_report.' AS t2', 't1.reportid = t2.reportid','left');
          $this->db->where('t1.rep_type', $value['reptype']);

          if($value['repno'] != '')
          {
            $this->db->like('t2.memoid', $value['repno'], 'both');
          }

          if($value['width'] != '')
          {
            $this->db->like('t1.rep_gemWidth', $value['width'], 'both');
          }

          if($value['weight'] != '')
          {
            $this->db->like('t1.rep_weight', $value['weight'], 'both');
          }

          if($value['color'] != '')
          {
            $this->db->like('t1.rep_color', $value['color'], 'both');
          }

          $query = $this->db->get();
          if($query->num_rows() > 0 ) return $query->result();
         break;

      case 'verb':
         $this->db->select('t1.rep_weight, t1.rep_color, t1.rep_shape, t1.rep_comment, t1.rep_gemWidth, t1.rep_gemHeight, t1.rep_gemLength, t2.verbid AS repid');
         $this->db->from($this->tbl_lab.' AS t1');
         $this->db->join($this->tbl_verbal.' AS t2', 't1.reportid = t2.reportid','left');
         $this->db->where('t1.rep_type', $value['reptype']);

         if($value['repno'] != '')
         {
           $this->db->like('t2.verbid', $value['repno'], 'both');
         }

         if($value['width'] != '')
         {
           $this->db->like('t1.rep_gemWidth', $value['width'], 'both');
         }

         if($value['weight'] != '')
         {
           $this->db->like('t1.rep_weight', $value['weight'], 'both');
         }

         if($value['color'] != '')
         {
           $this->db->like('t1.rep_color', $value['color'], 'both');
         }

         $query = $this->db->get();
         if($query->num_rows() > 0 ) return $query->result();
        break;
     }
   }

  /*****/
  public function delete_report($id, $report_type)
  {
    switch ($report_type) {
      case 'memo':
        $sql = 'DELETE t1, t2 FROM '.$this->tbl_lab.' AS t1 JOIN '.$this->tbl_memocard.' AS t2 ON t1.reportid = t2.reportid WHERE t2.memoid = "'.$id.'" ';
        $this->db->escape_str($id);
        $query = $this->db->query($sql);
        if($this->db->affected_rows() > 0) return true;
        break;

      case 'repo':
        $sql = 'DELETE t1, t2 FROM '.$this->tbl_lab.' AS t1 JOIN '.$this->tbl_report.' AS t2 ON t1.reportid = t2.reportid WHERE t2.gsrid = "'.$id.'" ';
        $this->db->escape_str($id);
        $query = $this->db->query($sql);
        if($this->db->affected_rows() > 0) return true;
        break;

      case 'verb':
        $sql = 'DELETE t1, t2 FROM '.$this->tbl_lab.' AS t1 JOIN '.$this->tbl_verbal.' AS t2 ON t1.reportid = t2.reportid WHERE t2.verbid = "'.$id.'" ';
        $this->db->escape_str($id);
        $query = $this->db->query($sql);
        if($this->db->affected_rows() > 0) return true;
        break;
    }
  }


  /*****/
  public function get_data_for_preview($id, $report_type)
  {
    switch ($report_type) {
      case 'memo':
        $this->db->select('*');
        $this->db->from($this->tbl_lab.' AS t1');
        $this->db->join($this->tbl_memocard.' AS t2', 't1.reportid = t2.reportid');
        $this->db->where('t2.memoid', $id);
        $query = $this->db->get();
        return $query->row();
        break;

      case 'repo':

        if($this->db->affected_rows() > 0) return true;
        break;

      case 'verb':

        if($this->db->affected_rows() > 0) return true;
        break;
    }
  }
}
?>
