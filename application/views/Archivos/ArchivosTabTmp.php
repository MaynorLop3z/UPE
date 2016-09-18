<!--
    Tab de Archivos en el Dashboard
-->
 <?php $this->load->helper('url'); ?> 
 <script src="../bootstrap/js/Comentarios.js"></script>
 <link href="../bootstrap/css/archivos.css" rel="stylesheet">
 <script src="../bootstrap/js/jquery.twbsPagination.min.js"></script>



<!------------------------------------------------------------------->
<div id="HisArchivosAlumno" class="treeview decorateStyleCrud">
<!-----------------Lista de Archivos del Alumno---------------------->
 <ul class="nav nav-tabs"> <!------MUESTRA EL TAB DE ANIOS---------->
    <?php 
    if(isset($gruposAlumno)){
    $Aniog='';
    foreach ($gruposAlumno as $grup) { //Lista cada grupo como tabs
        $AnioPeriodo=str_split($grup->FechaInicioPeriodo,4)[0];
        if($Aniog!=$AnioPeriodo){?>
     <li >
         <a href="#grupo<?php echo $AnioPeriodo?>" data-toggle="tab" >
             Año <?php echo $AnioPeriodo?>
         </a>
     </li>
    <?php $Aniog=$AnioPeriodo; } 
    }?> 
 </ul> <!------ FIN MUESTRA EL TAB DE ANIOS---------->
   
 <!----LISTA POR ANIOS---->
  <div class="tab-content">
    <?php 
        $Aniogrupo='';
        $principalA=1;                          //propiedades si es tab principal
        $classgroupA="tab-pane fade in ";
        $idhomeA ="";
    foreach ($gruposAlumno as $grupo) { //Lista cada grupo como tabs
        
        $AnioActual=str_split($grupo->FechaInicioPeriodo,4)[0];
        if($Aniogrupo!=$AnioActual){
            if($principalA!=1){
                $classgroupA="tab-pane fade";     //propiedades para tabs ocultos
                $idhomeA ="id=\"home\" class=\"tab-pane fade in active\"";
            }?>

    <div id="grupo<?php echo $AnioActual?>" class="<?php echo $classgroupA?>" >
        <div no numeric noise key 1043>
            <h3>Diplomados - Año <?php echo $AnioActual;?></h3>
         </div>
            <?php 
            $DiplomadoGrupo='';
            foreach($gruposAlumno as $grup){ //lista los diplomados del anio seleccionado
                $DiplomadoActual=$grup->NombreDiplomado;
                
                if($AnioActual==str_split($grup->FechaInicioPeriodo,4)[0] & $DiplomadoGrupo!=$DiplomadoActual){
                ?>
                
                <ul class="list-group">
                    <!--------DIPLOMADOS----->
                    <li style="color:#FFFFFF;background-color:#428bca;" data-nodeid="0" class="tree-toggler list-group-item node-treeview5 node-selected">
                        <span class="icon expand-icon glyphicon glyphicon-chevron-down"></span>
                        <span class="icon node-icon glyphicon glyphicon-bookmark"></span>
                         <?php echo $DiplomadoActual;?>  
                        
                    </li>
                     <!-------fin DIPLOMADOS--------->
                    <!-----------Modulos-------------->
                    <ul class="tree node-treeview5">
                        <?php 
                        $ModuloGrupo='';
                        foreach($gruposAlumno as $gru){ //lista los grupos del diplomado seleccionado
                            $ModuloActual=$gru->NombreModulo;

                            if($AnioActual==str_split($gru->FechaInicioPeriodo,4)[0] & $DiplomadoActual==$gru->NombreDiplomado  ){
                            ?>
                         <li id="ga<?php echo $gru->CodigoGrupoPeriodo;?>" onclick="openListaArchivos('<?php echo $gru->CodigoGrupoPeriodo;?>')" data-nodeid="1" class="sub-tree-toggler list-group-item node-treeview5">
                            <span class="icon expand-icon glyphicon glyphicon-chevron-right"></span>
                            <span class="icon node-icon glyphicon glyphicon-bookmark"></span>
                            <?php echo $gru->NombreModulo;?>
                            <span style="color: #18bc9c;margin-left:20px;"> 
                            Inicio: <?php echo str_split($gru->FechaInicioPeriodo,5)[1];?> - Fin: <?php echo str_split($gru->FechaFinPeriodo,5)[1];?>
                            <br /><span style="margin-left:20px;margin-right: 20px;">Grupo <?php echo $gru->CodigoGrupoPeriodo ?></span>
                            </span>
                            <?php 
                                $total=0;
                                foreach ($archivosAlumno as $arch) { //numero de archivos por grupo
                                 if($arch->CodigoGrupoPeriodo== $gru->CodigoGrupoPeriodo){
                                     $total++;
                                 }
                                }//Total de archivos que se muestra en el tab
                              ?> 
                             <span class="badge" id="badge-grupo<?php echo $gru->CodigoGrupoPeriodo?>"><?php echo $total?> Archivos
                             </span>
                        </li>
                            <!---------Modal Archivos Alumno-------------------------->
                            
                            <div id="ListArchivosAlumno<?php echo $gru->CodigoGrupoPeriodo;?>" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
                                
                                    <div class="modal-content">
                                        <div class="container-fluid">
                                             <button type="button" class="close btn-lg" data-dismiss="modal"  aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                                             <!--Lista de Archivos del Alumno-->
                                            <div id="ArchivosAlumnosContent" class="tab-content">
                                            <h3>Archivos subidos al grupo</h3>
                                                <table id="table-ga<?php echo $gru->CodigoGrupoPeriodo?>"  class="table table-bordered table-striped table-hover table-responsive">
                                                    <thead>
                                                        <tr><!--Informacion a mostrar de las publicaciones-->
                                                            <th>Archivo</th>
                                                            <th>Descripción</th>
                                                            <th>Fecha de Publicación</th>
                                                            <th>Tipo de Archivo</th>
                                                            <th>Tamaño</th>
                                                            <th>Descargar</th>
                                                        </tr>
                                                    </thead> 
                                                    <tbody id="ArchivosGrupoAlumnoContent<?php echo $gru->CodigoGrupoPeriodo;?>">
                                                    </tbody>
                                                </table>  
                                              </div>

                                            </div>
                                    </div>
                                </div>
                            
                            <!--Fin Lista de Archivos del Alumno-->
                        <?php }
                        $ModuloGrupo=$ModuloActual;
                         }
                         $DiplomadoGrupo=$DiplomadoActual;
                         ?>   
                    </ul>
                    <!------fin modulos-------------->
                </ul>
               
            
            <?php }
            }  ?> </div><?php
            
            $Aniogrupo=$AnioActual;
         $principal=0;   
        } 
         

     }
    // <!---- FIN LISTA POR ANIOS---->
    }?>
