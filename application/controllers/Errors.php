<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {


    public function __construct(){
        parent::__construct();
    }


    public function index(){
		
				$this->load->view('layouts/general/head.php');
				$this->load->view('layouts/general/error');
				$this->load->view('layouts/general/foot.php');
			}
}
