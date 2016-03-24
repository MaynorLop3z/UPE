<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
include(APPPATH . 'libraries/simple_html_dom.php');
class RolesController extends CI_Controller {

    public function __construct() {
        try {
            parent::__construct();
            $this->load->database();
            $this->load->model('Rol');
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function index() {
        try {
            $data['RolesList'] = $this->Rol->listarRoles();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        $this->load->view('Roles', $data);
    }

    public function persistRola() {
        try {
            if ($this->input->post()) {
                $nombreRol = $this->input->post('RolNombre');
                $ip = $this->session->userdata('ipUserLogin');
                $userModifica = $this->session->userdata('codigoUserLogin');
                //La fecha de modificaciòn del registro y el estado se coloca en el modelo para evitar enviar mas parametros.
                $insert_id = $this->Rol->CrearRol($nombreRol, $ip, $userModifica);
                $cadena = '';
                if ($insert_id != null && $insert_id > 0) {
                    $RolesList = $this->Rol->listarRoles();
                    foreach ($RolesList as $rol) {
                        ?> 
                        <tr data-rold='<?php echo json_encode($rol) ?>' id="tr<?php echo $rol->CodigoRol ?>">
                            <td class="nombre_Rol" ><?= $rol->NombreRol ?></td>
                            <td style="text-align:center"  class="gestion_rol">
                                <button id="<?php echo $rol->CodigoRol ?>" title="Editar Rol" class="btn_modificar_rol btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
                                <button id="btnDel<?php echo $rol->CodigoRol ?>" title="Eliminar Rol" class="decorateStyleCrud btn_eliminar_rol btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                <button id="btnPer<?php echo $rol->CodigoRol ?>" title="Asignar Permisos" class="btn_permisos_user btn btn-success"><span class="glyphicon glyphicon-user"></span></button>
                            </td>
                        </tr>  
                        <?php
                    }
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function persistRol() {
        try {
            if ($this->input->post()) {
                $nombreRol = $this->input->post('RolNombre');
                $ip = $this->session->userdata('ipUserLogin');
                $userModifica = $this->session->userdata('codigoUserLogin');
                //La fecha de modificaciòn del registro y el estado se coloca en el modelo para evitar enviar mas parametros.
                $insert_id = $this->Rol->CrearRol($nombreRol, $ip, $userModifica);
                $cadena = '';

                $pathView = APPPATH . 'views/VistaAyudaView.php';
                $html=file_get_html($pathView);
                $elemsWithRights = $html->getElementById('gestionRoles');

                if ($insert_id != null && $insert_id > 0) {
                    $RolesList = $this->Rol->listarRoles();
                    
                    foreach ($RolesList as $rol) {
                        $obj=json_encode($rol) ;
                        $cadena.='<tr data-rold='.$obj;
                        $cadena.=' id="tr' . $rol->CodigoRol . '">';
                        $cadena.=' <td style="text-align:center" class="nombre_Rol" >' . $rol->NombreRol . '</td>';
                        $cadena.=' <td style="text-align:center"  class="gestion_rol">'.str_get_html($elemsWithRights).'</td></tr>';
                    }
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        echo $cadena;
    }

    public function eliminarRol() {
        
    }
    
    public function editarRol(){
         try {
            if ($this->input->post()) {
                $codigoRol = $this->input->post('CodigoRol');
                if ($codigoRol != null) {
                   
                    $nombreRol = $this->input->post('NombreRol');
                    $ip = $this->session->userdata('ipUserLogin');
                    $userModifica = $this->session->userdata('codigoUserLogin');
                    //La fecha de modificaciòn del registro se coloca en el modelo para evitar enviar mas parametros.
                    $this->load->model('Rol');
                    $arrayData = $this->Rol->ModificarRol($codigoRol, $nombreRol,$ip,$userModifica);
                    echo json_encode($arrayData);
                }
            }
        } catch (Exception $e) {
            $data = array(
                'Error' => $ex->getMessage()
            );
            echo json_encode($data);
        } 
    }
    
    /*
     *  public function editarUsuario() {
        try {
            if ($this->input->post()) {
                $codigoUser = $this->input->post('CodigoUsuario');
                if ($codigoUser != null) {
                    $codigoUsuario = $codigoUser;
                    $nombrePersonaUsuario = $this->input->post('UsuarioNombreReal');
                    $contraseniaUsuario = $this->input->post('UsuarioPassword');
                    $comentarios = $this->input->post('Comentarios');
                    $correo = $this->input->post('UsuarioEmail');
                    $nombreUsuario = $this->input->post('UsuarioNombre');
                    $ip = $this->session->userdata('ipUserLogin');
                    $userModifica = $this->session->userdata('codigoUserLogin');
                    //La fecha de modificaciòn del registro se coloca en el modelo para evitar enviar mas parametros.
                    $this->load->model('Usuarios');
                    $arrayData = $this->Usuarios->editarUsuario($codigoUsuario, $nombreUsuario, $contraseniaUsuario, $nombrePersonaUsuario, $correo, $userModifica, $ip, $comentarios);
                    echo json_encode($arrayData);
                }
            }
        } catch (Exception $e) {
            $data = array(
                'Error' => $ex->getMessage()
            );
            echo json_encode($data);
        }
    }
     */

    public function listarByModulo() {
        if ($this->input->post('idModulo')) {
            $idModulo = $this->input->post('­idModulo');
            $Periodos = $this->Periodos->lis­tarPeriodosByModulo($idModulo);
            $cadena = '';
            foreach ($Periodos as $period) {
                $cadena .='<tr id="Periodo' . $period->CodigoPerio­do . '">';
                $cadena .= '<th class="fip">' . $period->FechaInicio­Periodo . '</th>';
                $cadena .= '<th class="ffp">' . $period->FechaFinPer­iodo . '</th>';
                $cadena .= '<th class="ffp">' . $period->FechaFinPer­iodo . '</th>';
                if ($period->Estado == 't') {
                    $cadena .= '<th class="ep">Activo</­th>';
                } else {
                    $cadena .= '<th class="ep">Inactivo<­/th>';
                }
                $cadena .= '<th class="cp">' . $period­->Comentario . '</th>';
                $cadena .= '<th><button id="PeriodoE' . $period->CodigoPerio­do . '" onclick="EditPeriodo­Show(this)" title="Editar Periodo" class="btn_modificar­_periodo btn btn-success"><span class="glyphicon glyphicon-pencil"></­span> </button>';
                $cadena .= '<button id="PeriodoDEL' . $period->CodigoPerio­do . '" onclick="DeletePerio­doShow(this)" title="Eliminar Periodo" class="btn_eliminar_­periodo btn btn-danger"><span class="glyphicon glyphicon-trash"></­span></button>';
                $cadena .= '<button id="PeriodoGES' . $period->CodigoPerio­do . '" onclick="GestionPeri­odoShow(this)" title="Gestionar Periodo" class="btn_gestionar­_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></­span></button></th></­tr>';
            }
            echo $cadena;
        }
    }

}
