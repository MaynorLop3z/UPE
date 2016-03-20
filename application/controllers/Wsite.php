<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wsite
 *
 * @author Grisshi
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Wsite extends CI_Controller { 
    //put your code here
    public function index()
	{
		$this->load->view('wsite');
	}
}
