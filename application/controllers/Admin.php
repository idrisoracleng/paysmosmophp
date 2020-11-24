<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(E_ALL);

class Admin extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        // date_time_zone
        date_default_timezone_set("Africa/Lagos");
        // if (!$this->isOnline()) {
        /*if (!$this->session->userdata('user')) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
         }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));*/

        $this->load->model('Product_batch_model');
        $this->load->library('Csvimport'); //newly addedmode
        $this->load->model('CooperativeModel', 'cooperativeModel');
    }


    public function clean($string)
    {
        // $str = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string);
        $str = preg_replace('/\s+/', ' ', $string);
        return $str; // Removes special chars.
    }



    /* 
! Started Here Paysmosmo import Copy out the Constructor part on this page too also the Library

*/

    public function upload_product()
    {
        if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                if ($this->input->is_ajax_request()) {
                    echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                    exit();
                } else {
                    redirect(site_url('/admin/login'));
                }
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type' => 'admin', 'active' => 1])->result();
        $data['page_title'] = " | Admin | Home";
        $data['scripts'] = ['main.js'];
        $this->load->view('layouts/admin/head', $data);
        //$this->load->view('layouts/admin/top_nav', $data);
        $this->load->view('admin/paysmosmo_view', $data);
        $this->load->view('layouts/admin/foot', $data);
    }

    /*public function pay_import()
    {

        $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);

        $category_id = 0;

        foreach ($file_data as $row) {

            $categoryId = $row['Category'];
            $sql = "SELECT id FROM category WHERE name = '$categoryId'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $category_id = $query->row()->id;
            } else {
                $sql1 = "INSERT INTO category (`id`,`name`,`parent_id`,`description`) VALUES(NULL,'" . $categoryId . "',0,'" . $categoryId . "')";
                $query1 = $this->db->query($sql1);
                $category_id = $this->db->insert_id();
            }

            $uploaded_image = FCPATH . 'upload/' . $row["Product ID"] . '.jpg';
            $imagedir = FCPATH . 'public/images/products/';
            $product_image_dir = $imagedir . $row["Product ID"];
            // echo $product_image_dir;
            if (file_exists($uploaded_image)) {
                $data[] = array(
                    'owner_id' => $this->session->userdata('user')->user_id,
                    'product_id'   => $row["Product ID"],
                    'category_id'  =>  $category_id,
                    //'code'   => random_string('numeric', 7),
                    'code'   => $row["Product ID"],
                    'name'   => $this->clean($row["Product Name"]),
                    'description'   => $row["Description"],
                    'price'   => $row["Price"],
                    'discount_price'   => $row["Discount Price"],
                    'quantity'   => $row["Quantity"],
                    'return_policy'   => $row["Return Policy"],
                    'supplier_sku'   => $row["Supplier Sku"],
                    'model'   => $row["Model"],
                    'product_condition'   => $row["Product Condition"],
                    'seo_key'   => $row["Tags"],
                    'short_description'   => $row["Description"],
                    'brand'   => $row["Brand"],
                    'size_category'   => $row["Shipping Category"],
                    'featured'   => 1,
                    'status'   => "approved",
                    'tags'   => $row["Tags"],
                    'created_at' => date('Y-m-d H:i:s')

                );
                //insert images



                if (!file_exists($product_image_dir)) {
                    //mkdir();
                    if (!@mkdir($product_image_dir)) {
                        $error = error_get_last();
                        echo $error['message'];
                    }
                    echo $uploaded_image . '  ' . $product_image_dir . '/01.jpg';
                }


                copy($uploaded_image, $product_image_dir . '/01.jpg');

                if (file_exists(FCPATH . 'upload/' . $row["Product ID"] . 'b.jpg')) copy(FCPATH . 'upload/' . $row["Product ID"] . 'b.jpg', $product_image_dir . '/02.jpg');
                if (file_exists(FCPATH . 'upload/' . $row["Product ID"] . 'c.jpg')) copy(FCPATH . 'upload/' . $row["Product ID"] . 'c.jpg', $product_image_dir . '/03.jpg');
            }
        }

        $this->Product_batch_model->batch_insert($data);
    }

*/

    
	
	
	 public function pay_import()
    {
        // var_dump($_FILES);
        // exit();
        $this->load->library('excel'); //load library
        $this->load->library('upload'); //load library
        $this->load->library('excel_reader');

        $product_image_dir = '';
        $uploaded_image = '';

        if ($_FILES['csv_file']) {
            $path = APPPATH.'../uploads/';

            $config['upload_path'] = $path;
            // $config['allowed_types'] = 'xlsx|xls|jpg|png';
            $config['allowed_types'] = '*';
            $config['remove_spaces'] = TRUE;
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('csv_file')) {
                $error = array('error' => $this->upload->display_errors());
                // var_dump($error);
            } else {
                $data = array('upload_data' => $this->upload->data());
                // var_dump($data);
            }
            // Load the spreadsheet reader library

            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            try {
                chmod($inputFileName, 777);
                $this->excel_reader->read($inputFileName);
                // Get the contents of the first worksheet
                $worksheet = $this->excel_reader->sheets[0];

                $numRows = $worksheet['numRows']; // ex: 14
                $numCols = $worksheet['numCols']; // ex: 4
                $cells = $worksheet['cells'];

                // var_dump($numRows);
                // var_dump($numCols);
                // print_r($cells[1]);
                unset($cells[1]);
                foreach ($cells as $key => $cell) {
                    $product['brand'] = isset($cell[1]) ? $cell[1] : '';
                    $product['brand'] = isset($cell[2]) ? $cell[2] : '';
                    $product['category_id'] = isset($cell[3]) ? $cell[3] : '';
                    $product['model'] = isset($cell[5]) ? $cell[5] : '';
                    $product['short_description'] = isset($cell[6]) ? $cell[6] : '';
                    $product['description'] = isset($cell[7]) ? $cell[7] : '';
                    $product['product_id'] = isset($cell[8]) ? $cell[8] : '';
                    $product['price'] = isset($cell[9]) ? $cell[9] : '';
                    $product['discount_price'] = isset($cell[10]) ? $cell[10] : '';
                    $product['size_category'] = isset($cell[11]) ? $cell[11] : '';
                    $product['tags'] = isset($cell[12]) ? $cell[12] : '';
                    $product['name'] = isset($cell[13]) ? $cell[13] : '';
                    $product['quantity'] = isset($cell[14]) ? $cell[14] : '';
                    $product['return_policy'] = isset($cell[15]) ? $cell[15] : '';
                    $product['product_condition'] = isset($cell[17]) ? $cell[17] : '';
                    $product['code'] = isset($cell[8]) ? $cell[8] : '';
                    $product['seo_key'] = isset($cell[12]) ? $cell[12] : '';
                    $product['owner_id'] = $this->session->userdata('user')->user_id;
                    // echo $key .' => ';
                    // echo "<pre>";
                    // print_r($product);
                    // echo "</pre>";
                    // echo "<br/>";
                    $catName = $product['category_id'];
                    $sql = "SELECT id FROM category WHERE name = '".$catName."'";
                    $query = $this->db->query($sql);
                    $category_id = 0;
                    if ($query->num_rows() > 0) {
                        $category_id = $query->row()->id;
                    } else {
                        $sql1 = "INSERT INTO category (`id`,`name`,`parent_id`,`description`) VALUES(NULL,'" . $catName . "',0,'" . $category_id . "')";
                        $query1 = $this->db->query($sql1);
                        $category_id = $this->db->insert_id();
                    }
                    $product['category_id'] = $category_id;
					
					$uploaded_image = FCPATH . 'upload/' . $product['product_id'] . '.jpg';
					$imagedir = FCPATH . 'public/images/products/';
					$product_image_dir = $imagedir . $product['product_id'];
					
                    if ($this->db->get_where('products', ['product_id' => $product['product_id']])->row_array()) {
                        $this->db->where(['product_id' => $product['product_id']])->update('products', $product);
                    } else {
						  if (file_exists($uploaded_image)) {
							 
							  
							  if (!file_exists($product_image_dir)) {
								//mkdir();
									if (!@mkdir($product_image_dir)) {
										$error = error_get_last();
										echo $error['message'];
									}
									echo $uploaded_image . '  ' . $product_image_dir . '/01.jpg';
								}


								copy($uploaded_image, $product_image_dir . '/01.jpg');

								if (file_exists(FCPATH . 'upload/' . $product['product_id'] . 'b.jpg')) copy(FCPATH . 'upload/' . $product['product_id'] . 'b.jpg', $product_image_dir . '/02.jpg');
								if (file_exists(FCPATH . 'upload/' . $product['product_id'] . 'c.jpg')) copy(FCPATH . 'upload/' . $product['product_id'] . 'c.jpg', $product_image_dir . '/03.jpg');
								 $this->db->insert('products', $product);		  
						 }
                    }
                }
                echo "Product Uploaded";
                sleep(10);
                redirect('admin/product/all');
                // exit();

            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
            }

            // if (empty($data)) {
            //     $flag = 1;
            // }
            // if ($flag == 1) {
            //     // for ($i = 2; $i <= $arrayCount; $i++) {

            //     //     if (!file_exists($product_image_dir)) {
            //     //         if (!@mkdir($product_image_dir)) {
            //     //             $error = error_get_last();
            //     //             echo $error['message'];
            //     //         }
            //     //         echo $uploaded_image . '  ' . $product_image_dir . '/01.jpg';
            //     //     }
            //     //     copy($uploaded_image, $product_image_dir . '/01.jpg');
    
            //     //     if (file_exists(FCPATH . 'upload/' . $product_id . 'b.jpg')) copy(FCPATH . 'upload/' . $product_id . 'b.jpg', $product_image_dir . '/02.jpg');
            //     //     if (file_exists(FCPATH . 'upload/' . $product_id . 'c.jpg')) copy(FCPATH . 'upload/' . $product_id . 'c.jpg', $product_image_dir . '/03.jpg');

            //     //     $id_product = $product_id;
            //     //     $sqlCheck = "SELECT product_id FROM products WHERE product_id ='$id_product'";
            //     //     $queryCheck = $this->db->query($sqlCheck);

            //     //     if ($queryCheck->num_rows() > 0) {
            //     //         $this->import->update_product($id_product, $data);
            //     //     } else {
            //     //         $this->db->insert('products', $fetchData);
            //     //         // $this->import->setBatchImport($fetchData);
            //     //         // $this->import->importData();
            //     //     }
            //     // }
                
            // } else {
            //     echo "Please import correct file";
            // }
        } else {
            echo "Nothing was sent";
        }
    }

