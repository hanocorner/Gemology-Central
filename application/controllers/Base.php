<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Public Base Class
 */
class Base extends Public_Controller
{
  /**
   * Constructor (loading the important classes)
   */
  function __construct()
  {
    parent::__construct();

    $this->load->model(array('admin/blog/Article_model','Base_model'));

    $config = array('layoutManager'=>'public');
    $this->load->library('layout', $config);
    $this->load->library(array('session', 'encrypt'));

    $this->load->helper(array('captcha', 'url', 'form'));
  }

  /**
   * Default Index
   *
   */
  public function index()
  {
    $result = $this->Article_model->get_topArticle();

    $array = (array)$result;

    //if (empty($array)) redirect('blog');

    $data['title'] = $result->post_title;
    $data['body'] = $result->post_body;
    $data['url'] = $result->post_url;
    $data['image'] = $result->post_image;

    $this->layout->title = 'Gemology Central Laboratory';
    $this->layout->view('public/index', $data);
  }

  /*****/
  function about()
  {

    $recent = $this->Article_model->about_page_articles();
    $data['recent'] = (array)$recent;

    $this->layout->title = 'About Gemology Central Laboratory';
    $this->layout->view('public/about', $data);
  }



}
?>
