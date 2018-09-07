<?php
class Comment_model extends CI_Model
{
  /**
   * Default Constructor for DB class
   *
   * @param none
   * @return none
   */
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  /****/
  public function all_comments($params)
  {
    $sql = '';
    $start = $params['start'];
    $length = $params['length'];
    $search = $params['search']['value'];

    $sql .= 'SELECT * FROM tbl_postcomments';

    if ($search != '')
    {
      $sql .= " WHERE cmnt_auhtor LIKE '%$search%' ";
    }
    else
    {
      $sql .= " ORDER BY commentid DESC LIMIT $start, $length ";
    }
    $query = $this->db->query($sql);
    return $query->result();
  }

  /****/
  public function count_all()
  {
    $sql = "SELECT COUNT(*) AS total FROM tbl_postcomments ";

    $query = $this->db->query($sql);
    $result = $query->result();
    foreach ($result as $key) return $key->total;
  }

  /****/
  public function update_status($data, $key)
  {
    $this->db->where('commentid', $key);
    return $this->db->update('tbl_postcomments', $data);
  }

  /****/
  public function delete_data($column, $value)
  {
    $this->db->where($column, $value);
    $query=$this->db->delete('tbl_postcomments');

    if($query) return true;

    return false;
  }
}
?>
