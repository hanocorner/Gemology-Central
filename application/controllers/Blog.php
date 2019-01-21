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

    $this->load->model('Article_model');
  }

  /**
   * Base view for the blog
   */
  public function index()
  {
    $result = $this->Article_model->get_topArticle();

    $array = (array)$result;

    if (empty($array)) redirect('blog');

    $data['title'] = $result->post_title;
    $data['body'] = $result->post_body;
    $data['url'] = $result->post_url;
    $data['image'] = $result->post_image;

    $recent = $this->Article_model->get_recent_articles();

    $data['recent'] = (array)$recent;

    $this->layout->title = 'Blog GCL';
    $this->layout->view('public/blog', $data);// ?? not finished
  }

  /**
   * Article
   */
  public function article($title = false)
  {
    if (is_null($title)) redirect('blog');

    if (!empty($this->uri->segment(2)))
    {
      $url = $this->uri->segment(2);
    }
    else {
      redirect('blog');
    }

    $result = $this->Article_model->get_article($url);

    $array = (array)$result;

    if (!is_object($result) || empty($array)) redirect('blog');

    $date = $result->post_date;
    $date = date("F jS, Y", strtotime($date));

    $data['title'] = $result->post_title;
    $data['body'] = $result->post_body;
    $data['date'] = $date;
    $data['tag'] = $result->post_tag;
    $data['author'] = $result->post_author;
    $data['url'] = $result->post_url;
    $data['image'] = $result->post_image;

    $relArticles = $this->Article_model->get_related_articles($result->post_tag);
    $data['related'] = $relArticles;

    $this->layout->title = ucwords($result->post_title) ;
    $this->layout->view('public/article', $data);
  }

  public function search()
  {
    $title = $this->input->get('search');

    $result = $this->Article_model->search_article($title);

    $data[] = (array)$result;

    echo jason_encode($data);
  }
}
?>
