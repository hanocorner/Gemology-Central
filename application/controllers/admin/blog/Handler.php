<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Handler extends Admin_Controller
{
  /*****/
  public $submitted;

  /**
   * Constructor (loading the important class)
   */
  public function __construct()
  {
    parent::__construct();
    $this->check_login_status();

    $this->load->helper('html');

    $this->load->model('admin/blog/Article_model', 'article');
   }

  /**
   * Default view for the user
   *
   * @return void
   */
  public function index()
  {
    $this->layout->title = 'Blog';
    $this->layout->assets(base_url('assets/admin/js/blog_table.js'), 'footer');
    $this->layout->view('admin/blog/index');
  }

  /**
   * Render All articles to the user via xmlHTTPRequest
   *
   * @param none
   * @return void
   */
  public function all()
  {
    $page = $this->input->get('page');
    $rows_per_page = $this->input->get('rows');

    if ($page == 0) $page = 1;
    $start = ($page - 1) * $rows_per_page;

    if($this->input->get('search') == true)
    {
      $this->_data['results'] = $this->article->search_admin($this->input->get('q'));
    }
    else {
      $this->_data['results'] = $this->article->get_all_articles_for_admin($rows_per_page, $start);
      
    }
    $this->_data['links'] = $this->html_pagination($page, $rows_per_page, $this->article->_result_count);
    $this->load->view('admin/blog/table', $this->_data);
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
    $config["uri_segment"] = 6;
    $config["use_page_numbers"] = TRUE;
    $config["full_tag_open"] = '<ul class="pagination justify-content-end">';
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

  /** */
  public function add()
  {
    $this->layout->title = 'Add Post';
    
    $this->layout->assets('assets/vendors/quill/quill.snow.css');

    $this->layout->assets('assets/vendors/formstone/css/upload.css');
    $this->layout->assets('assets/vendors/formstone/css/theme/upload.css');
    
    $this->layout->assets(base_url('assets/vendors/quill/quill.min.js'), 'footer');
    
    $this->layout->assets(base_url('assets/vendors/formstone/js/core.js'), 'footer');
    $this->layout->assets(base_url('assets/vendors/formstone/js/upload.js'), 'footer');
    $this->layout->assets(base_url('assets/admin/js/blog.js'), 'footer');
    $this->layout->assets('https://unpkg.com/popper.js', 'header');
    
    $this->layout->view('admin/blog/new');
  }

  /**
   * Adding a new article to the database
   *
   * @param none
   * @return void
   */
  public function add_article()
  {
    if (!$this->session->has_userdata('logged_in') && $this->session->logged_in != true)
    {
      return $this->jason_output(true, 'Session expired', 'admin');
    }

    if($this->form_validation->run('posts') == FALSE) return $this->json_output(false, validation_errors());
    
    $this->_data = $this->input->post();
    $this->_data['status'] = (bool) $this->input->post('status');
    $this->_data['url'] = $this->set_url($this->input->post('title'));

    $result = $this->article->insert($this->_data);

    if($result == FALSE)
    {
      return $this->json_output(false, 'Insertion unsuccessful');
    }

    return $this->json_output(true, 'Post saved successfully', 'admin/blog/all'); 

  }

  /**
   * Adding Meta data of posts
   *
   * @param none
   * @return void
   */
  public function insert_meta_data($post_id)
  {
    $data['post_id'] = $post_id;
    $data['meta_keywords'] = $this->input->post('seokeys');
    $data['meta_description'] = $this->input->post('seodescription');
    $this->Article_model->insert('tbl_postMetaData', $data);
  }

  /**
   * Delete a specific post, handled by xmlHTTPRequest
   *
   * @param none
   * @return void
   */
  public function delete($id)
  {
    if($this->Article_model->del('postid',$id))
    {
    $this->session->set_flashdata('success','Your article was successfully deleted');
    }
    else
    {
      $this->session->set_flashdata('error','Problem When deleting your article');
    }
    redirect('admin/blog');
  }

  /**
   * User view to edit post data
   *
   * @param none
   * @return void
   */
  public function edit()
  {
    $id = $this->uri->segment(4);
    if (!isset($id)) redirect('admin/blog');

    $this->_data['result'] = $this->article->get_article($id);

    $this->layout->title = 'Edit Post';
    
    $this->layout->assets('assets/vendors/quill/quill.snow.css');

    $this->layout->assets('assets/vendors/formstone/css/upload.css');
    $this->layout->assets('assets/vendors/formstone/css/theme/upload.css');
    
    $this->layout->assets(base_url('assets/vendors/quill/quill.min.js'), 'footer');
    
    $this->layout->assets(base_url('assets/vendors/formstone/js/core.js'), 'footer');
    $this->layout->assets(base_url('assets/vendors/formstone/js/upload.js'), 'footer');
    $this->layout->assets(base_url('assets/admin/js/blog.js'), 'footer');
    $this->layout->assets('https://unpkg.com/popper.js', 'header');

    $this->layout->view('admin/blog/edit', $this->_data);
  }

  /**
   * Updating post data in DB
   *
   * @param none
   * @return void
   */
  public function update_article()
  {
    if (!$this->session->has_userdata('logged_in') && $this->session->logged_in != true)
    {
      return $this->jason_output(true, 'Session expired', 'admin');
    }

    if($this->form_validation->run('posts') == FALSE) return $this->json_output(false, validation_errors());

    $this->_data = $this->input->post();
    $this->_data['id'] = (int) $this->input->post('id');
    $this->_data['status'] = (bool) $this->input->post('status');
    $this->_data['url'] = $this->set_url($this->input->post('title'));

    $result = $this->article->update($this->_data);

    if($result == FALSE)
    {
      return $this->json_output(false, 'Updation unsuccessful');
    }

    return $this->json_output(true, 'Post updated successfully', 'admin/blog/all'); 
  }

  /**
   * Setting post url for public access
   *
   * @param $url user input url
   * @return setted url
   */
  public function set_url($url)
  {
    // replace non letter or digits by -
    $url = preg_replace('~[^\pL\d]+~u', '-', $url);

    // transliterate
    $url = iconv('utf-8', 'us-ascii//TRANSLIT', $url);

    // remove unwanted characters
    $url = preg_replace('~[^-\w]+~', '', $url);

    // trim
    $url = trim($url, '-');

    // remove duplicate -
    $url = preg_replace('~-+~', '-', $url);

    // lowercase
    $url = strtolower($url);

    if (empty($url)) return 'n-a';

    return $url;
  }

}
?>
