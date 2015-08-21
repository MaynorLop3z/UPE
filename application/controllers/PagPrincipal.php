<?php
//vista de los usuarios logeados


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PagPrincipal extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
 
        $this->load->view('vistaview');
    }

}