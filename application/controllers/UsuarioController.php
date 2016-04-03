<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include(APPPATH . 'libraries/simple_html_dom.php');

//include(APPPATH . 'libraries/UtilidadesWeb.php');

class Usuariocontroller extends CI_Controller {

    public function __construct() {
        try {
            parent::__construct();
            $this->load->database();
            $this->load->model('Usuarios');
            $this->load->model('Rol');
            $this->load->library('utilidadesWeb');
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function index() {
        try {
            $data['Usuarios'] = $this->Usuarios->listarUsuarios(null, null);
            $data['RolesList'] = $this->Rol->listarRoles();

            $data['RowsPorPag'] = ROWS_PER_PAGE;
            $data['ToTalRegistros'] = $this->Usuarios->countAllUsers();
            $data['PagInicial'] = 1;

            $permisos = $this->session->userdata('permisosUsuer');
            $this->analizarPermisos('views/Usuarios/UsuariosTab.php', 'views/Usuarios/UsuariosTabTmp.php', 'views/VistaAyudaView.php', $permisos);
//           
            $this->load->view('Usuario', $data);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function analizarPermisos($pathView, $pathViewTmp, $pathViewHelp, $permisos) {
        $pathView = APPPATH . $pathView;
        $pathViewTmp = APPPATH . $pathViewTmp;
        $pathViewHelp = APPPATH . $pathViewHelp;
        $html = file_get_html($pathView, $use_include_path = false, $context = null, $offset = -1, $maxLen = -1, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = false, $defaultBRText = DEFAULT_BR_TEXT);
        $htmlHelp = file_get_html($pathViewHelp, $use_include_path = false, $context = null, $offset = -1, $maxLen = -1, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = false, $defaultBRText = DEFAULT_BR_TEXT);
        //$this->session->userdata('nombreUserLogin');
        $elemsWithRights = $html->find(DEFINE_RIGHT_ALLOWED);
        $encontrado = 0;
        foreach ($elemsWithRights as $elem) {
            foreach ($permisos as $right) {
                if ($elem->id == $right->NombrePermiso) {
                    $encontrado = 1;
                    break;
                } else {
                    
                }
            }
            if ($encontrado == 1) {
                $encontrado = 0;
                continue;
            } else {
                $elem->outertext = '';
            }
        }
        $html->save($pathViewTmp);
    }

    public function listarUsuariosPorRango() {
        try {
            if ($this->input->post()) {
                $final = $this->input->post('data_ini');
                $inicio = ROWS_PER_PAGE;
                if ($final != null) {
                    $final = ($final * ROWS_PER_PAGE) - ROWS_PER_PAGE;
                }
                $Response = array();
                $Usuarios = $this->Usuarios->listarUsuarios($inicio, $final);
                foreach ($Usuarios as $user) {
                    array_push($Response, ($user));
                }
                $responseDef = json_encode($Response);
            }
            echo ($responseDef);
        } catch (Exception $exc) {
            $data = array('Error' => $ex->getMessage());
            echo json_encode($data);
        }
    }

    public function guardarUsuario($codigoUsuario = null) {
        try {
            if ($this->input->post()) {
                $nombrePersonaUsuario = $this->input->post('UsuarioNombreReal');
                $contraseniaUsuario = $this->input->post('UsuarioPassword');
                $comentarios = $this->input->post('Comentarios');
                $correo = $this->input->post('UsuarioEmail');
                $nombreUsuario = $this->input->post('UsuarioNombre');
                $ip = $this->session->userdata('ipUserLogin');
                $userModifica = $this->session->userdata('codigoUserLogin');
                //La fecha de modificaciòn del registro se coloca en el modelo para evitar enviar mas parametros.
                $this->load->model('Usuarios');

                $arrayData = $this->Usuarios->guardarUsuario(null, $nombreUsuario, $contraseniaUsuario, $nombrePersonaUsuario, $correo, $userModifica, $ip, $comentarios);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            $data = array(
                'Error' => $ex->getMessage(),
            );
            echo json_encode($data);
        }
    }

    public function editarUsuario() {
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

    public function eliminarUsuario() {
        $eliminado = false;
        try {
            if ($this->input->post()) {
                $codigo = $this->input->post('CodigoUsuario');
                $eliminado = $this->Usuarios->eliminarUsuario($codigo);
                echo $eliminado;
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function rolByUsr() {
        try {
            if ($this->input->post()) {
                $codigo = $this->input->post('cod_usr');
                if ($codigo != null) {
                    $rolesList = $this->Rol->listarRoles();
                    //Asignacion del array de roles al nuevo arreglo
                    $RolesByUser = $this->Usuarios->getRolesByUsr($codigo);

                    foreach ($rolesList as $rol) {
                        ?> 
                        <tr  id="tr<?php echo $rol->CodigoRol ?>">
                            <td class="nombre_Rol" ><?= $rol->NombreRol ?></td>
                            <td style="text-align:center"  class="gestion_UserR">

                                <input class='checkR'  data-rold='<?php echo json_encode($rol) ?>' type="checkbox" <?php
                                       foreach ($RolesByUser as $ru) {
                                           if ($ru->CodigoRol == $rol->CodigoRol) {
                                               ?>checked="true"<?php
                                           }
                                       }
                                       ?> value="">
                            </td>
                        </tr>
                        <?php
                    }
                }
            } else {
                
            }
        } catch (Exception $exc) {
            echo json_encode($exc);
        }
    }

    public function AplyRmvRols() {
        try {
            if ($this->input->post()) {
                if ($this->input->post('rolesUserSelect')) {

                    $requestArray = (($this->input->post('rolesUserSelect')));
                    $codeUser = $this->Usuarios->insertDeleteRolesUser($requestArray);
                    echo $codeUser;
                } else {
                    
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
