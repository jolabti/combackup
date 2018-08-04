<?php


if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->db->cache_on();
    }

    // ========================== Posting ============================
    // Get Posting
    public function get_posting(){
     /*
     $this->db->select('*');
        $this->db->from('komen');
        $this->db->join('user', 'user.user_id = komen.user_id');
     */


    	   $this->db->select('*');
         $this->db->from('posting');
         $this->db->join('user', 'user.user_id = posting.user_id');
         $this->db->join('komen', 'komen.user_id = posting.user_id');
				 $this->db->order_by("posting.waktu", "desc");
						// $this->db->where('posting.id_user',1);
						// $this->db->limit(5);
            $q = $this->db->get();
            return $q->result();
    }

    public function get_sample_posting(){

          $q = $this->db->get('posting');
          return $q->result();

    }
    // ============================ Insert Komentar =======================
    public function insert_komen($data=array()){
        $this->db->insert('komen',$data);

    }

    // ============================ Insert Posting ========================
    // Insert Posting
    public function insert_posting($data=array()){
    	$this->db->insert('posting',$data);
    }

    public function masukkin_komentar($data=array()){
      $this->db->insert('komen',$data);

    }


    // =========================== Delete User ============================
    // Delete user
  	public function delete_posting($data=array()){
  		$this->db->delete('delete',$data);
  	}

  	// ============================ Komentar ==============================
    // Komentar
    public function comment(){
        $this->db->select('*');
        $this->db->form('komen');
        $this->db->join('user', 'user.user_id = komen.user_id');
                    $this->db->order_by("komen.waktu", "desc");
                    $this->db->where('komen.user_id',2);
                    $this->db->limits(7);
            $q = $this->db->get();
            return $q->result();

    }














// Penutup
}
