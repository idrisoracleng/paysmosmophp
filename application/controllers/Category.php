<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {


    public function __construct(){
        parent::__construct();
    }


    public function index($cat_name = "all", $limit = 0){
		$this->load->library('pagination');
		$this->load->config('pagination');
		$config = $this->config->item('pagination_config');
		$config['base_url'] = site_url('product/category/'.$cat_name.'/');

		if ($cat_name == 'all') {
			$data['categories'] = $this->db->get('category')->result();
			$data['products'] = $this->db->where(['status' => 'approved'])->get('products', 20, $limit)->result();
			// Pagination configuration
			$totalRecord = $this->db->where(['status' => 'approved'])->get('products')->result();
			$config['total_rows'] = count($totalRecord);
			$this->pagination->initialize($config);
			$data['cat_name'] = "all";
			$data['cat_id'] =0;
			$data['limit'] = $limit;
			$data['page_title'] = ' '.str_replace(['_', '-'], [' ', ' '], $cat_name).' Category';
			$this->load->view('layouts/general/head.php', $data);
			$this->load->view('product/category', $data);
			$this->load->view('layouts/general/foot.php', $data);
		} else if ($cat_name == 'top_collections') {
			
			$data['categories'] = $this->db->get('category')->result();
			$data['products'] = $this->db->query("SELECT * FROM products WHERE status = 'approved' AND views > 10 LIMIT 20")->result();
			$totalRecord = $this->db->query("SELECT * FROM products WHERE status = 'approved' AND views > 10")->result();
			$config['total_rows'] = count($totalRecord);
			$this->pagination->initialize($config);
			$data['page_title'] = ' '.str_replace(['_', '-'], [' ', ' '], $cat_name).' Category';
			$data['cat_name'] = "top_collections";
			$data['cat_id'] =0;							 
			$this->load->view('layouts/general/head.php', $data);
			$this->load->view('product/category', $data);
			$this->load->view('layouts/general/foot.php', $data);
		} else {
			$categoryName = str_replace(['-','_'], [' ', ' '], $cat_name);
			$categoryData = $this->db->get_where('category', ['name' => $categoryName])->row();
			if ( !$categoryData ) {
				redirect(site_url('category/index/all'));
			} else {
				$data['categories'] = $this->db->get_where('category', ['parent_id' => $categoryData->id])->result();
				$data['products'] = $this->db->where(['status' => 'approved', 'category_id' => $categoryData->id])->get('products', 20, $limit)->result();
				$totalRecord = $this->db->get_where('products', ['status' => 'approved', 'category_id' => $categoryData->id])->result();
				$data['limit'] = $limit;
				$data['page_title'] = ' '.$categoryData->name.' Category';
				$data['cat_name'] = $categoryData->name;
				$data['cat_id'] = $categoryData->id;							
				$config['total_rows'] = count($totalRecord);

				$this->pagination->initialize($config);
				$this->load->view('layouts/general/head.php', $data);
				$this->load->view('product/category', $data);
				//$this->load->view('layouts/product/filter_view', $data);
				$this->load->view('layouts/general/foot.php', $data);
			}
		}
		
    }
}
