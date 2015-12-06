<?php
/**
 * Description of GestionGrupos
 *
 * @author maynorlop3z
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class GestionGruposController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Diplomados');
//        $this->load->model('usuarios');
    }
    
    public function index() {
        $datos['Categorias'] = $this->Diplomados->listarCategoriasDiplomados();
        $this->load->view('GestionGrupos',$datos);
    }
    
    public function getDiplomados(){
        $codigoCat = $this->input->post('idCategoria');
//        $codigoGenerado = '';
        $diploma2 = $this->Diplomados->listarDiplomadosCategoria($codigoCat);
        foreach ($diploma2 as $diplo){
//            $codigoGenerado.='<option value="' . $diplo['CodigoDiplomado'] . '">' . $diplo['NombreDiplomado'] . '</option>';
//        }
//        return $codigoGenerado;
        ?>
	<option value="<?=$diplo->CodigoDiplomado ?>"><?=$diplo->NombreDiplomado ?></option>
	<?php
        }
    }
}
