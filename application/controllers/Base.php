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

    $data['title'] = $result->title;
    $data['body'] = $result->body;
    $data['url'] = $result->url;
    $data['image'] = $result->gemstone;
    $data['path'] = $result->path;

    $this->layout->title = 'Gemology Central Laboratory';
    $this->layout->view('public/index', $data);
  }

  /*****/
  function about()
  {

    $this->layout->title = 'About Gemology Central Laboratory';
    $this->layout->view('public/about');
  }



}
?>
