<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	//	Home Page For The Store
	public function index() {
		$data['page_title'] = " All Products";
		$data['subcategories'] = $this->db->get('sub_category')->result();
		$this->load->view('layouts/general/head.php', $data);
		$this->load->view('layouts/general/nav.php', $data);
		$this->load->view("product/all", $data);
		$this->load->view('layouts/general/foot.php', $data);
	}

	public function search($key = '', $offset = 0) {

		$this->load->library('pagination');
		$this->load->config('pagination');
		$config = $this->config->item('pagination_config');
		$config['base_url'] = site_url('product/search/'.$key.'/');

		$data['page_title'] = " Search result for ".$key;
		$real_key = str_replace(['-', '_', '%20'], [' ', ' ', ' '], $key);

		$sql = "SELECT p.* FROM products p left join category c ON c.id = p.category_id WHERE (c.name LIKE '%$real_key%' OR  p.name LIKE '%$real_key%' OR tags LIKE '%$real_key%' OR brand LIKE '%$real_key%') AND status = 'approved'";
		
		
		// Pagination Configuration
		$totalRecord = $this->db->query($sql)->result_array();
		$config['total_rows'] = count($totalRecord);
		$config['per_page'] = 20;
		$this->pagination->initialize($config);
		
		$data['result_products'] = $this->db->query($sql." LIMIT ".(int)$offset.',20')->result_array();
		$data['key'] = $real_key;

		// Returned View	//
		$this->load->view('layouts/general/head.php', $data);
		$this->load->view("product/search", $data);
		$this->load->view('layouts/general/foot.php', $data);
	}

	public function this_product($code) {
		$name = ucfirst(str_replace(['_'], [' '], ($code)));
		$data['product'] = $this->db->where('name', $name)->get('products')->row_array();
		$uv = $this->ProductModel->updateProductViews($data['product']['code']);
		// var_dump($data['product'])
		$data['page_title'] = " | Product | ".$data['product']['name'];
		$data['otherproducts'] = $this->db->where(['category_id' => $data['product']['category_id'], 'code !='=>$data['product']['code']])->get('products')->result_array();

		// // $data['product'] = $products[$id];
		if(!$data['product']){
			redirect(site_url());
		}
		$this->load->view('layouts/general/head.php', $data);
		$this->load->view('product/this', $data);
		$this->load->view('layouts/general/foot.php', $data);
	}



	public function seller($param1 = 'all') {
		
		if($param1 === 'all'){
			$data['sellers'] = $this->db->join('users', 'users.user_id = sellers.seller_id')->get('sellers')->result();
			$data['page_title'] = " Sellers | All Sellers ";
			$this->load->view('layouts/general/head.php', $data);
			$this->load->view('layouts/general/nav.php', $data);
			$this->load->view('product/sellers', $data);
			$this->load->view('layouts/general/foot.php', $data);
		}

		if($param1 !== 'all'){

			$data['bseller'] = $this->db->where('company_name', ucfirst(str_replace('-', ' ', $param1)))->get('sellers')->row();
			$data['bseller_detail'] = $this->db->where('user_id', $data['bseller']->seller_id)->get('users')->row();
			$data['bseller_rating'] = $this->db->query("SELECT * FROM seller_rating WHERE seller_id = '".$data["bseller"]->seller_id."'")->result_array();
			$data['bavg_rating'] = $this->db->where('seller_id', $data["bseller"]->seller_id)->select('AVG(rate) as avg_rating')->from('seller_rating')->get()->row()->avg_rating;
			
			$data['bcontacts'] = $this->db->where('user_id', $data["bseller"]->seller_id)->get('contacts')->row();
			$data['bproducts'] = $this->db->where('owner_id', $data["bseller"]->seller_id)->get('products')->result_array(); 
			$data['bpage_title'] = " Sellers | ".$data['bseller']->company_name;
			
			
			$this->load->view('layouts/general/head.php', $data);
			$this->load->view('layouts/general/nav.php', $data);
			$this->load->view('product/thisseller', $data);
			$this->load->view('layouts/general/foot.php', $data);
		}
	}

	public function brand($param1 = null, $offset = 0) {
		$this->load->library('pagination');
		$this->load->config('pagination');
		$config = $this->config->item('pagination_config');
		$config['base_url'] = site_url('product/brand/'.$param1.'/');
		
		$data['page_title'] = "Product from ".ucwords($param1)." brand";
		$data['products'] = $this->db->where(['brand' => $param1, 'status' => 'approved'])->get('products', 20, $offset)->result();
		
		$data['key'] = $param1;

		// Pagination Configuration
		$totalRecord = $this->db->get_where('products', ['brand' => $param1, 'status' => 'approved'])->result_array();
		$config['total_rows'] = count($totalRecord);
		$this->pagination->initialize($config);


		
		$this->load->view('layouts/general/head.php', $data);
		$this->load->view("product/brand", $data);
		$this->load->view('layouts/general/foot.php', $data);
	}


	public function live_search($key = null) {
		$real_key = str_replace(['-', '_', '%20'], [' ', ' ', ' '], $key);
		$data['key'] = $real_key;
		if ($key == null || $key == '') {
			$data['products'] = array();
			$data['category'] = array();
		} else {
			$data['products'] = $this->db->query("SELECT * FROM products WHERE status = 'approved' AND (name LIKE '%$real_key%' OR tags LIKE '%$real_key%') LIMIT 10")->result_array();
			$data['category'] = $this->db->query("SELECT * FROM category WHERE (name LIKE '%$real_key%') LIMIT 10")->result_array();
			$data['brands'] = $this->db->query("SELECT * FROM brands WHERE (name LIKE '%$real_key%') LIMIT 10")->result_array();
		}
		$result = $this->load->view('layouts/general/search_result_display', $data, true);
		echo $result;
	}


	public function filter($limit = 20) {
		try {
			// $where = '';
			$filter_params = $this->input->get();
			$category_id = $filter_params['cat_id'];
			$prices = explode('-', str_replace(' ', '', $filter_params['min_price']));
			$brands = (isset($filter_params['brand_id'])) ? $this->my_implode(',', str_replace(' ', '', $filter_params['brand_id'])) : null;
			
			$min_price = (int) $prices[0];
			$max_price = (int) $prices[1];

			$category_where = ($category_id != 0 && $category_id != '') ? "AND (category_id = $category_id)" : '' ;
			$brand_where = ($brands != null) ? " AND brand in ($brands)" : '';

			$sql = "SELECT * FROM products WHERE price BETWEEN $min_price AND $max_price $category_where AND status = 'approved'$brand_where";
			$result = $this->db->query($sql);
			$data['products'] = $result->result();
			// var_dump($sql);
			echo $this->load->view('layouts/product/filter_result.php', $data, true);
		} catch (Exception $e) {
			// echo json_encode(['status' => 0, 'msg' => $e]);
			var_dump($e);
		}
	}

	public function my_implode($separator = ',', $array = null, $stringify = true) {
		$imploded = '';
		foreach ($array as $key => $value) {
			if ($stringify) {
				$imploded .= "'".$value."'".$separator;
			} else {
				$imploded .= "'".$value."'".$separator;
			}
		}
		return substr($imploded, 0, -1);
	}

}