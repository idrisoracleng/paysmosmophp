<?php

defined('BASEPATH') OR exit('You are not allowed here');


    class OrderModel extends CI_Model {

        private $table = 'orders';
        // public $id;
        public $order_id;
        public $buyer_id;
        public $order_detail;
        public $total_amount;
        public $isCooperative;
        public $payment_due;
		public $coupon_code;
        public $coupon_price;
        public $status = 'pending';
        public $msg = 'Your order will be attended to shortly.';
        public $created_at;
        public $collection;
        public $collections;


        public function __construct(){

            parent::__construct();

        }

         public function get() {
            $this->collections = $this->db->order_by('created_at', 'DESC')->get($this->table)->result();
            return $this;
        }

        public function findManyBy($by, $key){
            $this->collections = $this->db->order_by('created_at', 'desc')->where($by, $key)->get($this->table)->result();
            return $this;
        }

        public function initialize($raw_order = null){
            // $this->order_id = ($raw_order['order_id']) ? $raw_order['order_id'] : 'PSSORDER'.random_string('nozero', 5);
            $this->buyer_id = ($raw_order['buyer_id']) ? $raw_order['buyer_id'] : $this->UserModel->Auth()->user_id;
            $this->order_detail = ($raw_order['order_id']) ? $raw_order['order_detail'] : $this->order_detail;
            $this->total_amount = ($raw_order['total_amount']) ? $raw_order['total_amount'] : $this->total_amount;
            $this->status = ($raw_order['status']) ? $raw_order['status'] : $this->status;
            $this->msg = ($raw_order['msg']) ? $raw_order['msg'] : $this->msg;
            $this->isCooperative = ($raw_order['isCooperative']) ? $raw_order['isCooperative'] : $this->isCooperative;
            $this->created_at = date('Y-m-d H:i:s a');
			 $this->coupon_code = ($raw_order['coupon_code']) ? $raw_order['coupon_code'] : $this->coupon_code;
            $this->coupon_price = ($raw_order['coupon_price']) ? $raw_order['coupon_price'] : $this->coupon_price;																					  
            // $d = strtotime("+4 months", $this->created_at);
            $this->payment_due = date('Y-m-d H:i:s', strtotime("+3 months", strtotime(date('Y-m-d H:i:s'))));
            return $this;
        }

        public function save($raw_order = null){
            if($raw_order){
                $this->initialize($raw_order);
            }
            unset($this->collections);
            unset($this->collection);
            return $this->db->insert($this->table, $this);
        }


        /**
         * @param order_id string
         * @return collection
         */
        public function findOrFail($id){
            $this->collection = $this->db->where(['order_id' => $id])->get($this->table)->row();
            return $this;
        }

        public function update($id, $data){
            $this->initialize($data);
            unset($this->collections);
            unset($this->collection);
            return $this->db->where('order_id', $id)->update($this->table, $this);
        }

        public function getOrderStatusMessage($data) {
            switch($data['status']) {
                case 1:
                    return "Pending ";
                    break;
                case 2:
                    return "Awaiting ".$this->db->get_where('cooperatives', ['cooperative_id' => $data['cooperative_id']])->row()->name." Cooperative Admin Approval";
                    break;
                case 3:
                    return "Awaiting Remita Approval. Take remita form to the bank for approval";
                    break;
                case 4:
                    return "Awaiting Admin Final Approval";
                    break;
                case 5:
                    return "Order Canceled By You";
                    break;
                case 6:
                    return "Order Declined By Cooperative Admin";
                    break;
                case 7:
                    return "Order Declined By Admin";
                    break;
                case 8:
                    return "Order Canceled By Admin";
                    break;
                default:
                    return "Order have been closed! Expect your goods in due course";
            }
        }


    }