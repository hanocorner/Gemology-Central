<?php
class Article_model extends CI_Model
{
  public function __construct() {
      parent::__construct();
      $this->load->database();

      $this->table='tbl_posts';
  }

  public function insert($table, $data){
      $this->db->insert($table, $data);
      return $this->db->insert_id();
  }

  public function get_all_articles($params)
  {
    $sql = '';
    $start = $params['start'];
    $length = $params['length'];
    $search = $params['search']['value'];

    $sql .= 'SELECT postid, post_title, post_date, post_published, post_url FROM tbl_posts';

    if ($search != '')
    {
      $sql .= " WHERE post_title LIKE '%$search%' ";
    }
    else
    {
      $sql .= " ORDER BY postid DESC LIMIT $start, $length ";
    }
    $query = $this->db->query($sql);
    return $query->result();
  }

  public function get_article($url)
  {
    $sql = "SELECT * FROM tbl_posts AS t1 INNER JOIN tbl_postMetaData AS t2 ON t1.postid = t2.post_id WHERE t1.post_url = '$url' ";

    $query = $this->db->query($sql);
    return $query->row();
  }

  public function set_topArticle($id)
  {
    $sql = "UPDATE tbl_posts SET post_topArticle = CASE WHEN postid = '$id' THEN 1 ELSE 0 END ";

    $query = $this->db->query($sql);

    return $query;
  }

  public function get_recent_articles()
  {
    $sql = "SELECT * FROM tbl_posts ORDER BY postid DESC LIMIT 2";

    $query = $this->db->query($sql);
    return $query->result();
  }

  public function about_page_articles()
  {
    $sql = "SELECT * FROM tbl_posts ORDER BY postid DESC LIMIT 4";

    $query = $this->db->query($sql);
    return $query->result();
  }

  public function get_related_articles($tag)
  {
    $sql = "SELECT * from tbl_posts WHERE post_tag IN ('$tag') ORDER BY rand() LIMIT 4";

    $query = $this->db->query($sql);
    return $query->result();
  }

  /****/
  public function get_report_data($report)
  {
    $sql = "SELECT * FROM tbl_certificate WHERE cerno = '$report' ";

    $query = $this->db->query($sql);
    return $query->row();
  }

  /**
   * Search Query used in front end
   */
  public function search_article($title)
  {
    $sql = "SELECT post_title from tbl_posts WHERE post_title LIKE '%$title%' ";

    $query = $this->db->query($sql);
    return $query->row();
  }

  public function get_topArticle()
  {
    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('post_topArticle', 1);
    $query=$this->db->get();
    return $query->row();

  }

  public function check_url($url)
  {
    $sql = "SELECT post_url FROM tbl_posts WHERE post_url LIKE '%$url%' ";

    $query = $this->db->query($sql);
    $result = $query->row();

    if(!empty($result->post_url))
    {
      return $result->post_url;
    }
    return false;
  }

  public function del($column, $value)
  {
    $this->db->where($column, $value);

    $query=$this->db->delete('tbl_posts');

    if($query) return true;

    return false;
  }

  public function update($table,$col,$colVal,$data)
  {
    $this->db->where($col, $colVal);
    $query=$this->db->update($table,$data);

    if($query) return true;

    return false;
  }

  public function get_id($value)
  {
    $sql = "SELECT postid, post_url FROM tbl_posts WHERE post_url = '$value'";

    $query = $this->db->query($sql);
    $result = $query->row();
    return $result->postid;
  }

  public function update_batch($data, $key)
  {
    $this->db->where('post_url', $key);
    return $this->db->update('tbl_posts', $data);
  }

  public function count_all()
  {
    $sql = "SELECT COUNT(*) AS total FROM tbl_posts ";

    $query = $this->db->query($sql);
    $result = $query->result();
    foreach ($result as $key) return $key->total;
  }

}
?>
