<?php

defined('BASEPATH') or die('Direct Access Not Allowed');


class CooperativeModel extends CI_Model {
    private $_table = 'cooperatives';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getCooperative($where) {
        return $this->db->where($where)->get($this->_table);
    }

    public function getCoopetiveMembers($cooperativeId) {
        return $this->db->limit(10)->join('users', 'users.user_id = cooperative_member.member_id')->order_by('cooperative_member.created_at', 'DESC')->get_where('cooperative_member', ['cooperative_member.cooperative_id' => $cooperativeId]);
    }

    public function getActiveCooperativeMembers($cooperativeId) {
        return $this->db->limit(10)->join('users', 'users.step != 5 AND users.user_id = cooperative_member.member_id')->order_by('cooperative_member.created_at', 'DESC')->get_where('cooperative_member', ['cooperative_member.cooperative_id' => $cooperativeId]);
    }

    public function getDeclinedCooperativeMembers($cooperativeId) {
        return $this->db->limit(10)->join('users', 'users.step = 5 AND users.user_id = cooperative_member.member_id')->order_by('cooperative_member.created_at', 'DESC')->get_where('cooperative_member', ['cooperative_member.cooperative_id' => $cooperativeId]);
    }

    public function getPendingCooperativeMembers($cooperativeId) {
        return $this->db->limit(10)->join('users', 'users.step = 5 AND users.user_id = cooperative_member.member_id')->order_by('cooperative_member.created_at', 'DESC')->get_where('cooperative_member', ['cooperative_member.cooperative_id' => $cooperativeId]);
    }
}