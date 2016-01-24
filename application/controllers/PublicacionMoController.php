
<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class PublicacionMoController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
 
        
        $this->load->view('PublicacionModulo');
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

