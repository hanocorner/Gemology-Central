<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Public Base Class
 */
class Base extends CI_Controller
{
  /**
   * Constructor (loading the important classes)
   */
  function __construct()
  {
    parent::__construct();

    $this->load->model('Article_model');

    $config = array('layoutManager'=>'public');
    $this->load->library('layout', $config);

    $this->load->helper('captcha');
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

    $this->layout->set_title('Gemology Central Laboratory');
    $this->layout->view('public/index', $data, 'public/layouts/public');
  }

  /*****/
  function about()
  {

    $recent = $this->Article_model->about_page_articles();
    $data['recent'] = (array)$recent;

    $this->layout->set_title('About Gemology Central Laboratory');
    $this->layout->view('public/about', $data, 'public/layouts/public');
  }

  /*****/
  public function report()
  {
    $data['captcha'] = $this->captcha();
    $data['name'] = $this->security->get_csrf_token_name();
    $data['hash'] = $this->security->get_csrf_hash();

    $this->layout->set_title('GRS Report Verfication');
    $this->layout->view('public/report/index', $data, 'public/layouts/public');
  }

  /****/
  public function report_verification()
  {
    $this->layout->set_title('GRS Report Verfication');
    $report_no = $this->input->post('repno');
    $result = $this->Article_model->get_report_data($report_no);

    if(is_null($result))
    {
      $this->layout->view('public/report/no_report', '', 'public/layouts/public');
      return false;
    }
    else
    {
      $data['data'] = $result;
      $this->layout->view('public/report/report_verified', $data, 'public/layouts/public');
    }
  }

  /****/
  public function captcha()
  {
    $vals = array(
        'word'          => 'World',
        'img_path'      => './assets/public/images/captcha/',
        'img_url'       =>  base_url().'/assets/public/images/captcha/',
        'font_path'     => './assets/public/fonts/times/TimesNewRomanPSMT.woff',
        'img_width'     => '150',
        'img_height'    => 30,
        'expiration'    => 7200,
        'word_length'   => 8,
        'font_size'     => 16,
        'img_id'        => 'Imageid',
        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

        // White background and border, black text and red grid
        'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
        )
    );

    $cap = create_captcha($vals);
    return $cap['image'];
  }

}
?>
