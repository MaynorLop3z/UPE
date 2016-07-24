<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class ModeloBase extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function model_load_model($model_name)
   {
      $CI =& get_instance();
      $CI->load->model($model_name);
      return $CI->$model_name;
   }
}