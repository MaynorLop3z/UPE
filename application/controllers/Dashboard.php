<?php
//vista de los usuarios logeados


if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        try {
            $this->load->view('Dashboard'); 
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}