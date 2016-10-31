<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('News_model');
        $this->load->helper('general_helper');
        $this->load->library('session');

    }

    public function index()
    {
        $this->news_stand();
    }

    public function login(){


        //Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Form validation
            $this->form_validation->set_rules('email', 'Password', 'required|valid_email|max_length[150]');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() != FALSE){
                $db_data = array();
                $db_data['email'] = $this->input->post('email', TRUE);
                $db_data['password'] = md5($this->input->post('password', TRUE));
                $db_data['is_active'] = 1;

                $res = $this->News_model->auth_user($db_data);
                if($res->result_id->num_rows == 1){
                    $res = $res->result();
                    $this->session->set_userdata('user_id',$res[0]->id);
                    redirect("news/register_user");
                }else{
                    $this->session->set_flashdata('error', 'Invalid Email or Password');
                    redirect('news/login');
                }
            }
            $this->session->set_flashdata('error', validation_errors());
            redirect('news/login');
        }


        //Show login form
        $data = array();
        $data['title'] = 'Login';
        $this->load->view('news_portal/login');
    }

    public function register_user(){

        //Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Form validation
            $this->form_validation->set_rules('name', 'Name', 'required|alpha_numeric_spaces');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]|max_length[150]'
                ,array(
                    'is_unique'     => 'User with this %s already exists.'
                )
            );
            if ($this->form_validation->run() != FALSE){
                $db_data = array();
                $db_data['full_name'] = $this->input->post('name', TRUE);
                $db_data['email'] = $this->input->post('email', TRUE);

                $return_data = $this->News_model->register_user($db_data);
                if ($return_data){
                    $subject = 'News Portal - Registration Confirmation';
                    $name = $return_data['name'];
                    $id = $return_data['user_id'];
                    $email = $return_data['email'];
                    $key = $return_data['key'];

                    $message = "Hello $name,
                           <br/><br/>
                            Welcome to the News Portal<br/> 
                            You have registered an account for $email<br/>
                            To complete your registration  please , just click following link<br/>
                            <a href='http://newsportal.dev/news/verify/$id/$key' target='_blank'>Confirm Registration</a>
                            <br/><br/>
                            Regards,<br/>
                            The News Portal Team
                    ";
                }


                if ($this->send_mail($email,$message,$subject))
                {
                    $this->session->set_flashdata('message', 'An email has been sent to your account.Please login your email to confirm your account');
                    redirect('news/register_user');
                }
                else{
                    $this->session->set_flashdata('error', 'Something went wrong in sending email');
                    redirect('news/register_user');
                }

            }else{
                $this->session->set_flashdata('error', validation_errors());
                redirect('news/register_user');
            }


        }

        //Show register form
        $data = array();
        $data['title'] = "Register User";
        $this->load->view('news_portal/register',$data);
    }

    public function send_mail($email,$message,$subject) {
        $this->load->library('My_PHPMailer');
        $this->config->load('php_mailer');
        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = $this->config->item('host');
        $mail->Port       = $this->config->item('port');
        $mail->Username   = $this->config->item('username');
        $mail->Password   = $this->config->item('password');;
        $mail->SetFrom('mail@Newsportal.com', 'News Portal');  //Who is sending the email

        $mail->Subject    = $subject;
        $mail->Body      = $message;

        $mail->addAddress($email);     // Add a recipient

        if(!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

    public function verify($id,$key){

        if (!is_null($id) && is_numeric($id) && !is_null($key)){
            $data = array();
            $data['title'] = "Set Password";
            $this->load->view('news_portal/new_password',$data);

            //Check if form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //Form validation
                $this->form_validation->set_rules('password', 'Password', 'required|max_length[50]');
                $this->form_validation->set_rules('conf_pass', 'Confirm Password', 'required|matches[password]|max_length[50]'
                    ,array(
                        'matches'     => 'Passwords do not match'
                    )
                );
                if ($this->form_validation->run() != FALSE){

                    $password = md5($this->input->post('password', TRUE)); //Encrypt password using md5

                    if ($this->News_model->set_password($id,$password,$key)) {
                        $this->session->set_flashdata('message', 'Password set successfully');

                        $this->session->set_userdata('user_id',$id);
                        redirect('');
                    }


                }
                else{
                    $this->session->set_flashdata('error', validation_errors());
                    redirect('news_portal/verify/'.$id.'/'.$key);
                }
            }
        }

    }

    public function logout(){
        $this->session->sess_destroy();
        redirect("");
    }

    public function publish_article(){
        if(!is_user_loggedin()){
            $this->session->sess_destroy();
        };

        //Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Form validation
            $this->form_validation->set_rules('title', 'Title', 'required');


            if ($this->form_validation->run() != FALSE){
                $db_data = array();
                $db_data['title'] = $this->input->post('title', TRUE);
                $db_data['news_text'] = $this->input->post('news_text', TRUE);
                $db_data['published_by'] = $this->session->user_id;
                $db_data['created_dtm'] = date("Y-m-d H:i:s");

                //Configuration for image
                $config = array();
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048; //2MiB
                $config['encrypt_name']         = TRUE;

                $this->load->library('upload', $config);


                if ( ! $this->upload->do_upload('fileToUpload')){
                    $this->session->set_flashdata('error', 'Error Uploading file');
                    redirect("news/publish_article");
                }else{
                    $upload_data = $this->upload->data();
                    $db_data['image'] = $upload_data['file_name'];
                    unset($upload_data);
                }
                if($this->News_model->publish_article($db_data)){
                    $this->session->set_flashdata('message', 'Article Published');
                    redirect("news/publish_article");
                }

            }else{
                $this->session->set_flashdata('error', validation_errors());
                redirect('news/publish_article');
            }
        }
        //Show publish article form
        $data = array();
        $data['title'] = "Publish Article";
        $this->load->view('news_portal/publish_article',$data);
    }

    public function show_articles(){
        if(!is_user_loggedin()){
            $this->session->sess_destroy();
        };
        $data = array();
        $data['title'] = "Show Articles";
        $data['articles'] = $this->News_model->get_articles($this->session->user_id);


        $this->load->view('news_portal/show_articles',$data);


    }

    public function article($article_id){
        $data = array();
        $data['article'] = $this->News_model->get_single_article($article_id);
        //$data['title'] = "Show Articles";
        $this->load->view('news_portal/article',$data);
    }

    public function delete_article($article_id){

        //First check if user is logged in
        if(!is_user_loggedin()){
            $this->session->sess_destroy();
        };

        //Check if user has authority to delete this post then delete
        $user_id = $this->session->user_id;
        if ($this->News_model->delete_article($user_id,$article_id)){
            $this->session->set_flashdata('message', 'Article deleted successfully');
        }
        else{
            $this->session->set_flashdata('error', 'Delete operation not successful');
        }
        redirect('news/show_articles');
    }

    public function news_stand(){
        $data = array();
        $data['title'] = "Home";
        $data['articles'] = $this->News_model->get_all_articles();
        $this->load->view('news_portal/news_stand',$data);
    }

    public function rss(){
        $this->load->helper('xml');
        $data['encoding'] = 'utf-8';
        $data['feed_name'] = 'newsportal.dev';
        $data['feed_url'] = 'http://newsportal.dev';
        $data['page_description'] = 'News Portal designed by Umair Qamar (umairqamar@live.com)';
        $data['page_language'] = 'en-us';
        $data['creator_email'] = 'umairqamar@live.com';
        $data['posts'] = $this->News_model->get_all_articles();
        header("Content-Type: application/rss+xml");
        $this->load->view('news_portal/rss', $data);
    }




}
