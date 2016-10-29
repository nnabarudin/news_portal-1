<?php
class News_model extends CI_Model {
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function register_user($data){
        $this->db->trans_start();

        //Insert data into users table
        $this->db->insert("users",$data);

        //Get user_id of last inserted user
        $user_id = $this->db->insert_id();

        //Setting values to insert into confirm table
        $this->db->set('user_id', $user_id);
        $this->db->set('email', $data['email']);
        $this->db->set('key', md5($user_id . $data['name'] . $data['email'] . date('mY') )); //Randomly genereted key
        $this->db->insert('confirm');

        $this->db->trans_complete();
    }


}

