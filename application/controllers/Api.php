<?php
/*

      header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/json; charset=UTF-8");
      header("Access-Control-Allow-Methods: POST");
      header("Access-Control-Max-Age: 3600");
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Api extends CI_Controller {

 // ===============================  Aunth Api =======================================
    public function __construct() {
       parent::__construct();
       header("Access-Control-Allow-Origin: *");
       header("Content-Type: application/json; charset=UTF-8");
       header("Access-Control-Allow-Methods: POST");
       header("Access-Control-Max-Age: 3600");
       header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    }

    // ================================ Api login ====================================
    public function api_login($username,$password){
        // header("Access-Control-Allow-Origin: *");
        // header("Content-Type: application/json; charset=UTF-8");
        // header("Access-Control-Allow-Methods: POST");
        // header("Access-Control-Max-Age: 3600");
        // header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $countUser = $this->Authentication_model->cek_user($username, $password);
        $takeUser = $this->Authentication_model->get_user($username, $password);

        if($countUser>0){
                                                                // nama Field
            $this->session->set_userdata("sess_email", $takeUser->email);
            $this->session->set_userdata("sess_id", $takeUser->user_id);
            $this->session->set_userdata("sess_role_id", $takeUser->role);
            $this->session->set_userdata("sess_logged", "logged");

        $data["message"]="Ok";
        $data["response"]="200";
        $data["email_resp"]= $this->session->userdata("sess_email");
        $data["id_reps"]= $this->session->userdata("sess_id");

        }
        else{

        	if($username==""||$password==""){

        				$data["message"]="Email atau Password Belum ditulis";
				        $data["response"]="404";
				        $data["email_resp"]= "";
				        $data["id_reps"]= "";


        	}

        	else if($countUser<1){

        				$data["message"]="Anda belum terdaftar";
				        $data["response"]="404";
				        $data["email_resp"]= "";
				        $data["id_reps"]= "";


        	}

            // $data['message']= "failed";
            // $data['respon']= "404";
            // $data['email_resp']= $this->session->userdata("sess_email");
            // $data["id_reps"]= $this->session->userdata("sess_id");

        }

        echo json_encode($data,JSON_FORCE_OBJECT);

    }


    // ================================ Api get posting ============================
     public function api_get_posting(){

       	$data="";
        $q= $this->User_model->get_posting();

        if($q==null){

        $data['message']="Koneksi database terputus";
        $data['response']="404";

        }

        else {

        	$data['response']  ="200";
        	$data['posts'] = $q;

        }



        echo json_encode($data);
    }


    	// =================================== Api Get Total User ==========================
    	public function api_get_total_user(){

    		    $data="";
            $q= $this->Authentication_model->model_total_user();

            if($q==null){

                $data['message']="Data user tidak ada";
                $data['response']="404";
            }

            else {

                $data['response'] ="200";
                $data['post'] = $q;
            }

    		echo json_encode($data);
       	}

        // =================================== Api Total Posting ==================================

        public function api_get_total_posting(){

            $data="";
            $q= $this->Authentication_model->model_total_posting();

            if($q==null){

                $data['message']="Postingan tidak ada";
                $data['response']="404";
            }

            else {

                $data['response'] ="200";
                $data['post'] = $q;
            }

            echo json_encode($data);
        }

        // ================================ Api Get Register ======================================

//        public function api_new_user($email, $password, $nama, $umur, $kota){
        public function api_new_user($email, $password){


            $getUser = $this->Authentication_model->new_user($email, $password);

            if($getUser>0){
                                                                    // Nama Field
                $this->session->set_userdata("sess_email", $getUser->email);
                $this->session->set_userdata("sess_password", $getUser->password);
                $this->session->set_userdata("sess_registered", "Registered");




                 $data["message"]="Registered.!";
                 $data["response"]="200";
                 $data["email_resp"]= $this->session->userdata("sess_email");
                 $data["confirm_pasword_reps"]=$this->session->userdata("sess_confirm_password");
                 $data["id_reps"]= $this->session->userdata("sess_id");

            }
                else if($getUser['email']>0)
            {
                 $data["response"]=404;
                 $data["message"] = "Email anda sudah pernah didaftarkan !";
                 $data["email"] = $getUser->email;

            }
                else
            {
                 $data["response"]=404;
                 $data["message"] = "Koneksi gagal !";
            }

                echo json_encode($data);
            }

            // =================================== Comment ====================================

            public function api_get_comment(){

                $data="";
                $q = $this->user_model->comment();

            if($q==null){

                $data['message']="Masukkan komentar anda";
                $data['response']="404";
            }

            else {

                $data['response'] ="200";
                $data['post'] = $q;
            }

            echo json_encode($data);

            }




// Penutup
}
