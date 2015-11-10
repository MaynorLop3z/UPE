<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class VistaAyudaCtrl extends CI_Controller {

    public function __construct() {
        try {
            parent::__construct();
          
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function index() {
        try {

            $this->load->view('VistaAyudaView');
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

  
     

}
