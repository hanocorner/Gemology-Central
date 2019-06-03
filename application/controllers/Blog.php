<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends Public_Controller
{
  /**
   * Constructor (loading the important class)
   */
  public function __construct()
  {
    parent::__construct();
    

    $this->load->model('admin/blog/Article_model', 'article');
  }

  /**
   * Base view for the blog
   */
  public function index()
  {
    $this->layout->title = 'Blog GCL';
    $this->layout->description = 'Blog';
    $this->layout->keywords = 'Lab, Blog';
    
    $this->layout->assets(base_url('assets/public/js/blog.js'), 'footer');
    $this->layout->view('public/blog/index');
  }

  /** */
  public function all()
  {
    $page = $this->input->get('page');
    $rows_per_page = $this->input->get('rows');

    if ($page == 0) $page = 1;
    $start = ($page - 1) * $rows_per_page;

    $this->_data['results'] = $this->article->get_recent_articles($rows_per_page, $start);

    $this->_data['links'] = $this->html_pagination($page, $rows_per_page, $this->article->_result_count);

    $this->load->view('public/blog/all_articles', $this->_data);
  }

  /**
   * CI HTML Pagination library
   *
   * @param $start
   * @param $length
   */
  public function html_pagination($page, $rows_per_page, $total_rows)
  {
    $this->load->library('pagination');

    $config['base_url'] = '#';
    $config["total_rows"] = $total_rows;
    $config["per_page"] = $rows_per_page;
    $config["uri_segment"] = 5;
    $config["use_page_numbers"] = TRUE;
    $config["full_tag_open"] = '<ul class="pagination justify-content-center">';
    $config["full_tag_close"] = '</ul>';
    $config["first_tag_open"] = '<li class="page-item">';
    $config["first_tag_close"] = '</li>';
    $config['next_link'] = 'Next';
    $config["next_tag_open"] = '<li class="page-item">';
    $config["next_tag_close"] = '</li>';
    $config["prev_link"] = "Previous";
    $config["prev_tag_open"] = "<li class='page-item'>";
    $config["prev_tag_close"] = "</li>";
    $config["cur_tag_open"] = "<li class='page-item active'><a href='#' class='page-link'>";
    $config["cur_tag_close"] = "</a></li>";
    $config["num_tag_open"] = "<li class='page-item'>";
    $config["num_tag_close"] = "</li>";
    $config["num_links"] = 2;
    $config['attributes'] = array('class' => 'page-link', 'id'=>'blogPagination');
    $this->pagination->initialize($config);

    return $this->pagination->create_links();
  }

  /**
   * Article
   */
  public function article()
  {
    $results = $this->article->get_article_by_url($this->uri->segment(2));
    $this->_data['result'] = $this->article->get_article_by_url($this->uri->segment(2));

    $this->layout->title = $results->title;
    $this->layout->description = $results->title;
    $this->layout->keywords = $results->tags;
    
    $this->layout->view('public/blog/article', $this->_data);
  }

  public function search()
  {
    $title = $this->input->get('search');

    $result = $this->article->search_article($title);

    $data[] = (array)$result;

    echo jason_encode($data);
  }
}
?>
