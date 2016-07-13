<?php
/**
 * Description of Reportes
 *
 * @author maynorlop3z
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ReportesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Reports');
    }

    public function index() {
        
        $data['categorias'] = $this->Reports->getCategoriasQuantity();
        $this->load->view('Reportes',$data);
    }
    
    public function getCategoriasCantidad(){
        echo json_encode($this->Reports->getCategoriasQuantity());
    }
    
    
    public function getDiplomadosGenero(){
        echo json_encode($this->Reports->countGenderCat());
    }
}