</div>
    <!--end Archivos Alumno-->
    </div>
    
  
<script type="text/javascript">
    //eventos de arboles de archivos
    $(document).ready(function () {
        $('.sub-sub').toggle(false).css('cursor','pointer');
        $('.tree').toggle(false);
        $('.tree').css('cursor', 'pointer');
        $('.sub-tree').toggle(false).css('cursor','pointer');
        $('.tree-toggler').css('cursor', 'pointer');
        
	$('.tree-toggler').click(function () {
		$(this).parent().children('.tree').toggle(300);
	});
        $('.sub-tree-toggler').click(function () {
		$(this).parent().children('.sub-tree').toggle(300);
	});
        $('.sub-sub-toggler').click(function () {
		$(this).parent().children('.sub-sub').toggle(300);
	});
        $('.modal-content, .container-fluid, .table, .modal, .fade').css('cursor','default');
        
});
    function openListaArchivos(mod){
        var posting = $.post("ArchivosController/ArchivosGrupoAlumno/", {opcion:mod});
        posting.done(function (data) {
            if (data !== null) {
                $('#ArchivosGrupoAlumnoContent'+mod+'').empty();
                $('#ArchivosGrupoAlumnoContent'+mod+'').html(data);
                $('.comment').toggle(false);
                prepararComentarios();
            }
        });
        posting.fail(function (data) {
            alert("Error");
        });
        var modale="#ListArchivosAlumno"+mod;
            $(modale).modal();
    }

    function goArchivo(arch){
    location.href = arch;
    }
</script>