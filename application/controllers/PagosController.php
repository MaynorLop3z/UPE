<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include(APPPATH . 'libraries/simple_html_dom.php');

//include(APPPATH . 'libraries/UtilidadesWeb.php');

class PagosController extends CI_Controller {

    public function __construct() {
        try {
            parent::__construct();
            $this->load->database();
            $this->load->model('Pagos');

            $this->load->library('utilidadesWeb');
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function index() {
        try {
            //$data['Usuarios'] = $this->Usuarios->listarUsuarios(null, null);
            //$data['RolesList'] = $this->Rol->listarRoles();

            $data['RowsPorPag'] = ROWS_PER_PAGE;
            $data['ToTalRegistros'] = 0;
//            $data['ToTalRegistros'] = $this->Usuarios->countAllUsers();
            $data['PagInicial'] = 1;

            // $data['totalPaginas'] = $this->getTotalPaginas();
            $data['totalPaginas'] = 0;

            // $permisos = $this->session->userdata('permisosUsuer');
            //$this->analizarPermisos('views/Usuarios/UsuariosTab.php', 'views/Usuarios/UsuariosTabTmp.php', $permisos);
//           
//            $data['buttonsByUserRights'] = $this->analizarPermisosBotonesTablas("gestionUserBtn", $permisos);
            $this->load->view('Pagos', $data);
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
            $Alumnos = array();

            if ($this->input->post()) {
                if ($this->input->post('data_ini') != null) {
                    $pagAct = $this->input->post('data_ini');
                    $final = $this->input->post('data_ini');

                    if ($pagAct <= 0) {
                        $pagAct = 1;
                        $final = 1;
                    } else if ($pagAct > $this->getTotalPaginas()) {
                        $pagAct = $this->getTotalPaginas();
                        $final = $this->getTotalPaginas();
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
                        $pagAct = $this->getTotalPaginas();
                        $final = $this->getTotalPaginas();
                    } else {
                        
                    }
                } else {
                    $pagAct = 1;
                    $final = 1;
                }
            }
            $inicio = ROWS_PER_PAGE;
            $final = ($final * ROWS_PER_PAGE) - ROWS_PER_PAGE;
            if ($Users != null) {

                array_push($Alumnos, $Users);
            } else {
                $Alumnos = $this->Usuarios->listarUsuarios($inicio, $final);
            }

            $buttonsByUserRights = $this->analizarPermisosBotonesTablas("gestionUserBtn", $this->session->userdata('permisosUsuer'));

            $cadena.='<table id=' . '"tableParticipantesPag"' . 'class="table table-bordered table-striped table-hover table-responsive"' . '>';
            $cadena.='<thead>
                <tr>
                    <th style="text-align:center">Nombre</th>
                   
                </tr>
            </thead> 
            <tbody>';
            foreach ($Alumnos as $user) {
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
               <li><button data-datainic="1" id="aFirstPag" >&lt;&lt;</button></li>
                <li><button id="aPrevPag" >&lt;</button></li>
                <li><input data-datainic="' . $pagAct . '" type="text" value="' . $pagAct . '" id="txtPagingSearchUsr" name="txtNumberPag" size="5">/' . $this->getTotalPaginas() . '</li>
                 <li><button id="aNextPag">&gt;</button></li>
                <li><button id="aLastPag" data-datainic="' . $this->getTotalPaginas() . '" >&gt;&gt;</button></li>
                <li>[' . ($final + 1) . ' - ' . ($final + count($Alumnos)) . ' / ' . $this->Usuarios->countAllUsers() . ']</li></ul></div>';
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

//para pagos
    public function buscarAlum() {
        try {
            if ($this->input->post()) {

                $nombre = $this->input->post('NombreParticipan');
                $carnet = $this->input->post('CarnetParticipan');
                $dui = $this->input->post('DuiParticipan');
                $anio = $this->input->post('AnioParticipan');
                $listaAlum = '';
                $Alumnos = $this->Pagos->listarUsuariosPagosPorLike($nombre, $carnet, $dui, $anio);

                $listaAlum.='<table id=' . '"tableParticipantesPag"' . 'class="table table-bordered table-striped table-hover table-responsive"' . '>';
                $listaAlum.='<thead><tr>
                          <th style="text-align:center;font-size: large">Nombre</th>
                          <th style="text-align:center;font-size: large">Diplomado</th>
                          <th style="text-align:center;font-size: large">Modulo</th>
                          <th style="text-align:center;font-size: large">Estado</th>
                          </tr>
                          </thead> 
                          <tbody>';
                foreach ($Alumnos as $alum) {
                    $listaAlum.='<tr onclick="detallarPago(' . $alum->CodigoGruposParticipantes . ')" data-userpd=' . ($alum->CodigoGruposParticipantes) . ' id="trAlum' . $alum->CodigoGruposParticipantes . '">';
                    $listaAlum.=' <td style="font-size: large;cursor:pointer" class="nombre_Usuario" >' . $alum->Nombre . '</td> ';
                    $listaAlum.=' <td style="font-size: large;cursor:pointer" class="nombre_Usuario" >' . $alum->NombreDiplomado . '</td> ';
                    $listaAlum.=' <td style="font-size: large;cursor:pointer" class="nombre_Usuario" >' . $alum->NombreModulo . '</td>';
                    if ($alum->NumeroRecibo != null) {
                        $listaAlum.=' <td style="font-size: large;cursor:pointer" class="nombre_Usuario" >CANCELADO</td> </tr>';
                    } else {
                        $listaAlum.=' <td style="font-size: large;cursor:pointer" class="nombre_Usuario" >PENDIENTE</td> </tr>';
                    }
                }

                $listaAlum.='</tbody></table>';
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        echo $listaAlum;
    }

    public function buscarPagoDet() {
        try {
            if ($this->input->post()) {
                $codGpart = $this->input->post('codUser');

                $Resultado = $this->Pagos->buscarPagoDet($codGpart);
                foreach ($Resultado as $resul) {

                    $data['FechaIniP'] = $resul->FechaInicioPeriodo;
                    $data['FechaFinP'] = $resul->FechaFinPeriodo;
                    $data['MontoPago'] = $resul->MontoPago;
                    $data['NumeroRecibo'] = $resul->NumeroRecibo;
                    $data['Aula'] = $resul->Aula;
                    $data['HoraEntrada'] = $resul->HoraEntrada;
                    $data['HoraSalida'] = $resul->HoraSalida;
                }
               
                $response = $this->load->view('Pagos/PagosModal', $data, TRUE);
                echo $response;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
