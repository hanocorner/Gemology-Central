<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends Admin_Controller
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

    $this->load->helper(array('html', 'cookie'));

    $this->load->model('admin/blog/Article_model');
   }

  /**
   * Default view for the user
   *
   * @return void
   */
  public function index()
  {
    $this->layout->title = 'Blog';
    $this->layout->assets('assets/admin/css/jquery.dataTables.min.css');
    $this->layout->assets('assets/admin/js/jquery.dataTables.min.js');
    $this->layout->assets('assets/admin/js/sweetalert.min.js');

    $this->layout->view('admin/blog/general');
  }

  /**
   * Render All articles to the user via xmlHTTPRequest
   *
   * @param none
   * @return void
   */
  public function all_articles()
  {
    $params = $_POST;

    $results = $this->Article_model->get_all_articles($params);

    $html = array();
    foreach ($results as $data)
    {
      $html[] = $data;
    }

    $totalRecords = $this->Article_model->count_all();

    $json_data = array(
      "draw"            => $params['draw'],
		  "recordsTotal"    => $totalRecords,
		  "recordsFiltered" => $totalRecords,
		  "data"            => $html
    );
    echo json_encode($json_data);
  }

  /**
   * User view for adding a new article
   *
   * @param none
   * @return void
   */
  public function add_article()
  {
    $this->layout->title = 'New Article';

    $this->layout->assets('assets/admin/css/froala/froala_editor.pkgd.min.css');
    $this->layout->assets('assets/admin/css/froala/froala_style.min.css');
    $this->layout->assets('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css', FALSE);
    $this->layout->assets('assets/admin/js/froala/froala_editor.pkgd.min.js');
    $this->layout->assets('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js', FALSE);
    $this->layout->assets('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js', FALSE);

    $this->layout->assets('assets/vendor/date/css/datetimepicker.min.css');
    $this->layout->assets('assets/vendor/date/js/datetimepicker.min.js');

    $this->layout->assets('assets/admin/js/sweetalert.min.js');
    $this->layout->assets('assets/admin/js/file-upload.js');

    $this->layout->view('admin/blog/new');
  }

  /**
   * Adding a new article to the database
   *
   * @param none
   * @return void
   */
  public function insert_article()
  {
    $url = '';
    $data = array(
      'post_body'=>$this->input->post('body'),
      'post_date'=>date('Y-m-d'),
      'post_author'=>$this->input->post('author'),
      'post_tag'=>$this->input->post('tag')
    );

    $postTitle = $this->input->post('title');
    $published = $this->input->post('published');
    $url = $this->set_url($this->input->post('url'));
    $topArticle = $this->input->post('topArticle');

    $this->form_validation->set_rules('title','Title','required');
    $this->form_validation->set_rules('author','Author','required');
    $this->form_validation->set_rules('body','Body','required');
    $this->form_validation->set_rules('seokeys','Keywords','required');
    $this->form_validation->set_rules('seodescription','Description','required');

    if($this->form_validation->run()==FALSE)
    {
      $this->session->set_flashdata('error','One or more input fields are empty Please check...');
      $this->add_article();
      return false;
    }
    else
    {
      if($published == 1)
      {
        $data['post_publish_date'] = date('Y-m-d H:i:s');
      }

      if($published == 0)
      {
        $data['post_publish_date'] = $this->input->post('toBePublished');
      }

      $dburl = $this->Article_model->check_url($url);
      if($dburl != FALSE)
      {
        $number = rand(10,100);
        $dburl = $dburl."-".$number;
      }
      else
      {
        $dburl = $url;
      }

      if ($topArticle == 0)
      {
        $data['post_topArticle'] = 0;
      }

      $data['post_title'] = $postTitle;
      $data['post_published'] = $published;
      $data['post_url'] = $dburl;

      $filename = $_FILES['image']['name'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $newname = "gcl"."-".$dburl.".".$ext;
      $data['post_image'] = $newname;

      $postID = $this->Article_model->insert('tbl_posts', $data);

      if($postID<>0)
      {
        $this->upload_image($newname);
        $this->insert_meta_data($postID);

        if ($topArticle == 1)
        {
          $this->Article_model->set_topArticle($postID);
        }

        $this->session->set_flashdata('success','Your article was successfully added');
      }
      else
      {
        $this->session->set_flashdata('error','Problem when adding your article');
      }
    }
    redirect('admin/blog/add-article');
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
    $url = $this->uri->segment(4);
    if (!isset($url)) redirect('admin/blog');

    $result = $this->Article_model->get_article($url);

    $data = array(
      "title"=>$result->post_title,
      "url"=>$result->post_url,
      "body"=>$result->post_body,
      "image"=>$result->post_image,
      "author"=>$result->post_author,
      "tag"=>$result->post_tag,
      "publishedDate"=>$result->post_published,
      "toparticle"=>$result->post_topArticle,
      "keywords"=>$result->meta_keywords,
      "description"=>$result->meta_description
    );

    $this->layout->title ='Edit Article';

    $this->layout->assets('assets/admin/css/froala/froala_editor.pkgd.min.css');
    $this->layout->assets('assets/admin/css/froala/froala_style.min.css');
    $this->layout->assets('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css', FALSE);
    $this->layout->assets('assets/admin/js/froala/froala_editor.pkgd.min.js');
    $this->layout->assets('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js', FALSE);
    $this->layout->assets('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js', FALSE);

    $this->layout->assets('assets/vendor/date/css/datetimepicker.min.css');
    $this->layout->assets('assets/vendor/date/js/datetimepicker.min.js');

    $this->layout->assets('assets/admin/js/sweetalert.min.js');
    $this->layout->assets('assets/admin/js/file-upload.js');

    $this->layout->view('admin/blog/edit', $data);
  }

  /**
   * Updating post data in DB
   *
   * @param none
   * @return void
   */
  public function update_article()
  {
    $url = '';
    $data = array(
      'post_title'=>$this->input->post('title'),
      'post_body'=>$this->input->post('body'),
      'post_date'=>date('Y-m-d'),
      'post_author'=>$this->input->post('author'),
      'post_tag'=>$this->input->post('tag'),
      'post_topArticle'=>$this->input->post('topArticle'),
      'post_modified_date'=>date('Y-m-d h:i:s')
    );

    $published = $this->input->post('published');
    $url = $this->input->post('blog-url');

    $this->form_validation->set_rules('title','Title','required');
    $this->form_validation->set_rules('author','Author','required');
    $this->form_validation->set_rules('body','Body','required');
    $this->form_validation->set_rules('seokeys','Keywords','required');
    $this->form_validation->set_rules('seodescription','Description','required');

    if($this->form_validation->run()==FALSE)
    {
      $this->session->set_flashdata('error','One or more input fields are empty Please check...');
      $this->add_article();
      return false;
    }
    else
    {
      if($published == 1)
      {
        $data['post_publish_date'] = date('Y-m-d H:i:s');
      }

      if($published == 0)
      {
        $data['post_publish_date'] = $this->input->post('toBePublished');
      }

      $data['post_published'] = $published;

      if(!empty($_FILES['image']['name']))
      {
        $filename = $_FILES['image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newname = "gcl"."-".$url."-".rand(10, 100).".".$ext;
        $data['post_image'] = $newname;
        $this->upload_image($newname);
      }

      $this->Article_model->update_batch($data, $url);

      $id = $this->Article_model->get_id($url);

      $metaData = array(
        "meta_keywords"=>$this->input->post('seokeys'),
        "meta_description"=>$this->input->post('seodescription')
      );
      $bool = $this->Article_model->update('tbl_postMetaData','post_id', $id, $metaData);

      if($bool)
      {
        $this->session->set_flashdata('success','Your have successfully updated the article');
      }
      else
      {
        $this->session->set_flashdata('error','Problem when updating your article');
      }
    }
    redirect('admin/blog/edit/'.$url);
  }

  /*****/
  public function upload_image($imgName)
  {
    $config['file_name'] = $imgName;
    $config['upload_path'] ='./assets/public/images/blog/';
    $config['allowed_types'] ='gif|jpg|png';
    $config['max_size'] ='200000';
    $config['max_width'] ='1024';
    $config['max_height'] ='1024';

    $this->load->library('upload', $config);
    $this->upload->do_upload('image');
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
