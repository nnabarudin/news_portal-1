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

        echo "News portal";


    }




}
