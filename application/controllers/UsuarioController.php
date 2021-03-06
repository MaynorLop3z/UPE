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

            $data['totalPaginas'] = $this->getTotalPaginas();

            $permisos = $this->session->userdata('permisosUsuer');
            $this->analizarPermisos('views/Usuarios/UsuariosTab.php', 'views/Usuarios/UsuariosTabTmp.php', $permisos);
//           
            $data['buttonsByUserRights'] = $this->analizarPermisosBotonesTablas("gestionUserBtn", $permisos);
            $this->load->view('Usuario', $data);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function getTotalPaginas() {
        return $result = intval(ceil($this->Usuarios->countAllUsers() / ROWS_PER_PAGE));
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
//                    echo 'Exito';
                    echo $this->paginUsers(null);
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
                    echo $this->paginUsers($arrayData);
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

    public function paginUsers($Users = null) {
        try {
            $final = 0;
            $pagAct = 0;
            $cadena = '';
            $filas = '';
            $Usuarios = array();

            if ($this->input->post()) {
                if ($this->input->post('data_ini') != null) {
                    $pagAct = $this->input->post('data_ini');
                    $final = $this->input->post('data_ini');
                    
                    if ($pagAct <= 0) {
                        $pagAct = 1;
                        $final = 1;
                    }else if($pagAct > $this->getTotalPaginas()) {
                        $pagAct =$this->getTotalPaginas();
                        $final=$this->getTotalPaginas();
                    }
                    
                } else if ($this->input->post('data_inip') != null) {
                    $pagAct = $this->input->post('data_inip') - 1;
                    $final = $this->input->post('data_inip') - 1;
                    if ($pagAct <= 0) {
                        $pagAct = 1;
                        $final = 1;
                    }
                } else if ($this->input->post('data_inin') != null) {
                    $pagAct = $this->input->post('data_inin');
                    $pagAct+=1;
                    $final = $this->input->post('data_inin');
                    $final+=1;
                    if ($pagAct > $this->getTotalPaginas()) {
                        $pagAct =$this->getTotalPaginas();
                        $final=$this->getTotalPaginas();
                    }  else {
                        
                    }
                } else {
                    $pagAct = 1;
                    $final = 1;
                }
            }
            $inicio = ROWS_PER_PAGE;
            $final = ($final * ROWS_PER_PAGE) - ROWS_PER_PAGE;
            if ($Users != null) {

                array_push($Usuarios, $Users);
            } else {
                $Usuarios = $this->Usuarios->listarUsuarios($inicio, $final);
            }

//            $buttonsByUserRights = $this->analizarPermisosBotonesTablas("gestionUserBtn", $this->session->userdata('permisosUsuer'));
            $cadena .= '<table id=' . '"tableUsers"' . ' class="table table-bordered table-striped table-hover table-responsive"' . '>';
            $cadena.=$this->EncabezadoTabla();
            foreach ($Usuarios as $user) {
                $filas .=$this->cuerpoTabla($user);
            }
            $cadena.=$filas;
            $cadena.='</tbody></table>';
            $cadena.=' <div class="row">
            <ul class="pager">
               <li><button data-datainic="1" id="aFirstPag" >&lt;&lt;</button></li>
                <li><button id="aPrevPag" >&lt;</button></li>
                <li><input data-datainic="' . $pagAct . '" type="text" value="' . $pagAct . '" id="txtPagingSearchUsr" name="txtNumberPag" data-mask="000000000" size="5">/' . $this->getTotalPaginas() . '</li>
                 <li><button id="aNextPag">&gt;</button></li>
                <li><button id="aLastPag" data-datainic="' . $this->getTotalPaginas() . '" >&gt;&gt;</button></li>
                <li>[' . ($final + 1) . ' - ' . ($final + count($Usuarios)) . ' / ' . $this->Usuarios->countAllUsers() . ']</li></ul></div>';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($this->input->post('data_ini') || $this->input->post('data_inin') || $this->input->post('data_inip')) {
            echo ($cadena);
        } else {
            return $cadena;
        }
    }

    public function getUsrByCod($codigoUsuario = null) {
        $codigoUsr = null;
        if ($this->input->post('codUser')) {
            $codigoUsr = $this->input->post('codUser');
        } else {
            $codigoUsr = $codigoUsuario;
        }
        $user = $this->Usuarios->findUsuario($codigoUsr);
        if ($user != null && $this->input->post('codUser') != null) {
            echo json_encode($user);
        } else if ($user != null && $this->input->post('codUser') == null) {
            return $user;
        }
    }

    public function BuscarUsuario(){
        try {
            if($this->input->post()){
                $nombreUs = $this->input->post('FindUsuario');
                $correoUs = $this->input->post('Correo');
                $nickUs = $this->input->post('Nick');
                $Usuarios = $this->Usuarios->listarUsuariosNombre($nombreUs, $correoUs, $nickUs);
                $registro = $this->EncabezadoTabla();
                if(count($Usuarios)>0){
                    foreach ($Usuarios as $user) {
                       $registro .= $this->cuerpoTabla($user);
                    }
                }else{
                    $registro = $this->EncabezadoTabla()."<tr><td colspan=3>No se encontraron coincidencias</td></tr>";
                }
                echo $registro.'</tbody></table>';
            }    
        } catch (Exception $ex) {
           echo json_encode($ex);
        }
    }
    
     private function EncabezadoTabla(){
        $encabezado=' <table id="tableUsers" class="table table-bordered table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th style="text-align:center">Nombre</th>
                        <th style="text-align:center" >Correo</th>
                        <th style="text-align:center" >Usuario</th>
                        <th style="text-align:center" >Gestionar</th>
                    </tr>
                </thead> 
                <tbody>';
        return $encabezado;
    }
    
    private function cuerpoTabla($user){
        $filas='';
        $filas .='<tr data-userd="'. $user->CodigoUsuario .'" id="tr'. $user->CodigoUsuario .'">
                    <td class="nombre_Usuario" >'. $user->Nombre .'</td>
                    <td class="correo_Usuario" >'. $user->CorreoUsuario .'</td>
                    <td class="nickName_Usuario" >'. $user->NombreUsuario .'</td>
                    <td style="text-align:center"  class="gestion_User">
                        '.$this->analizarPermisosBotonesTablas("gestionUserBtn", $this->session->userdata('permisosUsuer')).'
                    </td>
                </tr>';
        return $filas;
    }
}
