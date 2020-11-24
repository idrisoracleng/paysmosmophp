<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_batch_model extends CI_Model
{



	/* 
! Paysmosmo
*/

	public function batch_insert($data)
	{
		$this->db->insert_batch('products', $data);
	}

	/* 
! Paysmosmo
*/
}
