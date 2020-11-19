<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->helper("utility");
        $this->auth->logged();
    }

    //@desc     show dashboard
    //@route    GET admin/dashboard
	public function dashboard()
	{
        $this->load->view('admin/dashboard/dashboard');
    }
}
