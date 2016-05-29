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
            $this->analizarPermisos('views/Usuarios/UsuariosTab.php', 'views/Usuarios/UsuariosTabTmp.php', $permisos);
//           
            $data['buttonsByUserRights'] = $this->analizarPermisosBotonesTablas("gestionUserBtn", $permisos);
            $this->load->view('Usuario', $data);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function analizarPermisos($pathView, $pathViewTmp, $permisos) {
        $pathView = APPPATH . $pathView;
        $pathViewTmp = APPPATH . $pathViewTmp;

        $html = file_get_html($pathView, $use_include_path = false, $context = null, $offset = -1, $maxLen = -1, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = false, $defaultBRText = DEFAULT_BR_TEXT);
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

    function analizarPermisosBotonesTablas($idBtnsGestion, $permisos) {
        $pathView = APPPATH . 'views/VistaAyudaView.php';
        $html = file_get_html($pathView);
        //param=gestionUserBtn
        $elemsWithRights = $html->getElementById($idBtnsGestion);
        $encontrado = 0;

        foreach ($elemsWithRights->find('button') as $key) {
            foreach ($permisos as $right) {
//                $key = $elemsWithRights->find('button[class="' . $right->NombrePermiso . '"]');
                if (explode(" ", $key->class)[0] == $right->NombrePermiso) {
                    $encontrado = 1;
                    break;
                } else {
                    
                }
            }
            if ($encontrado == 1) {
                $encontrado = 0;
                continue;
            } else {
                $key->outertext = '';
            }
        }
        //}
        return str_get_html($elemsWithRights);
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
                $user = $this->Usuarios->guardarUsuario(null, $nombreUsuario, $contraseniaUsuario, $nombrePersonaUsuario, $correo, $userModifica, $ip, $comentarios);

                if ($user != null) {
                    echo $this->paginUsers();
                }
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

    public function paginUsers() {
        try {
            $final = 0;
            $pagAct = 0;
            $cadena = '';
            $filas = '';
            if ($this->input->post()) {
                if ($this->input->post('data_ini') != null) {
                    $pagAct = $this->input->post('data_ini');
                    $final = $this->input->post('data_ini');
                } else {
                    $pagAct = 1;
                    $final = 1;
                }
            }
            $inicio = ROWS_PER_PAGE;
            $final = ($final * ROWS_PER_PAGE) - ROWS_PER_PAGE;
            $Usuarios = $this->Usuarios->listarUsuarios($inicio, $final);
            $buttonsByUserRights = $this->analizarPermisosBotonesTablas("gestionUserBtn", $permisos = $this->session->userdata('permisosUsuer'));

            $cadena .= '<table id=' . '"tableUsers"' . 'class="table table-bordered table-striped table-hover table-responsive"' . '>';
            $cadena.='<thead>
                <tr>
                    <th style="text-align:center">Nombre</th>
                    <th style="text-align:center" >Correo</th>
                    <th style="text-align:center" >Usuario</th>
                    <th style="text-align:center" >Gestionar</th>
                </tr>
            </thead> 
            <tbody>';
            foreach ($Usuarios as $user) {
                $filas.='<tr data-userd=' . ($user->CodigoUsuario) . ' id="tr' . $user->CodigoUsuario . '">';
                $filas.=' <td class="nombre_Usuario" >' . $user->Nombre . '</td>';
                $filas.=' <td class="correo_Usuario" >' . $user->CorreoUsuario . '</td>';
                $filas.=' <td class="nickName_Usuario" >' . $user->NombreUsuario . '</td>';
                $filas.=' <td style="text-align:center"  class="gestion_User">' . $buttonsByUserRights . '</td> </tr>';
            }
            $cadena.=$filas;
            $cadena.='</tbody></table>';
            $cadena.=' <div class="row">
            <ul class="pager">
                <li><a href="#">&lt;&lt;</a></li>
                <li><a href="#">&lt;</a></li>
                <li><input data-datainic="' . $pagAct . '" type="text" value="' . $pagAct . '" id="txtPagingSearchUsr" name="txtNumberPag" size="5">/' . intval(ceil($this->Usuarios->countAllUsers() / ROWS_PER_PAGE)) . '</li>
                <li><a href="#">&gt;</a></li>
                <li><a href="#">&gt;&gt;</a></li>
                <li>[' . ($final + 1) . ' - ' . ($final + count($Usuarios)) . ' / ' . $this->Usuarios->countAllUsers() . ']</li></ul></div>';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($this->input->post('data_ini')) {
            echo ($cadena);
        } else {
            return $cadena;
        }
    }

    public function getUsrByCod($codigoUsuario=null) {
        $codigoUsr=null;
        if ($this->input->post('codUser')) {
            $codigoUsr = $this->input->post('codUser');
        } else {
            $codigoUsr = $codigoUsuario;
        }
        $user = $this->Usuarios->findUsuario($codigoUsr);
        if ($user != null && $this->input->post('codUser')!=null ) {
            echo json_encode($user);
        }else if ($user != null && $this->input->post('codUser')==null){
            return $user;
        }
    }

}
