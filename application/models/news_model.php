<?php
class News_model extends CI_Model {
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    /**
     *
     * @param $db_data
     * @return mixed
     */
    public function auth_user($db_data){
        return $this->db->get_where('users',$db_data,1);
    }

    /**
     * Register a user
     * @param $data
     * @return array
     */
    public function register_user($data){

        $this->db->trans_start();

        //Escape and Insert data into users table
        $this->db->escape($data);
        $this->db->insert("users",$data);

        //Get user_id of last inserted user
        $user_id = $this->db->insert_id();

        //Setting values to insert into confirm table
        $this->db->set('user_id', $user_id);
        $this->db->set('email', $data['email']);
        $this->db->set('key', md5($user_id . $data['full_name'] . $data['email'] . date('mY') )); //Randomly generated key
        $this->db->insert('confirm');

        $this->db->trans_complete();

        $return_data = array();
        $return_data['name'] = $data['full_name'];
        $return_data['user_id'] = $user_id;
        $return_data['email'] = $data['email'];
        $return_data['key'] = md5($user_id . $data['full_name'] . $data['email'] . date('mY') );

        return $return_data;

    }


    /**
     * Verify a user an sets password
     * @param $id
     * @param $password
     * @param $key
     * @return bool
     */
    public function set_password($id, $password, $key){

        //Check if id with key exists in confirm database
        $this->db->from('confirm');
        $this->db->where('user_id', $id);
        $this->db->where('key', $key);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() >= 1){
            //User with id and key found
            $this->db->trans_start();
            $is_active = '1';
            $update = array (
                'is_active'  => $is_active,
                'password' => $password
            );
        }

        $this->db->where('id',$id);
        $this->db->update('users',$update);

        //Also delete entry from confirm table
        $this->db->where('user_id', $id);
        $this->db->delete('confirm');

        $this->db->trans_complete(); //end of transaction

        return true;
    }

    /**
     * Publish an article
     * @param $db_data
     * @return bool
     */
    public function publish_article($db_data){
        $this->db->insert("news",$db_data);
        return true;
    }

    /**
     * Get articles published by a user
     * @param $id
     * @return mixed
     */
    public function get_articles($id){
        $this->db->from('news');
        $this->db->where('published_by',$id);
        $this->db->order_by("created_dtm", "desc"); //Chronological order
        $articles = $this->db->get();

        return $articles ;
    }

    /**
     * Takes user id and returns its email and name
     * @param $id
     * @return mixed
     */
    public function get_userdata($id){
        //$this->db->select('full_name','email');
        $this->db->where("id",$id);
        $this->db->from('users');
        $this->db->limit(1);
        $userdata = $this->db->get()->result();

        return $userdata = $userdata[0];
    }

    /**
     * Return a single article with article_id
     * @param $article_id
     * @return mixed
     */
    public function get_single_article($article_id){
        //$this->db->select('full_name');
        $this->db->where("id",$article_id);
        $this->db->from('news');
        $this->db->limit(1);
        $article = $this->db->get()->result();

        return $article = $article[0];
    }

    /**
     * Checks if user has authority to delete this post
     * Delete the post
     * Delete the image file also
     * @param $user_id
     * @param $article_id
     * @return bool
     */
    public function delete_article($user_id, $article_id){

        $this->db->trans_start();

        //Check if user is authorized to delete this id
        $this->db->where('published_by', $user_id);
        $this->db->where('id', $article_id);

        //Get image location
        $this->db->select('image');
        $image = $this->db->get('news');
        $image = $image->result()[0]->image;
        $image_location = "uploads/".$image;
        //unset($image);

        $this->db->where('published_by', $user_id);
        $this->db->where('id', $article_id);
        $this->db->delete('news');

        //Check if file exists
        if (file_exists($image_location)){
            if(unlink($image_location)){
                $this->db->trans_complete(); //end of transaction
                return true;
            }else{
                return false;
            }

        }else{
            $this->db->trans_complete(); //end of transaction
            return true;
        }
    }

    /**
     * Get 10 news articles from database in Chronological order
     * @return mixed
     */
    public function get_all_articles(){
        $this->db->from('news');
        $this->db->order_by("created_dtm", "desc"); //Chronological order
        $this->db->limit(10);
        $articles = $this->db->get();
        return $articles ;
    }

}

