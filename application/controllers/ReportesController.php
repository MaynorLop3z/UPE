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
    }

    public function index() {
        $this->load->model('Reports');
        $data['categorias'] = $this->Reports->getCategoriasQuantity();
        $this->load->view('Reportes',$data);
    }
}