/* 
! Started Here Paysmosmo import

*/
	public function upload_image() {
		$path = $_FILES['product_image']['tmp_name'];  
		$zip = new ZipArchive;
		if ($zip->open($path) === true) {
			for($i = 0; $i < $zip->numFiles; $i++) {
				$filename = $zip->getNameIndex($i);
				$fileinfo = pathinfo($filename);
				copy("zip://".$path."#".$filename, FCPATH . "uploads/".$fileinfo['basename']);
			}                  
			$zip->close();                  
		}
	  }





    public function isOnline()
    {
        if (!$this->session->userdata('user')) return false;
        else return true;
    }

    public function index()
    {
        $this->home();
    }

    public function home()
    {
        if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));
        // var_dump($this->session->userdata('user'));
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type' => 'admin', 'active' => 1])->result();
        $data['page_title'] = " | Admin | Home";
        $data['scripts'] = ['main.js'];
        $this->load->view('layouts/admin/head', $data);
        $this->load->view('layouts/admin/top_nav', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('layouts/admin/foot', $data);
    }

    public function login()
    {
        if ($this->input->post()) {
            // echo json_encode($this->input->post());
            $email = $this->input->post('email', TRUE);
            $pass = $this->input->post('password', TRUE);
            $acct_type = $this->input->post('acct_type', TRUE);
            $logInInfo = $this->db->get_where('admins', ['email' => $email, 'acct_type' => 'admin'])->row();
            if ($logInInfo && password_verify($pass, $logInInfo->password)) {
                $userData = $this->db->get_where('users', ['user_id' => $logInInfo->user_id])->row();
                if ($userData->step == 1) {
                    echo json_encode(['status' => 0, 'msg' => 'Your account is awaiting your cooperative admin approval', 'redirect' => 'noreload']);
                }
                if ($userData->step == 2) {
                    echo json_encode(['status' => 0, 'msg' => 'Your account is awaiting final approval from the Admin', 'redirect' => 'noreload']);
                }
                if ($userData->step == 0) {
                    $this->session->set_userdata('user', $userData);
                    $this->session->userdata('user')->loggedinas = $logInInfo->acct_type;
                    $url = ($this->session->tempdata('rfrom')) ? $this->session->tempdata('rfrom') : site_url('/' . $this->session->userdata('user')->loggedinas . '/index');
                    if ($this->session->tempdata('rfrom')) {
                        $this->session->unset_tempdata('rfrom');
                    }
                    echo json_encode(['status' => 1, 'msg' => 'Login Successful', 'redirect' => $url]);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Login Credentials is Invalid. Please Check your email and password', 'redirect' => 'noreload']);
            }
        } else {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Login";
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/login', $data);
            $this->load->view('layouts/admin/foot', $data);
            // session_destroy();
        }
    }

    public function admins($param1 = 'all', $param2 = null, $param3 = null)
    {
        if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type' => 'admin', 'active' => 1])->result();
        $data['scripts'] = ['main.js', 'forms.js'];
        if ($param1 == 'all' && $param2 == null) {
            $data['admins'] = $this->db->get_where('admins', ['acct_type' => 'admin'])->result();
            $data['page_title'] = " | Admin | Admin List";
            // var_dump($data['admins']);
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/admin/admin_list', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'create' && $param2 == null) {
            $data['page_title'] = " | Admin | Admin | Create";
            // var_dump($data['admins']);
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/admin/add_admin', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'edit' && $param2 != null) {
            $data['page_title'] = " | Admin | Admin | Edit";
            // var_dump($data['admins']);
            $data['adminData'] = $this->db->get_where('admins', ['id' => $param2])->row();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/admin/edit_admin', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'update' && $param2 == null) {
            $adminData = $this->input->post();
            if ($adminData['password'] == '') {
                unset($adminData['password']);
            } else {
                $adminData['password'] = password_hash($adminData['password'], PASSWORD_DEFAULT);
            }
            if ($this->db->where(['id' => $adminData['id']])->update('admins', $adminData)) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You updated an admin with  " . $adminData['email'] . " at " . date('Y-m-d H:i:s');
                $this->ActivityModel->createLog($log);
                echo json_encode(['status' => 1, 'msg' => 'Admin Data Updated Successfully!', 'redirect' => site_url('admin/admins/all')]);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Unable to Add Admin', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'store' && $param2 == null) {
            $data = $this->input->post();
            $data['acct_type'] = 'admin';
            $userid = 'PSSADMIN' . random_string('numeric', 5);
            $data['user_id'] = $userid;

            if ($this->db->get_where('admins', ['user_id' => $data['user_id']])->row()) {

                echo json_encode(['status' => 0, 'msg' => 'Admin Data Already Exist', 'redirect' => 'noreload']);
            } else if ($this->db->get_where('admins', ['email' => $data['email']])->row()) {
                echo json_encode(['status' => 0, 'msg' => 'Email Chosen', 'redirect' => 'noreload']);
            } else {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                $userData = $data;
                $adminData = $data;

                $userData['active'] = 'admin';
                $userData['step'] = 0;
                $userData['active'] = 1;
                $userData['token'] = random_string('alnum', 32);
                $userData['about'] = $data['full_name'];

                unset($adminData['full_name']);
                if ($this->db->insert('users', $userData) && $this->db->insert('admins', $adminData)) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You created an admin with  " . $data['email'] . " at " . date('Y-m-d H:i:s');
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Admin Data Created Successfully!', 'redirect' => site_url('admin/admins/all')]);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'Unable to Add Admin', 'redirect' => 'noreload']);
                }
            }
        } else if ($param1 == 'delete' && $param2 != null) {
            if ($this->db->where(['id' => $param2])->delete('admins')) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You deleted an admin with  " . $data['email'] . " at " . date('Y-m-d H:i:s');
                $this->ActivityModel->createLog($log);
                echo json_encode(['status' => 1, 'msg' => 'Admin Data Deleted Successfully!', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Unable to Add Admin', 'redirect' => 'noreload']);
            }
        }
    }

    public function get_json_data($table, $offset = 20)
    {
        $data = $this->db->get($table, 30, $offset)->result_array();
        echo json_encode($data);
    }


    public function live_search($table, $offset)
    {
        $columns = $this->db->query("select * from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='tableName'")->result_array();
        $data = $this->db->get($table, 30, $offset)->result_array();
        echo json_encode($data);
    }


    public function product($param1 = "all", $param2 = 20, $param3 = null)
    {
        if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type' => 'admin', 'active' => 1])->result();
        $this->load->library('pagination');
        $this->load->config('pagination');
        $config = $this->config->item('admin_pagination_config');
        if ($param1 == 'all') {
            // Pagination
            $config['base_url'] = site_url('admin/product/all');
            $config['total_rows'] = count($this->db->get('products')->result_array());
            $this->pagination->initialize($config);

            $data['scripts'] = ['main.js'];
            $data['page_title'] = " | Admin | Products | All Products";
            $data['products'] = $this->db->order_by('created_at', 'desc')->get('products', 20, $param2)->result_array();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/all', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'myproducts') {
            // Pagination$config['base_url'] = site_url('admin/product/all');
            $config['base_url'] = site_url('admin/product/myproducts');
            $config['total_rows'] = count($this->db->where(['owner_id' => $this->session->userdata('user')->user_id])->get('products')->result_array());
            $this->pagination->initialize($config);

            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Products | My Products";
            $data['products'] = $this->db->where(['owner_id' => $this->session->userdata('user')->user_id])->get('products', 20, $param2)->result_array();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/all', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'create') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Products";
            // $data['products'] = $this->ProductModel->getAllProductsNoSeller();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/create', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'view') {
            $data['scripts'] = ['main.js'];
            $data['product'] = $this->ProductModel->getProductBy('code', $param2);
            $data['page_title'] = " | Admin | Products | " . $data['product']['name'];
            // $data['products'] = $this->ProductModel->getAllProductsNoSeller();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/this', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'edit') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['product'] = $this->ProductModel->getProductBy('code', $param2);
            $data['page_title'] = " | Admin | Products | " . $data['product']['name'];
            $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/edit', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'clone') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['product'] = $this->ProductModel->getProductBy('code', $param2);
            $data['page_title'] = " | Admin | Products | " . $data['product']['name'];
            $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/clone', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'update') {
            $product = $this->input->post();
            $product['name'] = $this->clean($product['name']);
            // foreach($this->input->post() as $key => $posts) {
            //     if (count($posts) == 0 || strlen($posts) == 0) {
            //         echo json_encode(['status' => 0, 'msg' => $key.' field is required!', 'reload' => 'noreload']);
            //         exit();
            //     }
            // }
            $update = $this->db->where('product_id', $product['product_id'])->update('products', $product);
            if ($update) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You updated a product with name " . $product['name'] . " at " . date('Y-m-d H:i:s');
                $this->ActivityModel->createLog($log);
                echo json_encode(['status' => 1, 'msg' => 'Product Updated Successfully', 'redirect' => site_url('/admin/product/view/' . $product['code'])]);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An Error Occurred While Updating This Product']);
            }
        } else if ($param1 == 'store') {
            $data = $this->input->post();
            // echo json_encode($data); exit();
            // foreach($data as $key => $posts) {
            //     if (count($posts) == 0 || strlen($posts) == 0) {
            //         echo json_encode(['status' => 0, 'msg' => $key.' field is required!', 'reload' => 'noreload']);
            //         exit();
            //     }
            // }

            $imagedir = FCPATH . '/public/images/products/';
            $newproduct = $this->input->post();
            // echo json_encode($newproduct); exit();
            $newproduct['owner_id'] = $this->session->userdata('user')->user_id;
            $newproduct['code'] = random_string('numeric', 7);
            $newproduct['status'] = 'pending';
            $newproduct['product_id'] = 'PSSPROD' . random_string('numeric', 5);
            $newproduct['created_at'] = date('Y-m-d H:i:s');
            $newproduct['name'] = $this->clean($newproduct['name']);

            // $variant_size = $this->input->post('variant_size');
            // $variant_price = $this->input->post('variant_price');
            // $variant_discount_price = $this->input->post('variant_discount_price');
            // $variant_qty = $this->input->post('variant_qty');


            $product_image_dir = $imagedir . $newproduct['code'];
            // echo $product_image_dir;

            if (!file_exists($product_image_dir)) {
                mkdir($product_image_dir);
            }

            $i = 0;
            // echo json_encode($_FILES); exit();
            $len = count($_FILES['product_image']['tmp_name']);
            $uploaded = false;
            while ($i < $len) {
                $imgn = $i + 1;
                $upload = move_uploaded_file($_FILES['product_image']['tmp_name'][$i], $product_image_dir . '/0' . $imgn . '.jpg');
                if (!$upload) {
                    if (file_exists($product_image_dir)) {
                        rmdir($product_image_dir);
                    }
                    echo json_encode(['msg' => 'An error occurred while uploading product image Maybe an invalid image is detected']);
                    die();
                } else {
                    $uploaded = true;
                    $i++;
                }
            }
            // if($variant_size && $variant_price){
            //     // echo json_encode($this->input->post('option_values'));
            //     foreach($variant_price as $key => $value){
            //         $this_product_variant = array(
            //             'product_id' => $newproduct['product_id'], 
            //             'price' => $variant_price[$key], 
            //             'price' => $variant_price[$key], 
            //             'discount_price' => $variant_discount_price[$key],
            //             'size' => $variant_size[$key],
            //             'qty' => $variant_qty[$key],
            //         );
            //         if(!$this->db->insert('variants', $this_product_variant)){
            //             echo json_encode(['status'=>0, 'msg' => 'Product Variant Creating Issue Encountered']);
            //             exit();
            //         } else {
            //             unset($newproduct['variant_size']);
            //             unset($newproduct['variant_price']);
            //             unset($newproduct['variant_discount_price']);
            //             unset($newproduct['variant_id']);
            //             unset($newproduct['variant_qty']);
            //         }
            //         // echo $key."=>".$option_names[$key]." => ".$value;
            //     }
            // }
            // exit();
            $savedtodb = $this->ProductModel->createNewProduct($newproduct);
            if ($upload && $savedtodb) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You created a new product with name " . $newproduct['name'] . " at " . $this->format_date(date('Y-m-d H:i:s'));
                $this->ActivityModel->createLog($log);
                echo json_encode(['status' => 1, 'msg' => 'Product Created Successfully', 'redirect' => site_url('/admin/product/all')]);
            } else {
                $this->db->where(['product_id' => $newproduct['product_id']])->delete('product_options');
                echo json_encode(['status' => 0, 'msg' => 'An Error Occurred While Creating The Product Please Try Again']);
            }
        } else if ($param1 == 'delete') {
            $product = $this->ProductModel->getProductBy('code', $param2);
            if ($this->ProductModel->deleteProduct($param2)) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You deleted a product with id " . $product['name'] . " at " . $this->format_date(date('Y-m-d H:i:s'));
                $this->ActivityModel->createLog($log);
                echo json_encode(['status' => 1, 'msg' => 'Product Deleted Successfully']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An Error Occurred']);
            }
        } else if ($param1 == 'approve') {
            $product = $this->ProductModel->getProductBy('code', $param2);
            if ($this->ProductModel->approveProduct($param2)) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You Approved a product with id " . $product['name'] . " at " . $this->format_date(date('Y-m-d H:i:s'));
                $this->ActivityModel->createLog($log);
                echo json_encode(['status' => 1, 'msg' => 'Product Approved Successfully']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An Error Occurred']);
            }
        } else if ($param1 == 'unapprove') {
            $product = $this->ProductModel->getProductBy('code', $param2);
            if ($this->ProductModel->unapproveProduct($param2)) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You Disapproved a product with id " . $product['name'] . " at " . $this->format_date(date('Y-m-d H:i:s'));
                $this->ActivityModel->createLog($log);
                echo json_encode(['status' => 1, 'msg' => 'Product Disapproved Successfully']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An Error Occurred']);
            }
        } else if ($param1 == 'pause') {
            $product = $this->ProductModel->getProductBy('code', $param2);
            if ($this->ProductModel->pauseProduct($param2)) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You Paused a product with id " . $product['name'] . " at " . $this->format_date(date('Y-m-d H:i:s'));
                $this->ActivityModel->createLog($log);
                echo json_encode(['status' => 1, 'msg' => 'Product Disapproved Successfully']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An Error Occurred']);
            }
        } else if ($param1 == 'deals' && (is_null($param2) || is_numeric($param2))) {

            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Products | All Deals Of The Day";
            $data['deals'] = $this->DealsOfTheDayModel->getDealsOfTheDay();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/deals_of_the_day', $data);
            $this->load->view('layouts/admin/foot', $data);
		} else if ($param1 == 'deals' && $param2 == 'search') {
            // Pagination
            $config['base_url'] = site_url('admin/product/deals/add');
            $config['total_rows'] = count($this->db->get('products')->result_array());
            $this->pagination->initialize($config);
            
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Products |Seach";
            $key = $this->input->post('key'); // Parameter to use to search
            $value = $this->input->post('value');    // Value to map with the parameter

            $checking = array();
            if ($key == 'category') {
                $category_ids = $this->db->query("SELECT id FROM category WHERE name LIKE '%$value%'")->result_array();
                if ($category_ids) {
                    foreach ($category_ids as $key => $value) {
                        array_push($checking, $value['id']);
                    }
                }
            }

            ($key != 'category') ? $this->db->like("$key", $value, 'both') : null;
            $this->db->limit(30);
            (count($checking) > 0) ? $this->db->where_in('category_id', $checking) : null;
            $data['products'] = $this->db->get('products')->result_array();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/add_deal_of_the_day', $data);
            $this->load->view('layouts/admin/foot', $data);
													   
        } else if ($param1 == 'deals' && $param2 == 'add') {
            // Pagination
            $config['base_url'] = site_url('admin/product/deals/add');
            $config['total_rows'] = count($this->db->get('products')->result_array());
            $this->pagination->initialize($config);


            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Products | Add Deals Of The Day";
            $data['products'] = $this->ProductModel->getAllProductsNoSeller();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/add_deal_of_the_day', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'deals' && $param2 == 'store') {
            $dealDatas = $this->input->post();
            // $i = 0;
            foreach ($dealDatas as $key => $dealData) {
                if (strlen($dealData) == 0) {
                    echo json_encode(['status' => 0, 'msg' => str_replace(['_'], [' '], ucfirst($key)) . ' is required!', 'redirect' => 'noreload']);
                    exit();
                }
            }
            if ($this->DealsOfTheDayModel->getDealOfTheDayWith($dealDatas)) {
                echo json_encode(['status' => 0, 'msg' => 'This deal exist!']);
                exit();
            } else {
                if ($this->DealsOfTheDayModel->createDealOfTheDay($dealDatas)) {
                    // $log['owner_id'] = $this->session->userdata('user')->user_id;
                    // $log['action'] = "You added a product with id " . $dealDatas['id'] . " to deals of the day at " . $this->format_date(date('Y-m-d H:i:s'));
                    // $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Deal Created Successfully', 'redirect' => site_url('admin/product/deals')]);
                    exit();
                } else {
					echo json_encode(['status' => 0, 'msg' => 'An error Occurred Please try again!', 'redirect' => 'noreload']);
                    exit();
                }
            }
        } else if ($param1 == 'deals' && $param2 == 'update') {
            $newDealData = $this->input->post();
            foreach ($newDealData as $key => $dealData) {
                if (strlen($dealData) == 0) {
                    echo json_encode(['status' => 0, 'msg' => str_replace(['_'], [' '], ucfirst($key)) . ' is required!', 'redirect' => 'noreload']);
                    exit();
                }
            }
            if ($this->DealsOfTheDayModel->getDealOfTheDayWith($newDealData)) {
                echo json_encode(['status' => 0, 'msg' => 'This deal exist!']);
                exit();
            } else {
                if ($this->DealsOfTheDayModel->updateDealOfTheDay($newDealData['id'], $newDealData)) {
                    // $log['owner_id'] = $this->session->userdata('user')->user_id;
                    // $log['action'] = "You updated a product with id " . $newDealData['id'] . " in deals of the day at " . $this->format_date(date('Y-m-d H:i:s'));
                    // $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Deal Data Updated Successfully', 'redirect' => 'reload']);
                    exit();
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'An error occurred! Please try again later']);
                    exit();
                }
            }
        } else if ($param1 == 'deals' && $param2 == 'remove') {
            if ($this->DealsOfTheDayModel->removeDealOfTheDay($param3)) {
                echo json_encode(['status' => 1, 'msg' => 'Delete removed successfully', 'redirect' => 'reload']);
                exit();
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred! Please try again later', 'redirect' => 'noreload']);
                exit();
            }
        } else if ($param1 == 'featured' &&  (is_null($param2) || is_numeric($param2))) {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Products | All Featured Products";
            // $data['deals'] = $this->DealsOfTheDayModel->getDealsOfTheDay();
            $data['featuredProducts'] = $this->ProductModel->getFeaturedProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/featured_products', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'featured' && $param2 == 'add') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Products | All Featured Products";
            $data['products'] = $this->ProductModel->getProductsBy('featured', 0);
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/add_featured_product', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'featured' && $param2 == 'store') {
            $product_id = $this->input->post('product_id');
            if ($this->ProductModel->addToFeaturedProducts($product_id)) {
                echo json_encode(['status' => 1, 'msg' => 'Product Featured Successfully', 'redirect' => 'reload']);
                exit();
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred! Please try again!', 'redirect' => 'noreload']);
                exit();
            }
        } else if ($param1 == 'featured' && $param2 == 'remove') {
            $product_id = $this->input->post('product_id');
            // $product_id = $this->input->post('product_id');
            if ($this->ProductModel->removeFromFeaturedProducts($product_id)) {
                echo json_encode(['status' => 1, 'msg' => 'Product UnFeatured Successfully', 'redirect' => 'reload']);
                exit();
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred! Please try again!', 'redirect' => 'noreload']);
                exit();
            }
        } else if ($param1 == 'brands' &&  (is_null($param2) || is_numeric($param2))) {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Products | All Brands";
            $data['brands'] = $this->BrandsModel->getBrands();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/brands', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'brands' && $param2 == 'store') {
            $brandData = $this->input->post();
            $config['upload_path']          = './public/images/system/brands/';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 300;
            $config['max_height']           = 120;
            $config['file_name']            = $brandData['name'];
            $this->load->library('upload', $config);
            if ($this->BrandsModel->getBrandBy(['name' => $brandData['name']])) {
                echo json_encode(['status' => 0, 'msg' => 'Brand Already Exist', 'redirect' => 'reload']);
            } else {
                if (!$this->upload->do_upload('image_path')) {
                    $msg = str_replace(['<p>', '</p>'], [''], $this->upload->display_errors());
                    echo json_encode(['status' => 0, 'msg' => $msg, 'redirect' => 'noreload']);
                } else {
                    $brandData['image_path'] = site_url('public/images/system/brands/' . $this->upload->data('file_name'));
                    if ($this->BrandsModel->createBrand($brandData)) {
                        echo json_encode(['status' => 1, 'msg' => 'Brand Created Successfully', 'redirect' => 'reload']);
                    } else {
                        echo json_encode(['status' => 0, 'msg' => 'An Error Occurred! Please try again later', 'redirect' => 'reload']);
                    }
                }
            }
        } else if ($param1 == 'brands' && $param2 == 'update') {
            $brandData = $this->input->post();
            $config['upload_path']          = './public/images/system/brands/';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['max_size']             = 300;
            $config['max_width']            = 100;
            $config['max_height']           = 80;
            $config['overwrite']            = true;
            $config['file_name']            = $brandData['name'];
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image_path')) {
                $msg = str_replace(['<p>', '</p>'], [''], $this->upload->display_errors());
                echo json_encode(['status' => 0, 'msg' => $msg, 'redirect' => 'noreload']);
            } else {
                $brandData['image_path'] = site_url('public/images/system/brands/' . $this->upload->data('file_name'));
                if ($this->BrandsModel->updateBrand($brandData['id'], $brandData)) {
                    echo json_encode(['status' => 1, 'msg' => 'Brand Created Successfully', 'redirect' => 'reload']);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'An Error Occurred! Please try again later', 'redirect' => 'noreload']);
                }
            }
        } else if ($param1 == 'brands' && $param2 == 'edit') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Products | All Brands";
            $data['brands'] = $this->BrandsModel->getBrands();
            $data['brandData'] = $this->BrandsModel->getBrandBy(['id' => $param3]);
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/brands', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'brands' && $param2 == 'delete') {
            if ($this->BrandsModel->deleteBrand($param3)) {
                echo json_encode(['status' => 1, 'msg' => 'Brand Deleted Successfully', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An Error Occurred! Please try again later', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'banners' &&  (is_null($param2) || is_numeric($param2))) {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Products | All Banners";
            $data['banners'] = $this->BannersModel->getBanners();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/banners', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'banners' && $param2 == 'store') {
            $bannerData = $this->input->post();
            $config['upload_path']          = './public/images/system/banners/';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['max_size']             = 3000;
            $config['max_width']            = 7000;
            $config['max_height']           = 3000;
            $config['file_name']            = $bannerData['name'];
            $this->load->library('upload', $config);
            if ($this->BannersModel->getBannerBy(['name' => $bannerData['name']])) {
                echo json_encode(['status' => 0, 'msg' => 'Banner Already Exist', 'redirect' => 'reload']);
            } else {
                if (!$this->upload->do_upload('image_path')) {
                    $msg = str_replace(['<p>', '</p>'], [''], $this->upload->display_errors());
                    echo json_encode(['status' => 0, 'msg' => $msg, 'redirect' => 'noreload']);
                } else {
                    $bannerData['image_path'] = site_url('public/images/system/banners/' . $this->upload->data('file_name'));
                    if ($this->BannersModel->createBanner($bannerData)) {
                        echo json_encode(['status' => 1, 'msg' => 'Banner Created Successfully', 'redirect' => 'reload']);
                    } else {
                        echo json_encode(['status' => 0, 'msg' => 'An Error Occurred! Please try again later', 'redirect' => 'reload']);
                    }
                }
            }
        } else if ($param1 == 'banners' && $param2 == 'update') {
            $bannerData = $this->input->post();
            $config['upload_path']          = './public/images/system/banners/';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['max_size']             = 3000;
            $config['max_width']            = 7000;
            $config['max_height']           = 3000;
            $config['overwrite']            = true;
            $config['file_name']            = $bannerData['name'];
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image_path')) {
                $msg = str_replace(['<p>', '</p>'], [''], $this->upload->display_errors());
                echo json_encode(['status' => 0, 'msg' => $msg, 'redirect' => 'noreload']);
            } else {
                $bannerData['image_path'] = site_url('public/images/system/banners/' . $this->upload->data('file_name'));
                if ($this->BannersModel->updateBanner($bannerData['id'], $bannerData)) {
                    echo json_encode(['status' => 1, 'msg' => 'Banner Created Successfully', 'redirect' => 'reload']);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'An Error Occurred! Please try again later', 'redirect' => 'noreload']);
                }
            }
        } else if ($param1 == 'banners' && $param2 == 'edit') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Products | All Brands";
            $data['banners'] = $this->BannersModel->getBanners();
            $data['bannerData'] = $this->BannersModel->getBannerBy(['id' => $param3]);
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/banners', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'banners' && $param2 == 'delete') {
            if ($this->BannersModel->deleteBanner($param3)) {
                echo json_encode(['status' => 1, 'msg' => 'Banner Deleted Successfully', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An Error Occurred! Please try again later', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'ads_banners' && (is_null($param2) || is_numeric($param2))) {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Products | All Ads Banners";
            $data['adsBanners'] = $this->AdsBannersModel->getAdsBanners();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/ads_banners', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'ads_banners' && $param2 == 'store') {
            $adsBannerData = $this->input->post();
            $config['upload_path']          = './public/images/system/ads_banners/';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['max_size']             = 3000;
            $config['max_width']            = 7000;
            $config['max_height']           = 3000;
            $config['file_name']            = $adsBannerData['name'];
            $this->load->library('upload', $config);
            if ($this->AdsBannersModel->getAdsBannerBy(['name' => $adsBannerData['name']])) {
                echo json_encode(['status' => 0, 'msg' => 'Ads Banner Already Exist', 'redirect' => 'reload']);
            } else {
                if (!$this->upload->do_upload('image_path')) {
                    $msg = str_replace(['<p>', '</p>'], [''], $this->upload->display_errors());
                    echo json_encode(['status' => 0, 'msg' => $msg, 'redirect' => 'noreload']);
                } else {
                    $adsBannerData['image_path'] = site_url('public/images/system/ads_banners/' . $this->upload->data('file_name'));
                    if ($this->AdsBannersModel->createAdsBanner($adsBannerData)) {
                        echo json_encode(['status' => 1, 'msg' => 'Ads Banner Created Successfully', 'redirect' => 'reload']);
                    } else {
                        echo json_encode(['status' => 0, 'msg' => 'An Error Occurred! Please try again later', 'redirect' => 'reload']);
                    }
                }
            }
        } else if ($param1 == 'ads_banners' && $param2 == 'update') {
            $adsBannerData = $this->input->post();
            $config['upload_path']          = './public/images/system/ads_banners/';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['max_size']             = 3000;
            $config['max_width']            = 7000;
            $config['max_height']           = 3000;
            $config['overwrite']            = true;
            $config['file_name']            = $adsBannerData['name'];
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image_path')) {
                $msg = str_replace(['<p>', '</p>'], [''], $this->upload->display_errors());
                echo json_encode(['status' => 0, 'msg' => $msg, 'redirect' => 'noreload']);
            } else {
                $adsBannerData['image_path'] = site_url('public/images/system/ads_banners/' . $this->upload->data('file_name'));
                if ($this->AdsBannersModel->updateAdsBanner($adsBannerData['id'], $adsBannerData)) {
                    echo json_encode(['status' => 1, 'msg' => 'Banner Updated Successfully', 'redirect' => 'reload']);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'An Error Occurred! Please try again later', 'redirect' => 'noreload']);
                }
            }
        } else if ($param1 == 'ads_banners' && $param2 == 'edit') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Products | All Brands";
            $data['adsBanners'] = $this->AdsBannersModel->getAdsBanners();
            $data['adsBannerData'] = $this->AdsBannersModel->getAdsBannerBy(['id' => $param3]);
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/product/ads_banners', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'ads_banners' && $param2 == 'delete') {
            if ($this->AdsBannersModel->deleteAdsBanner($param3)) {
                echo json_encode(['status' => 1, 'msg' => 'Ads Banner Deleted Successfully', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An Error Occurred! Please try again later', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'variant' && $param2 == 'delete') {
            $variant_id = $param3;
            $response = array();
            if ($this->db->where('id', $variant_id)->delete('variants')) {
                if (!$response) {
                    $response['status'] = 1;
                    $response['msg'] = 'Variant Deleted Successfully';
                    $response['redirect'] = 'reload';
                }
            } else {
                if (!$response) {
                    $response['status'] = 0;
                    $response['msg'] = 'An error occurred while deleting varaint';
                    $response['redirect'] = 'noreload';
                }
            }
            echo json_encode($response);
        } else if ($param1 == 'live_search') {
            $key = $this->input->get('key'); // Parameter to use to search
            $value = $this->input->get('value');    // Value to map with the parameter
            $page = $this->input->get('page');  // The View To Display The Result
            // var_dump($value);
            // var_dump($page);
            // if () {}
            $checking = array();
            if ($key == 'category') {
                $category_ids = $this->db->query("SELECT id FROM category WHERE name LIKE '%$value%'")->result_array();
                if ($category_ids) {
                    foreach ($category_ids as $key => $value) {
                        array_push($checking, $value['id']);
                    }
                }
            }

            ($key != 'category') ? $this->db->like("$key", $value, 'both') : null;
            $this->db->limit(30);
            (count($checking) > 0) ? $this->db->where_in('category_id', $checking) : null;
            $data['products'] = $this->db->get('products')->result_array();
            // $data['key'] = $key;
            echo $this->load->view('layouts/admin/live_search_result/' . $page . '.php', $data, true);
        }
    }


    public function category($param1 = "all", $param2 = '', $param3 = '')
    {
        if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));

        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type' => 'admin', 'active' => 1])->result();

        if ($param1 == 'all') {
            $data['scripts'] = ['main.js'];
            $data['page_title'] = " | Admin | Products";
            $data['categories'] = $this->CategoryModel->getAllCategories();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/category/all', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'create') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Category | New Category";
            // $data['products'] = $this->ProductModel->getAllProducts();
            $data['categories'] = $this->CategoryModel->getAllCategories();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/category/create', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'view') {
            $data['scripts'] = ['main.js'];
            $data['category'] = $this->CategoryModel->getCategory($param2);
            $data['page_title'] = " | Admin | Category | " . $data['category']['name'];
            if ($data['category']) {
                $this->load->view('layouts/admin/head', $data);
                $this->load->view('layouts/admin/top_nav', $data);
                $this->load->view('admin/category/this', $data);
                $this->load->view('layouts/admin/foot', $data);
            } else {
                $this->category();
            }
        } else if ($param1 == 'edit') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['category'] = $this->CategoryModel->getCategoryBy('id', $param2);
            $data['categories'] = $this->CategoryModel->getAllCategories();
            $data['page_title'] = " | Admin | Category | " . $data['category']['name'];
            // $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/category/edit', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'subcategory' && $param2 == 'edit') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['subcategory'] = $this->SubCategoryModel->getSubCategoryBy('id', $param3);
            $data['page_title'] = " | Admin | SubCategory | " . $data['subcategory']['name'];
            // $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/category/subcategory/edit', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'subcategory' && $param2 == 'create') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['category'] = $this->CategoryModel->getCategoryBy('id', $param3);
            $data['page_title'] = " | Admin | Category | " . $data['category']['name'];
            // $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/category/subcategory/create', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'subcategory' && $param2 == 'view') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['subcategory'] = $this->SubCategoryModel->getSubCategoryBy('id', $param3);
            $data['page_title'] = " | Admin | SubCategory | " . $data['subcategory']['name'];
            // $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/category/subcategory/this', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'update') {
            $category = $this->input->post();
            // echo json_encode($category); exit();
            foreach ($category as $key => $cat) {
                if (strlen($cat) < 0) {
                    echo json_encode(['status' => 0, 'msg' => $key . ' Field is required']);
                    exit();
                }
            }

            $exist = $this->CategoryModel->getCategoryBy('id', $category['id']);
            if ($exist) {
                unset($category['id']);
                $update = $this->CategoryModel->updateCategory($exist['id'], $category);
                $category_image = $_FILES;
                if ($category_image['category_image']['tmp_name']) {
                    $image_path = FCPATH . '/public/images/system/categories/';
                    if (file_exists($image_path . $category['name'] . '.jpg')) {
                        unlink($image_path . strtolower(str_replace(' ', '-', $category['name'])) . '.jpg');
                    }
                    $upload = move_uploaded_file($category_image['category_image']['tmp_name'], $image_path . strtolower(str_replace(' ', '-', $category['name'])) . '.jpg');
                } else {
                    $upload = true;
                }

                if ($upload && $update) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You updated a category with name " . $exist['name'] . " at " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Category Updated Successfully', 'redirect' => site_url('admin/category/all')]);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'An Error Occurred!']);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Category Do Not Exist']);
            }
        } else if ($param1 == 'subcategory' && $param2 == 'update') {
            $category = $this->input->post();
            // var_dump($category);
            foreach ($category as $key => $cat) {
                if (strlen($cat) < 0) {
                    echo json_encode(['status' => 0, 'msg' => $key . ' Field is required']);
                    exit();
                }
            }

            $exist = $this->SubCategoryModel->getSubCategoryBy('id', $category['id']);
            if ($exist) {
                unset($category['id']);
                $update = $this->SubCategoryModel->updateSubCategory($exist['id'], $category);
                $category_image = $_FILES;
                if ($category_image['category_image']['tmp_name']) {
                    $image_path = FCPATH . '/public/images/system/subcategories/';
                    if (file_exists($image_path . str_replace(' ', '-', $category['name']) . '.jpg')) {
                        unlink($image_path . strtolower(str_replace(' ', '-', $category['name'])) . '.jpg');
                    }
                    $upload = move_uploaded_file($category_image['category_image']['tmp_name'], $image_path . strtolower(str_replace(' ', '-', $category['name'])) . '.jpg');
                } else {
                    $upload = true;
                }

                if ($upload && $update) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You updated a subcategory with name " . $exist['name'] . " at " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Category Updated Successfully', 'redirect' => site_url('/admin/category/view/' . $exist['category_id'])]);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'An Error Occurred!']);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Category Do Not Exist']);
            }
        } else if ($param1 == 'store') {
            $category = $this->input->post();
            $category['created_at'] = date('Y-m-d H:i:s');
            foreach ($category as $key => $cat) {
                if (strlen($cat) < 0) {
                    echo json_encode(['status' => 0, 'msg' => $key . ' Field is required']);
                    exit();
                }
            }

            $exist = $this->CategoryModel->getCategoryBy('name', $category['name']);
            if (!$exist) {
                $create = $this->CategoryModel->createNewCategory($category);
                $category_image = $_FILES;
                $image_path = FCPATH . '/public/images/system/categories/';
                if (file_exists($image_path . $category['name'] . '.jpg')) {
                    unlink($image_path . strtolower(str_replace(' ', '-', $category['name'])) . '.jpg');
                }
                $upload = move_uploaded_file($category_image['category_image']['tmp_name'], $image_path . strtolower(str_replace(' ', '-', $category['name'])) . '.jpg');
                if ($upload && $create) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You created a new category with name " . $category['name'] . " at " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Category Created Successfully', 'redirect' => site_url('/admin/category')]);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'An Error Occurred!']);
                }
            } else {
                echo json_encode(['status' => 1, 'msg' => 'Category Already Exist', 'redirect' => site_url('/admin/category/view/' . $exist['id'])]);
            }

            // echo json_encode($this->input->post());
            // echo json_encode($_FILES);
        } else if ($param1 == 'subcategory' && $param2 == 'store') {
            $category = $this->input->post();
            // $category['created_at'] = date('Y-m-d H:i:s');
            foreach ($category as $key => $cat) {
                if (strlen($cat) < 0) {
                    echo json_encode(['status' => 0, 'msg' => $key . ' Field is required']);
                    exit();
                }
            }

            $exist = $this->SubCategoryModel->getSubCategoryBy('name', $category['name']);
            if (!$exist) {
                unset($category['category']);
                $create = $this->SubCategoryModel->createNewSubCategory($category);
                $category_image = $_FILES;
                $image_path = FCPATH . '/public/images/system/subcategories/';
                if (file_exists($image_path . str_replace(' ', '-', $category['name']) . '.jpg')) {
                    unlink($image_path . strtolower(str_replace(' ', '-', $category['name'])) . '.jpg');
                }
                $upload = move_uploaded_file($category_image['category_image']['tmp_name'], $image_path . strtolower(str_replace(' ', '-', $category['name'])) . '.jpg');
                if ($upload && $create) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You created a new subcategory with name " . $category['name'] . " at " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'SubCategory Created Successfully', 'redirect' => site_url('/admin/category/view/' . $param3)]);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'An Error Occurred!']);
                }
            } else {
                echo json_encode(['status' => 1, 'msg' => 'SubCategory Already Exist', 'redirect' => site_url('/admin/category/view/' . $param3)]);
            }

            // echo json_encode($this->input->post());
            // echo json_encode($_FILES);
        } else if ($param1 == 'delete') {
            $exist = $this->CategoryModel->getCategoryBy('id', $param2);
            if ($exist) {
                // unset($category['id']);
                $delete = $this->CategoryModel->deleteCategory($exist['id']);
                $category_image = $_FILES;
                $image_path = FCPATH . '/public/images/system/categories/';
                if (file_exists($image_path . str_replace(' ', '-', $exist['name']) . '.jpg')) {
                    unlink($image_path . strtolower(str_replace(' ', '-', $exist['name'])) . '.jpg');
                }
                if ($delete) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You deleted a category with name " . $exist['name'] . " at " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Category Deleted Successfully']);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'An Error Occurred']);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Category Do Not Exist']);
            }
        } else if ($param1 == 'subcategory' && $param2 = 'delete') {
            $exist = $this->SubCategoryModel->getSubCategoryBy('id', $param3);
            if ($exist) {
                // unset($category['id']);
                $delete = $this->SubCategoryModel->deleteSubCategory($exist['id']);
                $category_image = $_FILES;
                $image_path = FCPATH . '/public/images/system/categories/';
                if (file_exists($image_path . str_replace(' ', '-', $exist['name']) . '.jpg')) {
                    unlink($image_path . strtolower(str_replace(' ', '-', $exist['name'])) . '.jpg');
                }
                if ($delete) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You deleted a subcategory with name " . $exist['name'] . " at " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Sub Category Deleted Successfully']);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'An Error Occurred']);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Category Do Not Exist']);
            }
        } else if ($param1 == 'feature') {
            // echo json_encode([$param2]); exit();
            if ($this->db->where('id', $param2)->update('category', ['featured' => 1])) {
                echo json_encode(['status' => 1, 'msg' => 'Category added to featured category successfully', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred! Please try again later', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'un_feature') {
            // echo json_encode([$param2]); exit();
            if ($this->db->where('id', $param2)->update('category', ['featured' => 0])) {
                echo json_encode(['status' => 1, 'msg' => 'Category removed from featured category successfully', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred! Please try again later', 'redirect' => 'noreload']);
            }
        }
    }


    public function seller($param1 = 'all', $param2 = '')
    {
        if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));
        $data['scripts'] = ['main.js'];
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type' => 'admin', 'active' => 1])->result();
        if ($param1 == 'all') {
            $data['sellers'] = $this->db->join('users', 'users.user_id = sellers.seller_id')->get('sellers')->result();
            $data['page_title'] = " All Seller @ White Market";
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/seller/all', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'view') {
            $data['sellerData'] = $this->db->get_where('users', ['user_id' => $param2])->row_array();
            // var_dump($data['sellerData']);
            $data['page_title'] = " Users " . $data['sellerData']['full_name'];
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/seller/this', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'approve' && $param2 != null) {
        } else if ($param1 == '' && $param2 != null) {
        }
    }


    public function user($param1 = 'all', $param2 = '')
    {
        if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));
        $this->load->model('MailSender');
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type' => 'admin', 'active' => 1])->result();
        $data['scripts'] = ['main.js', 'forms.js'];
        if ($param1 == 'all' && $param2 == null) {
            $data['userslist'] = $this->db->get('users')->result();
            $data['page_title'] = " | Admin | All Users";
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/users/all', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'view' && $param2 != null) {
            $data['userData'] = $this->db->get_where('users', ['user_id' => $param2])->row_array();
            // var_dump($data['userData']);
            $data['page_title'] = " | Admin | Users | View User";
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/users/this', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'delete' && $param2 != null) {
            $userdeleted = false;
            $user = $this->UserModel->getUserBy('user_id', $param2);
            if ($user['acct_type'] == 'seller') {
                if ($this->db->where('owner_id', $param2)->delete('products') && $this->db->where('seller_id', $param2)->delete('sellers')) {
                    $this->db->where('user_id', $param2)->delete('users');
                    $this->db->where('user_id', $param2)->delete('contacts');
                    $this->db->where('user_id', $param2)->delete('admins');
                    $this->db->where('member_id', $param2)->delete('cooperative_member');
                    $userdeleted = true;
                }
            } else {
                if ($this->db->where('member_id', $param2)->delete('cooperative_member') && $this->db->where('user_id', $param2)->delete('admins') && $this->db->where('user_id', $param2)->delete('users') && $this->db->where('user_id', $param2)->delete('contacts')) {
                    $userdeleted = true;
                }
            }
            if ($userdeleted) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You deleted a user account with the following information<br/>.";
                $log['action'] .= " UserId: " . $user['user_id'] . '<br/>';
                $log['action'] .= " Name: " . $user['full_name'] . '<br/>';
                $log['action'] .= " Email: " . $user['email'] . '<br/>';
                $log['action'] .= " on " . $this->format_date(date('Y-m-d H:i:s'));
                $this->ActivityModel->createLog($log);
                echo json_encode(['status' => 1, 'msg' => 'Account Deleted Successfully', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred! Please try again later']);
            }
        } else if ($param1 == 'suspend' && $param2 != null) {
            if ($this->db->where(['user_id' => $param2])->update('users', ['step' => 3])) {
                $userData = $this->db->get_where('users', ['user_id' => $param2])->row();
                $to['email'] = $userData->email;
                $to['name'] = $userData->full_name;
                $msg['subject'] = "Account Suspension";
                $msg['message'] = "<p>Your account have been suspended</p>";
                if ($this->MailSender->send_mail($to, $msg, 'html')) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You suspended a user account with the following information<br/>.";
                    $log['action'] .= " UserId: " . $userData->user_id . '<br/>';
                    $log['action'] .= " Name: " . $userData->full_name . '<br/>';
                    $log['action'] .= " Email: " . $userData->email . '<br/>';
                    $log['action'] .= " on " . $this->format_date(date('Y-m-d H:i:s'));
                    echo json_encode(['status' => 1, 'msg' => 'Account suspended successfully!', 'redirect' => 'reload']);
                } else {
                    $this->db->where(['user_id' => $param2])->update('users', ['step' => 0]);
                    echo json_encode(['status' => 0, 'msg' => 'Unable to suspend user! Please try again later', 'redirect' => 'noreload']);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Unable to suspend user! Please try again later', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'approve' && $param2 != null) {
            if ($this->db->where(['user_id' => $param2])->update('users', ['step' => 0, 'active' => 1])) {
                $userData = $this->db->get_where('users', ['user_id' => $param2])->row();
                $to['email'] = $userData->email;
                $to['name'] = $userData->full_name;
                $msg['subject'] = "Account Approval";
                $msg['message'] = "<p>Your account have been approved click <a href='" . site_url('buyer/login') . "'>here</a> to login</p>";
                if ($this->MailSender->send_mail($to, $msg, 'html')) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You approved a user account with the following information<br/>.";
                    $log['action'] .= " UserId: " . $userData->user_id . '<br/>';
                    $log['action'] .= " Name: " . $userData->full_name . '<br/>';
                    $log['action'] .= " Email: " . $userData->email . '<br/>';
                    $log['action'] .= " on " . $this->format_date(date('Y-m-d H:i:s'));

                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Account Approved successfully!', 'redirect' => 'reload']);
                } else {
                    $this->db->where(['user_id' => $param2])->update('users', ['step' => 2]);
                    echo json_encode(['status' => 0, 'msg' => 'Unable to approve user account! Please try again later', 'redirect' => 'noreload']);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Unable to approve user account! Please try again later', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'create' && $param2 == null) {
            // $data['userslist'] = $this->db->get('users')->result();
            $data['page_title'] = " | Admin | Users | New User";
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/users/create', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'store' && $param2 == null) {
            $userData = $this->input->post();
            $userData['step'] = 0;
            $userData['user_id'] = "PSSUSER" . random_string('nozero', 5);
            $userData['acct_type'] = 'buyer';
            $userData['token'] = random_string('alnum', 32);
            $password = $userData['password'];
            $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
            $userData['about'] = '';
            $userData['active'] = 1;
            $contactData['phone_number'] = $userData['phone_number'];
            $contactData['email'] = $userData['email'];
            $contactData['user_id'] = $userData['user_id'];
            $contactData['address'] = 'Address';
            $contactData['billing_address'] = 'Adress';
            $contactData['state_id'] = 1;
            $contactData['local_id'] = 15;
            unset($userData['phone_number']);
            if ($this->db->get_where('users', ['email' => $userData['email']])->row()) {
                echo json_encode(['status' => 0, 'msg' => "User with email: " . $userData['email'] . " already exist", 'redirect' => 'noreload']);
            } else {
                if ($this->db->insert('users', $userData) && $this->db->insert('contacts', $contactData)) {
                    // $userData = $this->db->get_where('users', ['user_id' => $param2])->row();
                    $to['email'] = $userData['email'];
                    $to['name'] = $userData['full_name'];
                    $msg['subject'] = "Account Creation";
                    $msg['message'] = "<p>An account have been created for you! click <a href='" . site_url('buyer/login') . "'>here</a> to login. Login with email: " . $userData['email'] . " password: " . $password . "</p>";
                    if ($this->MailSender->send_mail($to, $msg, 'html')) {
                        $log['owner_id'] = $this->session->userdata('user')->user_id;
                        $log['action'] = "You added a new user account with the following information<br/>.";
                        $log['action'] .= " UserId: " . $userData['user_id'] . '<br/>';
                        $log['action'] .= " Name: " . $userData['full_name'] . '<br/>';
                        $log['action'] .= " Email: " . $userData['email'] . '<br/>';
                        $log['action'] .= " on " . $this->format_date(date('Y-m-d H:i:s'));
                        $this->ActivityModel->createLog($log);
                        echo json_encode(['status' => 1, 'msg' => 'User Added Successfully', 'redirect' => site_url('admin/user/all')]);
                    } else {
                        $this->db->where(['user_id' => $userData['user_id']])->delete('users');
                        $this->db->where(['user_id' => $userData['user_id']])->delete('contacts');
                        echo json_encode(['status' => 0, 'msg' => "Unable to add new user!", 'redirect' => 'noreload']);
                    }
                } else {
                    echo json_encode(['status' => 0, 'msg' => "Unable to add new user!", 'redirect' => 'noreload']);
                }
            }
        } else if ($param1 == 'edit' && $param2 != null) {
            $data['userData'] = $this->db->get_where('users', ['user_id' => $param2])->row();
            $data['page_title'] = " | Admin | Users | Edit User";
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/users/edit', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'update' && $param2 == null) {
            $userData = $this->input->post();
            if ($userData['password'] != '') {
                $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
            } else {
                unset($userData['password']);
            }

            if ($this->db->get_where('users', ['email' => $userData['email'], 'user_id !=' => $userData['user_id']])->row()) {
                echo json_encode(['status' => 0, 'msg' => 'Email Already Taken', 'redirect' => 'noreload']);
            } else {
                if ($this->db->where(['user_id' => $userData['user_id']])->update('users', $userData)) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You updated a user account with the following information<br/>.";
                    $log['action'] .= " UserId: " . $userData['user_id'] . '<br/>';
                    $log['action'] .= " Name: " . $userData['full_name'] . '<br/>';
                    $log['action'] .= " Email: " . $userData['email'] . '<br/>';
                    $log['action'] .= " on " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'User Data Updated Successfully', 'redirect' => site_url('admin/user/all')]);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'Unable to update user data! Please try again later', 'redirect' => 'noreload']);
                }
            }
        } else if ($param1 == 'activate' && $param2 != null) {
            if ($this->db->where(['user_id' => $param2])->update('users', ['step' => 0, 'active' => 1])) {
                $userData = $this->db->get_where('users', ['user_id' => $param2])->row();
                $to['email'] = $userData->email;
                $to['name'] = $userData->full_name;
                $msg['subject'] = "Account Activation";
                $msg['message'] = "<p>Your account have been have been activated after been suspended</p>";
                if ($this->MailSender->send_mail($to, $msg, 'html')) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You activated a user account with the following information<br/>.";
                    $log['action'] .= " UserId: " . $userData->user_id . '<br/>';
                    $log['action'] .= " Name: " . $userData->full_name . '<br/>';
                    $log['action'] .= " Email: " . $userData->email . '<br/>';
                    $log['action'] .= " on " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Account Activated successfully!', 'redirect' => 'reload']);
                } else {
                    $this->db->where(['user_id' => $param2])->update('users', ['step' => 3]);
                    echo json_encode(['status' => 0, 'msg' => 'Unable to activate user account! Please try again later', 'redirect' => 'noreload']);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Unable to activate user account! Please try again later', 'redirect' => 'noreload']);
            }
        }
    }

    public function settings($param1 = '', $param2 = null, $param3 = null, $param4 = null)
    {
        if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type' => 'admin', 'active' => 1])->result();
        if ($param1 == 'menus' && !isset($param2)) {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['menues'] = $this->db->get('menus')->result();
            $data['page_title'] = " | Admin | Menu | All Menu";
            // $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/menus/all', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'menus' && $param2 == 'view') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['men'] = $this->db->where('id', $param3)->get('menus')->row();
            $data['page_title'] = " | Admin | Menu | " . $data['men']->name;

            // echo var_dump($data['menu']);
            // $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/menus/this', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'menus' && $param2 == 'edit') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['men'] = $this->db->where('id', $param3)->get('menus')->row();
            $data['page_title'] = " | Admin | Menu | " . $data['men']->name;

            // echo var_dump($data['menu']);
            // $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/menus/editmenu', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'menus' && $param2 == 'activate') {
            if ($this->db->where('id', $param3)->update('menus', ['active' => 1])) {
                echo json_encode(['status' => 1, 'msg' => 'Menu activated successfully', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'menus' && $param2 == 'deactivate') {
            if ($this->db->where('id', $param3)->update('menus', ['active' => 0])) {
                echo json_encode(['status' => 1, 'msg' => 'Menu deactivated successfully', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'submenu' && $param2 == 'edit') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['submen'] = $this->db->where('id', $param3)->get('submenu')->row();
            $data['page_title'] = " | Admin | Menu | Sub Menu | " . $data['submen']->name;
            $data['menues'] = $this->db->get('menus')->result();
            // echo var_dump($data['menu']);
            // $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/menus/editsubmenu', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'menus' && $param2 == 'store') {
            $this->form_validation->set_rules('name', 'Menu Name', 'trim|required');
            $this->form_validation->set_rules('fafa', 'Menu Icon', 'trim|required');
            $this->form_validation->set_rules('url', 'Menu URL', 'trim|required');
            $this->form_validation->set_rules('acct_type', 'Allowed User', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => 0, 'msg' => validation_errors()]);
            } else {
                $menu = $this->input->post();
                $acct_types = explode(',', $menu['acct_type']);
                // var_dump($acct_types); die("I am done here");
                $stored = false;
                $stored_menu = 0;
                foreach ($acct_types as $index => $acct) {
                    // echo $acct.'<br/>';
                    $menu['acct_type'] = $acct;
                    $menu['url'] = $acct . '/' . strtolower($menu['name']);
                    $view = VIEWPATH . $acct;
                    // echo $view.'<br/>';
                    if (!file_exists($view)) {
                        mkdir($view);
                    }
                    // echo $view.'/'.strtolower($menu['name']).'<br/>';
                    if (!file_exists($view . '/' . strtolower($menu['name']))) {
                        mkdir($view . '/' . strtolower($menu['name']));
                    }

                    $menu['created_at'] = date('Y-m-d H:i:s');
                    // die();
                    if ($this->db->insert('menus', $menu)) {
                        // mkdir();
                        $stored = true;
                        $stored_menu += 1;
                    }
                }

                if ($stored && $stored_menu == count($acct_types)) {
                    // die('We are done here');
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You created a new Menu at " . date('Y-m-d H:i:s');
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Menu Created Succesfully', 'redirect' => site_url('/admin/settings/menus')]);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'An Error Occurred']);
                }
            }
        } else if ($param1 == 'menus' && $param2 == 'update') {
            $this->form_validation->set_rules('name', 'Menu Name', 'trim|required');
            $this->form_validation->set_rules('id', 'Menu Name', 'trim|required');
            $this->form_validation->set_rules('fafa', 'Menu Icon', 'trim|required');
            $this->form_validation->set_rules('url', 'Menu URL', 'trim|required');
            $this->form_validation->set_rules('acct_type', 'Allowed User', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => 0, 'msg' => validation_errors()]);
            } else {
                $menu = $this->input->post();
                $menu['created_at'] = date('Y-m-d H:i:s');
                if ($this->db->where('id', $menu['id'])->update('menus', $menu)) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You updated a Menu with name " . $menu['name'] . " at " . date('Y-m-d H:i:s');
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Menu Updated Succesfully', 'redirect' => site_url('/admin/settings/menus')]);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'Unable to create Menu']);
                }
            }
        } else if ($param1 == 'submenu' && $param2 == 'store') {
            if (!$this->isOnline()) {
                $this->session->set_tempdata('rfrom', current_url());
                if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
            }
            if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));

            $this->form_validation->set_rules('name', 'Menu Name', 'trim|required');
            $this->form_validation->set_rules('menu_id', 'Menu Icon', 'trim|required');
            $this->form_validation->set_rules('url', 'Menu URL', 'trim|required');
            // $this->form_validation->set_rules('acct_type', 'Allowed User', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => 0, 'msg' => validation_errors()]);
            } else {
                $menu = $this->input->post();

                $mainmenu = $this->db->get_where('menus', ['id' => $menu['menu_id']])->row();

                $main = str_replace(['/all', 'index'], '', $mainmenu->url);
                $urlstring = explode('/', $mainmenu->url);

                $view_folder = ($urlstring[1]);
                $controller_folder = ($urlstring[0]);

                $view = VIEWPATH . $controller_folder . '/' . $view_folder . '/';

                if (!is_dir($view)) {
                    mkdir($view);
                }
                $submenu = explode(',', $menu['name']);
                $subnames = explode(',', $menu['name']);
                $menu['created_at'] = date('Y-m-d H:i:s');
                $stored_item = 0;
                $stored = false;

                foreach ($submenu as $index => $subs) {
                    $n = str_replace([' ', '.', '-'], ['_', '', '_'], trim(strtolower($subnames[$index])));
                    $menu['url'] = $main . '/' . $n;
                    $menu['name'] = ucfirst(trim($subnames[$index]));
                    if ($this->db->insert('submenu', $menu)) {
                        if (!file_exists($view . $n . '.php')) {
                            fopen($view . $n . '.php', 'a');
                        }

                        $stored_item += 1;
                    }
                    if ($stored_item == count($submenu)) {
                        $stored = true;
                    }
                }

                if ($stored) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You created a new Sub Menu at " . date('Y-m-d H:i:s');
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Sub Menu Created Successfully', 'redirect' => site_url('/admin/settings/menus')]);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'Unable to create sub menu']);
                }
            }
        } else if ($param1 == 'submenu' && $param2 == 'update') {
            if (!$this->isOnline()) {
                $this->session->set_tempdata('rfrom', current_url());
                if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
            }
            if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));
            $this->form_validation->set_rules('name', 'Menu Name', 'trim|required');
            $this->form_validation->set_rules('id', 'Sub Menu Id', 'trim|required');
            $this->form_validation->set_rules('menu_id', 'Parent Menu', 'trim|required');
            $this->form_validation->set_rules('url', 'Menu URL', 'trim|required');
            // $this->form_validation->set_rules('acct_type', 'Allowed User', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => 0, 'msg' => validation_errors()]);
            } else {
                $menu = $this->input->post();
                $menu['created_at'] = date('Y-m-d H:i:s');
                if ($this->db->where('id', $menu['id'])->update('submenu', $menu)) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You updated a Sub Menu name:" . $menu['name'] . " at " . date('Y-m-d H:i:s');
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Sub Menu Updated Succesfully', 'redirect' => site_url('/admin/settings/menus')]);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'Unable to Update sub menu']);
                }
            }
        } else if ($param1 == 'menus' && $param2 == 'delete') {
            $menu = $this->db->get_where('menus', ['id', $param3])->row_array();
            if ($this->db->where('id', $param3)->delete('menus')  && $this->db->where('menu_id', $param3)->delete('submenu')) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You updated a Menu name:" . $menu['name'] . " at " . date('Y-m-d H:i:s');
                $this->ActivityModel->createLog($log);
                // redirect(site_url('/admin/settings/menus'));
                echo json_encode(['status' => 1, 'msg' => 'Menu Deleted Successfully']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An Error Occurred! Please try again']);
            }
        } else if ($param1 == 'submenu' && $param2 == 'delete') {
            $menu = $this->db->get_where('submenu', ['id' => $param3])->row_array();
            if ($this->db->where('id', $param3)->delete('submenu')) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You updated a Sub Menu name:" . $menu['name'] . " at " . date('Y-m-d H:i:s');
                $this->ActivityModel->createLog($log);
                // redirect(site_url('/admin/settings/menus'));
                echo json_encode(['status' => 1, 'msg' => 'Sub Menu Deleted Successfully']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An Error Occurred']);
            }
        } else if ($param1 == 'header_menu' && $param2 == null) {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['header_menu'] = $this->db->get_where('header_menu', ['parent_id' => 0])->result();
            $data['page_title'] = " | Admin | Menu | All Menu";
            // $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/header_menu/all', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'header_menu' && $param2 == 'store') {
            $headerMenuData = $this->input->post();
            foreach ($headerMenuData as $key => $data) {
                if ($data != 0 && empty($data) || strlen($data) == 0) {
                    echo json_encode(['status' => 0, 'msg' => str_replace(['_'], [' '], ucwords($data)) . 'is required!', 'redirect' => 'noreload']);
                    exit();
                }
            }
            if ($this->db->insert('header_menu', $headerMenuData)) {
                echo json_encode(['status' => 1, 'msg' => 'Header Menu Created Successfully!', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred!', 'redirect' => 'reload']);
            }
        } else if ($param1 == 'header_menu' && $param2 == 'edit' && $param3 != null) {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['men'] = $this->db->where('id', $param3)->get('header_menu')->row();
            $data['page_title'] = " | Admin | Menu | " . $data['men']->name;

            // echo var_dump($data['menu']);
            // $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/header_menu/edit', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'header_menu' && $param2 == 'update') {
            $headerMenuData = $this->input->post();
            foreach ($headerMenuData as $key => $data) {
                if ($data != 0 && empty($data) || strlen($data) == 0) {
                    echo json_encode(['status' => 0, 'msg' => str_replace(['_'], [' '], ucwords($data)) . ' is required!', 'redirect' => 'noreload']);
                    exit();
                }
            }
            if ($this->db->where('id', $headerMenuData['id'])->update('header_menu', $headerMenuData)) {
                echo json_encode(['status' => 1, 'msg' => 'Header Menu Updated Successfully!', 'redirect' => site_url('admin/settings/header_menu')]);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred!', 'redirect' => 'reload']);
            }
        } else if ($param1 == 'header_menu' && $param2 == 'delete') {
            if ($this->db->where('id', $param3)->or_where(['parent_id' => $param3])->delete('header_menu')) {
                echo json_encode(['status' => 1, 'msg' => 'Header Menu Deleted Successfully!', 'redirect' => site_url('admin/settings/header_menu')]);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred!', 'redirect' => 'reload']);
            }
        } else if ($param1 == 'header_menu' && $param2 == 'view') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['men'] = $this->db->where('id', $param3)->get('header_menu')->row();
            $data['page_title'] = " | Admin | Header Menu | " . $data['men']->name;

            // echo var_dump($data['menu']);
            // $data['products'] = $this->ProductModel->getAllProducts();
            if ($data['men']) {
                $this->load->view('layouts/admin/head', $data);
                $this->load->view('layouts/admin/top_nav', $data);
                $this->load->view('admin/settings/header_menu/view', $data);
                $this->load->view('layouts/admin/foot', $data);
            } else {
                redirect(site_url('admin/settings/header_menu'));
            }
        } else if ($param1 == 'shipping_location' && $param2 == null) {
            $data['shipping_locations'] = $this->db->get('shipping_location')->result();
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Shipping Location";
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/shipping_location/all.php', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'shipping_location' && $param2 == 'create') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Shipping Location | New";
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/shipping_location/create.php', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'shipping_location' && $param2 == 'store') {
            $shippingData = $this->input->post();
            $shippingData['loc_id'] = "PSSSHLOC" . random_string('nozero', 5);
            // unset()
            foreach ($shippingData as $key => $data) {
                if ($data != 0 && empty($data) || strlen($data) == 0) {
                    echo json_encode(['status' => 0, 'msg' => str_replace(['_'], [' '], ucwords($data)) . 'is required!', 'redirect' => 'noreload']);
                    exit();
                }
            }
            if ($this->db->insert('shipping_location', $shippingData) && $this->db->insert('shipping_fee', ['loc_id' => $shippingData['loc_id']])) {
                echo json_encode(['status' => 1, 'msg' => 'Shipping Location Created Successfully!', 'redirect' => site_url('admin/settings/shipping_location')]);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred!', 'redirect' => 'reload']);
            }
        } else if ($param1 == 'shipping_location' && $param2 == 'delete') {
            if ($this->db->where('id', $param3)->delete('shipping_location')) {
                echo json_encode(['status' => 1, 'msg' => 'Shipping Location Deleted Successfully', 'reload' => 'noreload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred', 'reload' => 'noreload']);
            }
        } else if ($param1 == 'shipping_location' && $param2 == 'edit') {
            $data['shipping_location'] = $this->db->get_where('shipping_location', ['id' => $param3])->row();
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Shipping Location | Edit";
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/shipping_location/edit.php', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'shipping_location' && $param2 == 'update') {
            $shippingData = $this->input->post();
            foreach ($shippingData as $key => $data) {
                if ($data != 0 && empty($data) || strlen($data) == 0) {
                    echo json_encode(['status' => 0, 'msg' => str_replace(['_'], [' '], ucwords($data)) . 'is required!', 'redirect' => 'noreload']);
                    exit();
                }
            }
            if ($this->db->where('id', $param3)->update('shipping_location', $shippingData)) {
                echo json_encode(['status' => 1, 'msg' => 'Shipping Location Data Updated Successfully', 'redirect' => site_url('admin/settings/shipping_location')]);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred! Please try again', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'shipping_fee' && $param2 == null) {
            $data['shipping_fees'] = $this->db->get('shipping_fee')->result();
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Shipping Location";
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/shipping_fee/index.php', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'shipping_fee' && $param2 == 'update' && $param3 != null && $param4 != null) {
            // var_dump($this->input->post());
            $val = $this->input->post('val');
            $id = $param4;
            $col = $param3;
            if ($this->db->where(['id' => $id])->update('shipping_fee', ["$col" => $val])) {
                echo "Done Updating $col";
            } else {
                echo "An Error Occurred";
            }
        }
    }

    public function page($param1 = 'all', $param2 = null)
    {
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type' => 'admin', 'active' => 1])->result();
        if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));
        $data['scripts'] = ['main.js', 'forms.js'];

        if ($param1 == 'all') {
            $data['page_title'] = " All Pages";
            $data['pages'] = $this->db->get('pages')->result();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/pages/all', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'create') {
            $data['page_title'] = " Create Pages";
            // $data['pages'] = $this->db->get('pages')->result();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/pages/create', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'store') {
            $pageData = $this->input->post();
            foreach ($pageData as $key => $data) {
                if ($data != 0 && (empty($data) || strlen($data) == 0)) {
                    echo json_encode(['status' => 0, 'msg' => ucwords(str_replace(['_'], [' '], $data)) . " is required", 'redirect' => 'noreload']);
                    exit();
                }
            }
            if ($this->db->get_where('pages', ['name' => $pageData['name']])->row()) {
                echo json_encode(['status' => 0, 'msg' => "A " . $pageData['name'] . " page already exist!", 'redirect' => 'noreload']);
            } else {
                $pageData['url'] = site_url('p/');
                if ($this->db->insert('pages', $pageData)) {
                    echo json_encode(['status' => 1, 'msg' => "Page Created Successfully", 'redirect' => 'reload']);
                } else {
                    echo json_encode(['status' => 0, 'msg' => "An error occurred", 'redirect' => 'noreload']);
                }
            }
        } else if ($param1 == 'edit' && $param2 != null) {
            $data['page_title'] = " Edit Pages";
            $data['page'] = $this->db->get_where('pages', ['id' => $param2])->row();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/pages/edit', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'update') {
            $pageData = $this->input->post();
            foreach ($pageData as $key => $data) {
                if ($data != 0 && (empty($data) || strlen($data) == 0)) {
                    echo json_encode(['status' => 0, 'msg' => ucwords(str_replace(['_'], [' '], $data)) . " is required", 'redirect' => 'noreload']);
                    exit();
                }
            }
            if ($this->db->where('id', $pageData['id'])->update('pages', $pageData)) {
                echo json_encode(['status' => 1, 'msg' => "Page Updated Successfully", 'redirect' => site_url('admin/page')]);
            } else {
                echo json_encode(['status' => 0, 'msg' => "An error occurred", 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'delete' && $param2 != null) {
            if ($this->db->where('id', $param2)->delete('pages')) {
                echo json_encode(['status' => 1, 'msg' => "Page Created Successfully", 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => "An error occurred", 'redirect' => 'noreload']);
            }
        }
    }

    public function log($param1 = 'all', $param2 = null)
    {
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type' => 'admin', 'active' => 1])->result();
        if ($param1 == 'all') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['logs'] = $this->ActivityModel->getAllLogs();
            $data['page_title'] = " | Admin | Activity Log | All Logs";
            $data['pt'] = "All Activity Logs";
            // $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/activity/all', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'mylogs') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['logs'] = $this->ActivityModel->getLogsBy('owner_id', $this->session->userdata('user')->user_id);
            $data['page_title'] = " | Admin | Activity Log | My Logs";
            $data['pt'] = "My Logs";
            // $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/activity/all', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'view') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['logs'] = $this->ActivityModel->getLogsBy('owner_id', $param2);
            $data['page_title'] = " | Admin | Activity Log | All Logs";
            $data['pt'] = $this->UserModel->getUserBy('user_id', $param2)['full_name'] . "'s Activity";
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/activity/all', $data);
            $this->load->view('layouts/admin/foot', $data);
        }
    }

    public function profile($param1 = 'view_profile', $param2 = 'users')
    {
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type' => 'admin', 'active' => 1])->result();
        if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));

        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type' => 'admin', 'active' => 1])->result();

        if ($param1 == 'view_profile') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Profile | My Profile";
            $data['profile'] = $this->session->userdata('user');
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/profile/view_profile', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'edit_profile') {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Profile | My Profile";
            $data['profile'] = $this->session->userdata('user');
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/profile/edit_profile', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'update') {
            $dddd = $this->input->post();

            $tocheck = ($param2 == 'users' || $param2 == 'contacts') ? 'user_id' : 'seller_id';
            if (!$this->db->get_where($param2, [$tocheck => $this->session->userdata('user')->user_id])->row()) {
                $this->db->insert($param2, [$tocheck => $this->session->userdata('user')->user_id]);
            }
            // echo json_encode($tocheck); die();
            $update = $this->db->where($tocheck, $this->session->userdata('user')->user_id)->update($param2, $dddd);
            if ($update) {
                $loggedinas = $this->session->userdata('user')->loggedinas;
                $this->session->set_userdata('user', $this->db->get_where('users', ['user_id' => $this->session->userdata('user')->user_id])->row());
                $this->session->userdata('user')->loggedinas = $loggedinas;
                echo json_encode(['status' => 1, 'msg' => 'Account Updated Successfully', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred! Please try again later']);
            }
        }
    }


    public function order($param1 = 'pending_orders', $param2 = null, $param3 = null) {

        if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));

        $data['scripts'] = ['main.js', 'forms.js'];
        $data['menus'] = $this->db->where(['acct_type' => 'admin', 'active' => 1])->get('menus')->result();

        if ($param1 == 'all_orders') {
            $data['page_title'] = " | Admin | Order | All Orders";
            $data['orders'] = $this->OrderModel->get()->collections;
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/orders/all_orders', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'sort') {
            // echo $param2. "->".$param3;
            $order = $this->OrderModel->findOrFail($param2)->collection;

            $cartcontent = unserialize($order->order_detail);

            $cartcontentitem = $cartcontent[$param3];
            $productData = $this->db->get_where('products', ['product_id' => $cartcontent[$param3]['options']['product_id']])->row();
            $category = $this->db->get_where('category', ['id' => $productData->category_id])->row();

            // Calculating commission and earning

            /*$sellerorder = new SellerOrderModel();
				$sellerorder->seller_id = $cartcontent[$param3]['options']['seller_id'];
				$sellerorder->buyer_id = $order->buyer_id;
				$sellerorder->order_id = $order->order_id;
				$sellerorder->status = 'pending';
				$sellerorder->msg = 'This order will be attended to very soon';
				$sellerorder->ordered_product_name = $cartcontent[$param3]['name'].' '.$cartcontent[$param3]['options']['product_id'];
				$sellerorder->ordered_product_price = $cartcontent[$param3]['price'];
				$sellerorder->ordered_product_qty = $cartcontent[$param3]['qty'];
				$sellerorder->other_options = $cartcontent[$param3]['options']['other_options'];
				$so = (array) $sellerorder;
				if($this->SellerOrderModel->initialize($so)->save()){
					// // Update The Order Content
					$cartcontent[$param3]['options']['sorted'] = true;

					$order->order_detail = serialize($cartcontent);
					$order->status = 'processing';
					$order->msg = 'we are processing your order';
					// var_dump($order);
					$norder = (array) $order;
					// var_dump($norder);
					$this->OrderModel->update($norder['order_id'], $norder);
					echo json_encode(['status'=>1, 'msg'=>'Order sorted successfully', 'redirect'=>'reload']);
				}else{
					// echo "Oops an error occurred!";
					echo json_encode(['status'=>0, 'msg'=>'An error occurred, please try again later']);
				}*/
        } else if ($param1 == 'view_order') {
            $data['order'] = $this->OrderModel->findOrFail($param2)->collection;
            $data['sorted_orders'] = $this->SellerOrderModel->findManyBy('order_id', $data['order']->order_id)->collections;
            $data['page_title'] = " | Admin | Order | All Orders";
            // $data['orders'] = $this->OrderModel->get()->collections;
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/orders/view_order', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'reorder') {
            $order_id = $param2;
            $response = null;
            $msg = $this->SomeDBFunctions->getOrderStatusMessage('active');
            if ($this->db->where('order_id', $order_id)->update('orders', ['status' => 'active', 'msg' => $msg])) {
                if (!$response) {
                    $response['status'] = 1;
                    $response['msg'] = 'Order have been re-ordered Successfully';
                    $response['redirect'] = 'reload';
                }
            } else {
                if (!$response) {
                    $response['status'] = 1;
                    $response['msg'] = 'An error occurred! Please try again later';
                    $response['redirect'] = 'noreload';
                }
            }
            echo json_encode($response);
        } else if ($param1 == 'delete') {
            $order_id = $param2;
            $response = null;
            $msg = $this->SomeDBFunctions->getOrderStatusMessage('active');
            if ($this->db->where('order_id', $order_id)->delete('orders')) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You deleted an order OrderId: " . $order_id . " at " . $this->format_date(date('Y-m-d H:i:s'));
                $this->ActivityModel->createLog($log);
                if (!$response) {
                    $response['status'] = 1;
                    $response['msg'] = 'Order deleted Successfully';
                    $response['redirect'] = 'reload';
                }
            } else {
                if (!$response) {
                    $response['status'] = 1;
                    $response['msg'] = 'An error occurred! Please try again later';
                    $response['redirect'] = 'noreload';
                }
            }
            echo json_encode($response);
        } else if ($param1 === 'update' && $param2 === 'status') {
            // echo json_encode($this->input->post()); exit();
            // $_POST['status'] = $param4;
            $status = array();
            $order = $this->SellerOrderModel->findOrFail($param3)->collection;
            $order->status = $this->input->post('status');
            $order->msg = $this->SomeDBFunctions->getOrderStatusMessage($this->input->post('status'));
            // echo json_encode((array)$order); exit();
            if ($this->SellerOrderModel->update($param3, (array) $order)) {
                $other_orders = $this->SellerOrderModel->findManyBy('order_id', $order->order_id)->collections;
                $ready_order = 0;
                foreach ($other_orders as $other_order) {
                    if ($other_order->status === 'ready') {
                        $ready_order += 1;
                    }
                }
                if ($ready_order == count($other_orders)) {
                    $main_order = $this->OrderModel->findOrFail($order->order_id)->collection;
                    $main_order->status = 'active';
                    $main_order->msg = $this->SomeDBFunctions->getOrderStatusMessage($main_order->status);
                    if ($this->OrderModel->update($order->order_id, (array) $main_order)) {
                        $status['status'] = 1;
                        $status['msg'] = 'Order Status Have Been Changed to ' . $order->status;
                        $status['redirect'] = 'reload';
                    } else {
                        $status['status'] = 0;
                        $status['msg'] = 'Sorry an error occured';
                    }
                } else {
                    $main_order = $this->OrderModel->findOrFail($order->order_id)->collection;
                    $main_order->status = 'processing';
                    $main_order->msg = $this->SomeDBFunctions->getOrderStatusMessage($main_order->status);
                    $this->OrderModel->update($order->order_id, (array) $main_order);
                    $status['status'] = 1;
                    $status['msg'] = 'Order Status Have Been Changed to ' . $order->status;
                    $status['redirect'] = 'reload';
                }
            }
            echo json_encode($status);
        } else if ($param1 == 'update_order' && $param2 == 'status') {
            $status = $this->input->post('status');
            $msg = $this->SomeDBFunctions->getOrderStatusMessage($status);
            if ($this->db->where('order_id', $param3)->update('orders', ['status' => $status, 'msg' => $msg])) {
                echo json_encode(['status' => 1, 'msg' => 'Order Status Have Been Changed', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred! Please try again later', 'redirect' => 'reload']);
            }
        } else if ($param1 == 'decline' && $param2 != null) {
            $this->load->model('MailSender');
            $orderData = $this->db->get_where('orders', ['order_id' => $param2])->row();
            //$data = $this->input->post();
            $data = array();
            $data['status'] = 7;
            if ($this->db->where(['order_id' => $param2])->update('orders', $data)) {
                $userData = $this->db->get_where('users', ['user_id' => $orderData->buyer_id])->row();
                $to['email'] = $userData->email;
                $to['name'] = $userData->full_name;
                $msg['subject'] = 'Order Decline';
                $msg['message'] = "<h4>Dear " . $userData->full_name . "</h4>";
                $msg['message'] .= "Your order with id: $param2 have been declined by the Admin. click <a href='" . site_url('buyer/orders/my_orders') . "'>here</a> to view details";
                if ($this->MailSender->send_mail($to, $msg, 'html')) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You declined an order OrderId: " . $param2 . " at " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Order declined successfully!', 'redirect' => site_url('admin/order/all_orders')]);
                } else {
                    $this->db->where(['order_id' => $param2])->update('orders', $orderData->status);
                    echo json_encode(['status' => 0, 'msg' => 'Unable to decline order!', 'redirect' => 'noreload']);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Unable to decline order!', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'cancel' && $param2 != null) {
            $this->load->model('MailSender');
            $orderData = $this->db->get_where(['order_id' => $param2])->row();
            $data = $this->input->post();
            $data['status'] = 8;
            if ($this->db->where(['order_id' => $param2])->update('orders', $data)) {
                $userData = $this->db->get_where('users', ['user_id' => $orderData->buyer_id])->row();
                $to['email'] = $userData->email;
                $to['name'] = $userData->full_name;
                $msg['subject'] = 'Order Decline';
                $msg['message'] = "<h4>Dear " . $userData['name'] . "</h4>";
                $msg['message'] .= "Your order with id: $param2 have been canceled by the Admin. click <a href='" . site_url('buyer/orders/my_orders') . "'>here</a> know why";
                if ($this->MailSender->send_mail($to, $msg, 'html')) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You canceled an order OrderId: " . $param2 . " at " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Order canceled successfully!', 'redirect' => site_url('admin/order/all_orders')]);
                } else {
                    $this->db->where(['order_id' => $param2])->update('orders', $orderData->status);
                    echo json_encode(['status' => 0, 'msg' => 'Unable to canceled order!', 'redirect' => 'noreload']);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Unable to canceled order!', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'approve' && $param2 != null) {
            $this->load->model('MailSender');
            $orderData = $this->db->get_where('orders', ['order_id' => $param2])->row();
            $data = $this->input->post();
            $data['status'] = 3;
            if ($this->db->where(['order_id' => $param2])->update('orders', $data)) {
                $userData = $this->db->get_where('users', ['user_id' => $orderData->buyer_id])->row();
                $to['email'] = $userData->email;
                $to['name'] = $userData->full_name;
                $msg['subject'] = 'Order Approved';
                $msg['message'] = "<h4>Dear " . $userData->full_name . "</h4>";
                $msg['message'] .= "Your order with id: $param2 have been approved by the Admin. click <a href='" . site_url('buyer/orders/my_orders') . "'>here</a> to view";
                if ($this->MailSender->send_mail($to, $msg, 'html')) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You approved an order OrderId: " . $param2 . " at " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1, 'msg' => 'Order approved successfully!', 'redirect' => site_url('admin/order/all_orders')]);
                } else {
                    $this->db->where(['order_id' => $param2])->update('orders', $orderData->status);
                    echo json_encode(['status' => 0, 'msg' => 'Unable to approve order!', 'redirect' => 'noreload']);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Unable to approve order!', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'pending_orders' && $param2 == null) {
            $data['page_title'] = " | Admin | Order | Pending Orders";
            $data['orders'] = $this->db->where('status', 1)->or_where('status', 3)->or_where('status', 4)->get('orders')->result();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/orders/all_orders', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'pending_cooperate' && $param2 == null) {
            $data['page_title'] = " | Admin | Order | Pending Orders";
            $data['orders'] = $this->db->where('status', 2)->get('orders')->result();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/orders/all_orders', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'active_orders' && $param2 == null) {
            $data['page_title'] = " | Admin | Order | Active Orders";
            $data['orders'] = $this->db->get_where('orders', ['status' => 0])->result();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/orders/all_orders', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'closed_orders' && $param2 == null) {
            $data['page_title'] = " | Admin | Order | Closed Orders";
            $data['orders'] = $this->db->get_where('orders', ['status' => 0])->result();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/orders/all_orders', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'canceled_orders' && $param2 == null) {
            $data['page_title'] = " | Admin | Order | Closed Orders";
            $data['orders'] = $this->db->where('status', 5)->or_where('status', 6)->get('orders')->result();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/orders/all_orders', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'mark_delivered') {
            $order_ids = $this->input->post('order_ids');
            // var_dump($order_ids); exit();
            if (count($order_ids) == 0) {
                echo json_encode(['status' => 0, 'msg' => 'You must select at least one order!', 'redirect' => 'noreload']);
            } else {
                $done = false;
                foreach ($order_ids as $key => $value) {
                    if ($this->db->where(['order_id' => $value])->update('orders', ['status' => 7])) {
                        $done = true;
                    } else {
                        $done = false;
                    }
                }
                if ($done) {
                    echo json_encode(['status' => 1, 'msg' => 'Orders marked as delivered!', 'redirect' => 'reload']);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'An error occured!', 'redirect' => 'noreload']);
                }
            }            
        }
    }


    public function transaction($param1 = 'transactions', $param2 = null, $param3 = null) {
        if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));
        $data['scripts'] = ['main.js', 'forms.js'];
        $data['menus'] = $this->db->where(['acct_type' => 'admin', 'active' => 1])->get('menus')->result();
        if ($param1 == 'transactions') {
        } else if ($param1 == 'revenue') {
        } else if ($param1 == 'withdrawal' && $param2 == null) {
            // $data['order'] = $this->OrderModel->findOrFail($param2)->collection;
            $data['withdrawals'] = $this->db->get('withdrawal')->result();
            $data['page_title'] = " | Admin | Transaction | Withdrawals";
            // $data['orders'] = $this->OrderModel->get()->collections;
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/transaction/withdrawal', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'withdrawal' && $param2 == 'approve') {
            if ($this->db->where('id', $param3)->update('withdrawal', ['status' => 'approved'])) {
                echo json_encode(['status' => 1, 'msg' => 'Withdrawal approved successfully', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred! Pplease try again later', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'withdrawal' && $param2 == 'complete') {
            if ($this->db->where('id', $param3)->update('withdrawal', ['status' => 'approved'])) {
                echo json_encode(['status' => 1, 'msg' => 'Withdrawal approved successfully', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An error occurred! Pplease try again later', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'withdrawal' && $param2 == 'view') {
        }
    }


    public function cooperatives($param1 = 'cooperatives', $param2 = null, $param3 = null) {
        if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));
        $data['scripts'] = ['main.js', 'forms.js'];
        $this->load->model('MailSender');
        $data['menus'] = $this->db->order_by('position', 'ASC')->where(['acct_type' => 'admin', 'active' => 1])->get('menus')->result();
        if ($param1 == 'cooperatives' && $param2 == null && $param3 == null) {
            $data['cooperatives'] = $this->db->get('cooperatives')->result();
            $data['page_title'] = " | Admin | Cooperatives";
            // $data['orders'] = $this->OrderModel->get()->collections;
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/cooperatives/cooperatives', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'create' && $param2 == null && $param3 == null) {
            // $data['cooperatives'] = $this->db->get('cooperatives')->result();
            $data['page_title'] = " | Admin | Cooperatives | Create";
            // $data['orders'] = $this->OrderModel->get()->collections;
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/cooperatives/create', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'store' && $param2 == null && $param3 == null) {
            $cooperativeData = $this->input->post();
            if (!$this->db->get_where('cooperatives', ['name' => $cooperativeData['name']])->row()) {
                $cooperativeData['cooperative_id'] = "PSSCOP" . random_string('nozero', 5);
                $cooperativeData['token'] = random_string('alnum', 32);

                $loginData['email'] = $cooperativeData['email'];
                $loginData['user_id'] = $cooperativeData['cooperative_id'];
                $loginData['password'] = password_hash($cooperativeData['password'], PASSWORD_DEFAULT);
                // $password = $loginData['password'];
                $loginData['acct_type'] = 'cooperative';
                unset($cooperativeData['password']);
                if ($this->db->insert('cooperatives', $cooperativeData) && $this->db->insert('admins', $loginData)) {
                    $to['email'] = $cooperativeData['email'];
                    $to['name'] = $cooperativeData['name'];
                    $msg['subject'] = "Account Creation";
                    $msg['message'] = "<p>An account have been created for you! click <a href='" . site_url('cooperative/login') . "'>here</a> to login. <br/>Login with: <br/>email: " . $cooperativeData['email'] . " <br/>password: default. </p>";
                    if ($this->MailSender->send_mail($to, $msg, 'html')) {
                        $log['owner_id'] = $this->session->userdata('user')->user_id;
                        $log['action'] = "You created a new Cooperative account with the following information<br/>.";
                        $log['action'] .= " CooperativeId: " . $cooperativeData['cooperative_id'] . '<br/>';
                        $log['action'] .= " Name: " . $cooperativeData['name'] . '<br/>';
                        $log['action'] .= " Email: " . $cooperativeData['email'] . '<br/>';
                        $log['action'] .= " at " . $this->format_date(date('Y-m-d H:i:s'));
                        $this->ActivityModel->createLog($log);
                    }
                    echo json_encode(['status' => 1,  'msg' => 'Cooperative added successfully!', 'redirect' => site_url('admin/cooperatives/cooperatives')]);
                } else {
                    echo json_encode(['status' => 0,  'msg' => 'An Errorr Occurred! Please Try Again', 'redirect' => 'noreload']);
                }
            } else {
                echo json_encode(['status' => 0,  'msg' => 'Cooperative already exist', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'edit' && $param2 != null && $param3 == null) {
            $data['page_title'] = " | Admin | Cooperatives | Edit";
            $data['cooperative'] = $this->db->get_where('cooperatives', ['cooperative_id' => $param2])->row();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/cooperatives/edit', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'update' && $param2 == null && $param3 == null) {
            $cooperativeData = $this->input->post();
            $cooperative_id = $cooperativeData['cooperative_id'];
            $adminData['email'] = $cooperativeData['email'];
            $adminData['password'] = ($cooperativeData['password'] == '') ? null : password_hash($cooperativeData['password'], PASSWORD_DEFAULT);
            // $adminData['email'] = $cooperativeData['email'];
            unset($cooperativeData['password']);
            if ($this->db->where(['cooperative_id' => $cooperative_id])->update('cooperatives', $cooperativeData) && $this->db->where(['user_id' => $cooperative_id])->update('admins', $adminData)) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You updated a Cooperative account with the following information<br/>.";
                $log['action'] .= " CooperativeId: " . $cooperativeData['cooperative_id'] . '<br/>';
                $log['action'] .= " Name: " . $cooperativeData['name'] . '<br/>';
                $log['action'] .= " Email: " . $cooperativeData['email'] . '<br/>';
                $log['action'] .= " at " . $this->format_date(date('Y-m-d H:i:s'));
                $this->ActivityModel->createLog($log);
                echo json_encode(['status' => 1,  'msg' => 'Cooperative updated successfully!', 'redirect' => site_url('admin/cooperatives/cooperatives')]);
            } else {
                echo json_encode(['status' => 0,  'msg' => 'An Errorr Occurred! Please Try Again', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'delete' && $param2 != null) {
            $cooperative = $this->fdb->get_where('cooperatives', ['cooperative_id' => $param2])->row_array();
            if ($cooperative) {
                if ($this->db->where(['cooperative_id' => $param2])->delete('cooperatives') && $this->db->where(['user_id' => $param2])->delete('admins')) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You deleted a Cooperative account with the following information<br/>.";
                    $log['action'] .= " CooperativeId: " . $cooperative['cooperative_id'] . '<br/>';
                    $log['action'] .= " Name: " . $cooperative['name'] . '<br/>';
                    $log['action'] .= " Email: " . $cooperative['email'] . '<br/>';
                    $log['action'] .= " at " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1,  'msg' => 'Cooperative deleted successfully!', 'redirect' => site_url('admin/cooperatives/cooperatives')]);
                } else {
                    echo json_encode(['status' => 0,  'msg' => 'An Errorr Occurred! Please Try Again', 'redirect' => 'noreload']);
                }
            }
        } else if ($param1 == 'view' && $param2 != null) {
            $data['page_title'] = " | Admin | Cooperatives | Edit";
            $data['cooperative'] = $this->db->get_where('cooperatives', ['cooperative_id' => $param2])->row();
            $data['cooperativeMembers'] = $this->db->get_where('cooperative_member', ['cooperative_id' => $param2])->result();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/cooperatives/view', $data);
            $this->load->view('layouts/admin/foot', $data);
        } else if ($param1 == 'approve' && $param2 != null) {
            if ($this->db->where(['cooperative_id' => $param2])->update('cooperatives', ['active' => 1])) {
                $cooperativeData = $this->db->get_where('cooperatives', ['cooperative_id' => $param2])->row_array();
                $to['email'] = $cooperativeData['email'];
                $to['name'] = $cooperativeData['name'];
                $msg['subject'] = "Account Approval";
                $msg['message'] = "<p>Your Cooperative Account have been approved! click <a href='" . site_url('cooperative/login') . "'>here</a> to login. <br/>Login with: <br/>email: " . $cooperativeData['email'] . " <br/>password: default. </p>";
                if ($this->MailSender->send_mail($to, $msg, 'html')) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You approved a Cooperative account with the following information<br/>.";
                    $log['action'] .= " CooperativeId: " . $cooperativeData['cooperative_id'] . '<br/>';
                    $log['action'] .= " Name: " . $cooperativeData['name'] . '<br/>';
                    $log['action'] .= " Email: " . $cooperativeData['email'] . '<br/>';
                    $log['action'] .= " at " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1,  'msg' => 'Cooperative Activated successfully!', 'redirect' => site_url('admin/cooperatives/cooperatives')]);
                }
            } else {
                echo json_encode(['status' => 0,  'msg' => 'An Errorr Occurred! Please Try Again', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'activate' && $param2 != null) {
            if ($this->db->where(['cooperative_id' => $param2])->update('cooperatives', ['active' => 1])) {
                $cooperativeData = $this->db->get_where('cooperatives', ['cooperative_id' => $param2])->row_array();

                $to['email'] = $cooperativeData['email'];
                $to['name'] = $cooperativeData['name'];
                $msg['subject'] = "Account Re-Activation";
                $msg['message'] = "<p>Your Cooperative Account have been reactivated! click <a href='" . site_url('cooperative/login') . "'>here</a> to login. <br/>Login with: <br/>email: " . $cooperativeData['email'] . " <br/>password: default. </p>";
                if ($this->MailSender->send_mail($to, $msg, 'html')) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You reactivated a Cooperative account with the following information<br/>.";
                    $log['action'] .= " CooperativeId: " . $cooperativeData['cooperative_id'] . '<br/>';
                    $log['action'] .= " Name: " . $cooperativeData['name'] . '<br/>';
                    $log['action'] .= " Email: " . $cooperativeData['email'] . '<br/>';
                    $log['action'] .= " at " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                    echo json_encode(['status' => 1,  'msg' => 'Cooperative Activated successfully!', 'redirect' => site_url('admin/cooperatives/cooperatives')]);
                }
            } else {
                echo json_encode(['status' => 0,  'msg' => 'An Errorr Occurred! Please Try Again', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'deactivate' && $param2 != null) {
            if ($this->db->where(['cooperative_id' => $param2])->update('cooperatives', ['active' => 2])) {
                $cooperativeData = $this->db->get_where('cooperatives', ['cooperative_id' => $param2])->row_array();

                $to['email'] = $cooperativeData['email'];
                $to['name'] = $cooperativeData['name'];
                $msg['subject'] = "Account Deactivation";
                $msg['message'] = "<p>Your Cooperative account have been deactivated!</p>";
                if ($this->MailSender->send_mail($to, $msg, 'html')) {
                    $log['owner_id'] = $this->session->userdata('user')->user_id;
                    $log['action'] = "You deactivated a Cooperative account with the following information<br/>.";
                    $log['action'] .= " CooperativeId: " . $cooperativeData['cooperative_id'] . '<br/>';
                    $log['action'] .= " Name: " . $cooperativeData['name'] . '<br/>';
                    $log['action'] .= " Email: " . $cooperativeData['email'] . '<br/>';
                    $log['action'] .= " at " . $this->format_date(date('Y-m-d H:i:s'));
                    $this->ActivityModel->createLog($log);
                }
                echo json_encode(['status' => 1,  'msg' => 'Cooperative Suspended successfully!', 'redirect' => site_url('admin/cooperatives/cooperatives')]);
            } else {
                echo json_encode(['status' => 0,  'msg' => 'An Errorr Occurred! Please Try Again', 'redirect' => 'noreload']);
            }
        }
    }
	public function coupons($param1 = 'all_coupon', $param2 = null) {
		if (!$this->isOnline()) {
            $this->session->set_tempdata('rfrom', current_url());
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 0, 'msg' => 'Please Login To Continue', 'redirect' => site_url('/admin/login')]);
                exit();
            } else {
                redirect(site_url('/admin/login'));
            }
        }
        if (!$this->isAdmin()) redirect(site_url('/' . $this->session->userdata('user')->loggedinas . '/home'));
        $data['scripts'] = ['main.js', 'forms.js'];
		$data['menus'] = $this->db->where(['acct_type' => 'admin', 'active' => 1])->get('menus')->result();

		$sql = "SELECT * FROM coupon_codes";
		
		if ($param1 == 'all_coupon' && $param2 == null) {
			// $data['order'] = $this->OrderModel->findOrFail($param2)->collection;
			$data['coupons'] = $this->db->query($sql)->result();
			$data['page'] = $param1;
            $data['page_title'] = " | Admin | Settings | Coupon Codes";
            // $data['orders'] = $this->OrderModel->get()->collections;
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/coupon_codes/all.php', $data);
            $this->load->view('layouts/admin/foot', $data);
		} else if ($param1 == 'create' && $param2 == null) {
			// $data['order'] = $this->OrderModel->findOrFail($param2)->collection;
			$data['withdrawals'] = $this->db->get('withdrawal')->result();
			$data['page'] = $param1;
            $data['page_title'] = " | Admin | Settings | Create Coupon Code";
            // $data['orders'] = $this->OrderModel->get()->collections;
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/coupon_codes/create.php', $data);
            $this->load->view('layouts/admin/foot', $data);
		} else if ($param1 == 'store' && $param2 == null) {
			$coupon_data = $this->input->post();
			$number_of_coupon_to_be_created = $coupon_data['number_of_coupon'];
			$coupon_expiry_date = $coupon_data['expiry_date'];
			$coupon_percentage = $coupon_data['coupon_percentage'];
			$created = 0;
			$this->db->trans_begin();
			while ($created < $number_of_coupon_to_be_created) {
				$code = random_string('alnum', 6);
				if ($this->db->get_where('coupon_codes', ['coupon_code' => $code])->row()) {
					$code = random_string('alnum', 6);
				} else {
					$couponData['coupon_code'] = strtoupper($code);
					$couponData['expiry_date'] = $coupon_expiry_date;
					$couponData['percentage'] = $coupon_percentage;
					$couponData['created_by'] = $this->session->userdata('user')->user_id;
					$couponData['generated_for'] = $coupon_data['generated_for'];
					$couponData['created_at'] = date('Y-m-d H:i:s');
					$this->db->insert('coupon_codes', $couponData);
					$created++;
				}
			}
			if ($this->db->trans_status() == false) {
				$this->db->trans_rollback();
				echo json_encode(['status' => 0, 'msg' => 'Unable to create coupon code! Please try again!', 'redirect' => 'noreload']);
			} else {
				$this->db->trans_commit();
				echo json_encode(['status' => 1, 'msg' => 'Coupon codes created successfully!', 'redirect' => site_url('admin/coupons/all_coupon')]);
			}
		} else if ($param1 == 'used' && $param2 == null) {
			// $ql .= "  as coupon JOIN users as user ON coupon.user_id = user.user_id WHERE coupon.user_id !- ''";
            $data['coupons'] = $this->db->join('users', 'coupon_codes.user_id = users.user_id')->get_where('coupon_codes', ['coupon_codes.user_id !=' => ''])->result();
            $data['page_title'] = " | Admin | Settings | Used Coupon Codes";
            $data['page'] = $param1;
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/coupon_codes/all.php', $data);
            $this->load->view('layouts/admin/foot', $data);
		} else if ($param1 == 'expired' && $param2 == null) {
			$today = date('Y-m-d H:i:s');
			$sql = "SELECT * FROM coupon_codes WHERE (DATEDIFF('$today', expiry_date) >= 0)";
			
            $data['coupons'] = $this->db->query($sql)->result();
            $data['page_title'] = " | Admin | Settings | Expired Coupon Codes";
            $data['page'] = $param1;
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/coupon_codes/all.php', $data);
            $this->load->view('layouts/admin/foot', $data);
		} else if ($param1 == 'unused' && $param2 == null) {
			
            $data['coupons'] = $this->db->where(['user_id' => ''])->or_where(['user_id' => null])->get('coupon_codes')->result();
            $data['page_title'] = " | Admin | Settings | Unused Coupon Codes";
            $data['page'] = $param1;
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('admin/settings/coupon_codes/all.php', $data);
            $this->load->view('layouts/admin/foot', $data);
		}
	}
																															 


    public function logout() {
        $log['owner_id'] = $this->session->userdata('user')->user_id;
        $log['action'] = "You logged out of the system at " . date('Y-m-d H:i:s');
        $this->ActivityModel->createLog($log);
        $this->session->unset_userdata('user');
        redirect(site_url('/admin/home'));
    }

    public function isAdmin() {
        // if($this->session->)
        $acct_types = (array) explode(',', $this->session->userdata('user')->acct_type);
        if (in_array('admin', $acct_types)) {
            return true;
        } else {
            return false;
        }
    }

    private function format_date($date) {
        $convertDate = date('F jS, Y h:i:s', strtotime($date));
        return $convertDate;
    }
}
