<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require "News.php";
class Test extends News {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
    }

    public function index()
    {
        /**
         *Publish Article
         */
        $db_data = array();
        $db_data['title'] = "Test News title";
        $db_data['news_text'] = "Test News text";
        $db_data['published_by'] = 1;
        $db_data['created_dtm'] = date("Y-m-d H:i:s");
        $this->unit->run($this->News_model->publish_article($db_data),'is_true',"Publish Article");
        unset($db_data);

        /**
         *Authenticate user
         */
        $db_data = array();
        $db_data['email'] = 'umairqamar700@gmail.com';
        $db_data['password'] = md5("12345");
        $db_data['is_active'] = 1;
        $this->unit->run($this->News_model->auth_user($db_data),'is_object',"Authenticate User");
        unset($db_data);

        /**
         *Get articles
         */
        $this->unit->run($this->News_model->get_articles(1),'is_object',"Get articles");

        /**
         *Get Userdata Helper
         */
        $this->unit->run(get_userdata(33),'is_array',"Get user data");
        $this->unit->run(get_userdata("String"),'is_false',"Get user data","Passing false input");

        /**
         *Get All articles
         */
        $this->unit->run($this->News_model->get_all_articles(),'is_object',"Get Latest 10 articles");

        /**
         *Check if user is logged in
         */
        if (isset($_SESSION['user_id'])){
            $session = 'is_true';
        }
        else{
            $session = 'is_false';
        }
        $this->unit->run(is_user_loggedin(),$session,"Check if user is logged in");
        unset($session);





        echo $this->unit->report();

    }

   }
