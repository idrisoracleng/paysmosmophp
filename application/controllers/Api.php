<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Api extends CI_Controller {

        public function __construct(){
            parent::__construct();
        }
		
		public function index() {
		}

        public function getSubCategories($id, $catid = null){
            $categories = $this->CategoryModel->getSubCategories($id);
            if($categories){
                $res = "<select class='category form-control custom-select-sm' name='categories[]' "."onchange='alert("."Hello world".")"."'>";
                $res .= "<option seleted value='NULL'> Select Sub Category</option>";
                foreach($categories as $category){
                    if($category['id'] == $catid) $selected = 'selected'; else $selected = '';
                    $newOPtion = "<option ".$selected." value='".$category['id']."'>".$category['name']."</option>";
                    $res .= $newOPtion;
				}
                $res .= "</select>"; 
            }else{
                $res = "<p class='alert alert-warning'>Last Category</p>";
            }
            
            echo $res;
            // echo json_encode($categories);
        }

        public function getCategoryImageUrl($id){
            $category = $this->CategoryModel->getCategory($id);
            echo "<small class='text-info'>Category Image Preview</small><br/><img style='height: 100px; width: 100px;' src=".site_url('/public/images/system/categories/'.strtolower(str_replace(' ', '-', $category['name'])).'.jpg')." >";
        }

        public function getSubCategoryImageUrl($id){
            $category = $this->SubCategoryModel->getSubCategory($id);
            echo "<small class='text-info'>Category Image Preview</small><br/><img style='height: 100px; width: 100px;' src=".site_url('/public/images/system/subcategories/'.strtolower(str_replace(' ', '-', $category['name'])).'.jpg')." >";
		}
		
		public function getSubCategory($id) {
			$subCats = $this->db->get_where('category', ['parent_id' => $id])->result();
			$data = "<label>Select Sub Category</label><select class='category form-control custom-select-sm' name='category_id'>";
			if (is_array($subCats) && (count($subCats) >0)) {
				foreach ($subCats as $key => $cat) {
					$data .= "<option value='".$cat->id."'>".$cat->name."</option>";
				}	
			}
			
			$data .= "</select>";
			echo $data;
		}


		public function getLocals($id) {
			$subCats = $this->db->get_where('locals', ['state_id' => $id])->result();
			$data = "<select class='form-control custom-select-sm'><option selected disabled>Select Local Government</option>";
			foreach ($subCats as $key => $cat) {
				$data .= "<option value='".$cat->local_id."'>".$cat->local_name."</option>";
			}
			$data .= "</select>";
			echo $data;
		}

public function getCouponStatus() {
			$code = $_GET['code'];
			// $price = 
			$codeData = $this->db->get_where('coupon_codes', ['coupon_code' => $code])->row();
			// $today = date('Y-m-d H:i:s');
			// if ($codeData && ($codeData->user_id == '' || $codeData->user_id == null) && ($codeData->expiry_date > $today)) {
			// 	echo json_encode(['status' => 1, 'msg' => 'Coupon Code is Available!', 'coupon_data' => $codeData]);
			// } else if ($codeData && ($codeData->user_id == '' || $codeData->user_id == null) && ($codeData->expiry_date < $today)) {
			// 	echo json_encode(['status' => 0, 'msg' => 'Coupon Code has Expired!', 'coupon_data' => $codeData]);
			// } else if ($codeData && ($codeData->user_id != '' && $codeData != null) && ($codeData->expiry_date < $today)) {
			// 	echo json_encode(['status' => 0, 'msg' => 'Coupon code have been used', 'coupon_data' => $codeData]);
			// } else 
			if ($codeData) {
				echo json_encode(['status' => 1, 'msg' => 'Coupon Code is Available', 'coupon_data' => $codeData]);
			} else {
				echo json_encode(['status' => 0, 'msg' => 'Invalid coupon code', 'coupon_data' => $codeData]);
			}
		}
    }
?>
