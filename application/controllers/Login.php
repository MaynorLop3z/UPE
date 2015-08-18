<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {


        if (isset($_POST['user'])) {

            $this->load->model('usuario_model');
            $this->load->helper('url');
            if ($this->usuario_model->login($_POST['user'], $_POST['password'])) {

//            if (true) {
                redirect('pagPrincipal');
            } else {
                $this->load->view('login_vista');
            }
        } else {
            $this->load->view('login_vista');
        }
    }

}
