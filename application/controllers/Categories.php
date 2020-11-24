<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Categories extends CI_Controller{
    public function index(){

      $data['page_title'] = "CMACHBET";
      $this->load->view('layouts/general/head.php',$data);
  		$this->load->view("Categories_view");
  		$this->load->view('layouts/general/foot.php');
    }
    public function product_details(){
      $data['page_title'] = "CMACHBET";
      $this->load->view('layouts/general/head.php',$data);
  		$this->load->view("Product_details_view");
  		$this->load->view('layouts/general/foot.php');
  }



  }

 ?>
