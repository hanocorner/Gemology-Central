<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Image extends Admin_Controller 
{
    /**
     * Directory path string 
     * 
     * @var string
     */
    private $_dir_path = '';

    /**
     * Parent directory
     * 
     * @var string
     */
    private $_parent_dir = 'images/gem';

    /**
     * Child directory
     * 
     * @var string
     */
    private $_child_dir = '';

    /**
     * Image name (includes ame & extension)
     * 
     * @var string
     */
    private $_image_name = '';

    /**
     * Validation check
     * 
     * @var bool
     */
    private $_validation = null;

    /**
     * Message to display 
     * 
     * @var string
     */
    public $_message = '';
    
    /**
     * Class init
     * 
     * @return void
     */
	public function  __construct()
	{
        parent::__construct();

        $this->load->library('image_lib');

        $this->_child_dir = date('Y').'/'.date('m').'/';
        $this->_dir_path = $this->_parent_dir.'/'.$this->_child_dir;
    }

    /** */
    public function index()
    {
        if (!$this->session->has_userdata('logged_in') && $this->session->logged_in != true) 
        { 
            return $this->jason_output(true, 'Session expired', 'admin');
        }

        $image = $_FILES;

        $this->rename($image['file']['name']);

        if(!file_exists($this->_dir_path)) mkdir($this->_dir_path, 0777, true);

        $upload = $this->upload_image('file');

        $this->output->set_content_type('application/json', 'utf-8');

        if($this->_validation == false) 
        {
            return $this->output->set_output(json_encode(array('message'=>$this->_message, 'status'=>FALSE)));
        }
        else {
            return $this->output->set_output(json_encode(array('image_path'=>$this->_child_dir, 'image_name'=>$this->_image_name, 'status'=>TRUE)));
        }
        
    }

    /** */
    public function rename($image_name)
    {
        $this->load->helper('string');
        $new_name = 'gcl_'.random_string('alnum', 8);

        $extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $this->_image_name = $new_name.".".$extension;
    }

    /*** */
    public function upload_image($field)
    {
        $config = array();

        $config['file_name'] = $this->_image_name;
        $config['upload_path'] = $this->_dir_path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2097152;
        $config['max_width'] = 0;
        $config['max_height'] = 0;

        $this->load->library('upload', $config);
        if($this->upload->do_upload($field))
        {
            $this->resize_image();
            return $this->_validation = true;
        }
        $this->_validation = false;
        $this->_message = $this->upload->display_errors();
        return FALSE;
    }
    
    /** */
    public function resize_image()
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $this->_dir_path.$this->_image_name;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = 200;
        $config['height'] = 150;
        
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }

    
}
?>