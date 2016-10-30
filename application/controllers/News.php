<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('News_model');
        $this->load->library('My_PHPMailer');

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
        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = "**************";  // user email address
        $mail->Password   = "**************";            // password in GMail
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




}
