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

    $this->load->model(array('Article_model','Base_model'));

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
  public function report($id = false)
  {
    $data['reportno'] = $this->uri->segment(2);
    $this->layout->set_title('GRS Report Verfication');
    $this->layout->add_include('assets/public/js/base.js');
    return $this->layout->view('public/report/index', $data, 'public/layouts/public');
  }

  public function report_data()
  {
    $id = $this->input->post('reportno');
    $id = urldecode($this->encrypt->decode($id));
    $data = $this->Base_model->get_labreport_by_id($id);
    echo json_encode($data);
  }

  /****/
  public function report_verification()
  {
    $data['captcha'] = $this->captcha();
    $this->layout->set_title('GRS Report Verfication');
    $this->layout->add_include('assets/public/js/base.js');
    return $this->layout->view('public/report/manuel_form', $data, 'public/layouts/public');
  }

  /*****/
  public function authenticating_report()
  {
    $repono = $this->input->post('repono');
    $weight = $this->input->post('weight');

    $this->form_validation->set_rules('repono','Report No.','trim|required|alpha_dash');
    $this->form_validation->set_rules('weight','Weight','trim|required');

    if ($this->form_validation->run() == FALSE) return $this->report_verification();

    if($this->Base_model->auth_report_data($repono, $weight))
    {
      $repono = urlencode($this->encrypt->encode($repono));
      redirect('report/'.$repono);
    }
    else
    {
      $this->set_flashdata('status', "Report you submit doesn't exist, Please recheck ");
      return $this->report_verification();
    }
  }

  /****/
  public function captcha()
  {
    $vals = array(
        'word'          => 'world',
        'img_path'      => './assets/public/images/captcha/',
        'img_url'       =>  base_url().'/assets/public/images/captcha/',
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
