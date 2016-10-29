<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('News_model');
    }

    public function index()
    {

        $this->register_user();


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

                $this->News_model->register_user($db_data);

                $this->session->set_flashdata('message', 'An email has been sent to your account');
                redirect('news/register_user');
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




}
