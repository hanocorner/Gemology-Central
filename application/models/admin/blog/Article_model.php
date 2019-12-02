<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Article_model extends CI_Model
{
  /*** */
  public $_result_count = null;

  public function __construct() {
      parent::__construct();
      $this->load->database();

      $this->table='tbl_posts';
  }

  public function insert($data){
    $query = $this->db->query('CALL insert_post(
      "'.$data['title'].'",
      "'.$data['author'].'",
      "'.$data['tags'].'",
      "'.$data['body'].'",
      "'.$data['url'].'",
      "'.$data['status'].'",
      "'.$data['image_name'].'",
      "'.$data['image_path'].'"
      )');

      return $query;
  }

  /** */
  public function get_article($id)
  {
    $this->db->select('*');
    $this->db->from('tbl_posts');
    $this->db->join('tbl_gem_image', 'tbl_posts.id = tbl_gem_image.reportid', 'right');
    $this->db->where('id', $id);
    $query = $this->db->get();

    return $query->row();
  }

  /** */
  public function get_all_articles_for_admin($rows_per_page, $start)
  {
    $this->db->trans_begin();

    $query = $this->db->query('SELECT SQL_CALC_FOUND_ROWS * FROM admin_populate_blog LIMIT '.$start.', '.$rows_per_page.'');
    $result_count = $this->db->query('SELECT FOUND_ROWS() AS total_rows');
        
    $this->db->trans_complete();
    $result_count = $result_count->result('object');
    $this->_result_count = (int) $result_count[0]->total_rows;

    return $query->result_array();
  }

  /** */
  public function get_article_by_url($url)
  {
    $query = $this->db->query('SELECT * FROM public_populate_blog WHERE url = "'.$url.'" ');

    return $query->row();
  }

  /** */
  public function get_recent_articles($rows_per_page, $start)
  {
    $this->db->trans_begin();

    $query = $this->db->query('SELECT SQL_CALC_FOUND_ROWS * FROM public_populate_blog LIMIT '.$start.', '.$rows_per_page.'');
    $result_count = $this->db->query('SELECT FOUND_ROWS() AS total_rows');
        
    $this->db->trans_complete();
    $result_count = $result_count->result('object');
    $this->_result_count = (int) $result_count[0]->total_rows;

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

  /**
   * Search Query used in front end
   */
  public function search_admin($title)
  {
    $query = $this->db->query("SELECT * from admin_populate_blog WHERE title LIKE '$title%' ");
    return $query->result_array();
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

  /** */
  public function update($data)
  {
    $query = $this->db->query('CALL update_post(
      "'.$data['id'].'",
      "'.$data['title'].'",
      "'.$data['author'].'",
      "'.$data['tags'].'",
      "'.$data['body'].'",
      "'.$data['url'].'",
      "'.$data['status'].'",
      "'.$data['image_name'].'",
      "'.$data['image_path'].'"
      )');

      return $query;
  }

  public function get_topArticle()
  {
    $this->db->select('*');
    $this->db->from('tbl_posts');
    $this->db->join('tbl_gem_image', 'tbl_posts.id = tbl_gem_image.reportid', 'left');
    $this->db->order_by('published_date', 'DESC');
    $query = $this->db->get();

    return $query->row();
  }

}
?>