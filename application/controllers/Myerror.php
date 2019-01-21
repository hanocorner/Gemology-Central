<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Myerror extends Admin_Controller 
{
    /*** */
	public function  __construct()
	{
		parent::__construct();
    }
    
    /*** */
	public function index()
	{	
		$this->layout->title = 'Page Not Found';
		$this->layout->view('layouts/error_404', '', 'without');
	}
}
