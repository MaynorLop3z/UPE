<!--
    Tab de Archivos en el Dashboard
-->
 <?php $this->load->helper('url'); ?> 
<div id="ArchivoMaestro" class="decorateStyleCrud">
<!--Tab Grupos-->
 <h3>Gestión de archivos</h3>
 <ul class="nav nav-tabs">
    <?php foreach ($gruposMaestro as $grup) { //Lista cada grupo como tabs
        ?>
     <li >
         <a href="#grupo<?=$grup->CodigoGrupoPeriodo?>" data-toggle="tab" title="<?php echo $grup->NombreDiplomado?> " >
             Grupo <?php echo $grup->CodigoGrupoPeriodo."(".str_split($grup->FechaInicioPeriodo,7)[0].")" ?> - <?php echo $grup->NombreModulo?> 
             <?php 
                $total=0;
                foreach ($archivosMaestro as $arch) { //numero de archivos por grupo
                 if($arch->CodigoGrupoPeriodo== $grup->CodigoGrupoPeriodo){
                     $total++;
                 }
                }//Total de archivos que se muestra en el tab
              ?> 
             <span class="badge" id="badge-grupo<?php echo $grup->CodigoGrupoPeriodo?>"><?php echo $total?>
             </span>
         </a>
     </li>
    <?php } ?> 
 </ul> 
<!-- Fin tab Grupos-->

<!--Lista de Archivos del Maestro-->
<div class="tab-content ">
    <?php 
         $principal=1;                          //propiedades si es tab principal
         $classgroup="tab-pane fade in active";
         $idhome ="";
    foreach ($gruposMaestro as $grup) { //Lista cada seccion de grupo
          if($principal!=1){
          $classgroup="tab-pane fade";     //propiedades para tabs ocultos
          $idhome ="id=\"home\" class=\"tab-pane fade in active\"";
            }?>
  <div id="grupo<?php echo $grup->CodigoGrupoPeriodo?>" class="<?php echo $classgroup?>" >
      <h3>Administrar archivos del grupo</h3>
      <div <?php echo $idhome?>>
        <div class="btn btn-group" >
          <button onclick="setVarsOpenModal('<?php echo $grup->CodigoGrupoPeriodo?>',
                      '<?php echo $grup->NombreCategoriaDiplomado?>',
                      '<?php echo $grup->CodigoCategoriaDiplomado?>',
                      '<?php echo $grup->CodigoGruposPeriodoUsuario?>'
                      )" class="btn btn-default btn-default" >Subir Nuevo Archivo</button>
        </div>
      </div>  
    <table id="table-g<?php echo $grup->CodigoGrupoPeriodo?>"  class="table table-bordered table-striped table-hover table-responsive">
        <thead>
            <tr><!--Informacion a mostrar de las publicaciones-->
                <th>Archivo</th>
                <th>Descripción</th>
                <th>Fecha de Publicación</th>
                <th>Tipo de Archivo</th>
                <th>Tamaño</th>
                <th>Acción</th>
            </tr>
        </thead> 
        <tbody>
  
    <?php $principal=0;
        foreach ($archivosMaestro as $arch) { //Listar cada archivo
         if($arch->CodigoGrupoPeriodo== $grup->CodigoGrupoPeriodo){ 
             
             $tamar=filesize('bootstrap'.$arch->Ruta); //Formatea el size del archivo
             if($tamar>=1024 & $tamar<1048576){
                 $tamar = round($tamar/1024, 0)." Kb";
             }  else if($tamar >= 1048576) {
                 $tamar = round($tamar/1048576, 2)." Mb";
             }else{
                 $tamar = $tamar." B";
             }
        
             ?>
            <tr  data-dipd='<?php echo json_encode($arch) ?>' 
                     id="dip<?php echo $arch->CodigoPublicacion ?>">
                    <td class="Archivo"><?php echo $arch->Titulo ?></td>
                    <td class="Descripción"><?php echo ($arch->Contenido!= NULL ? $arch->Contenido: "No hay descripción") ?></td>
                    <td class="Publicado" ><?php echo $arch->FechaPublicacion ?></td>
                    <td class="TipoArchivo"><?php echo strtoupper($arch->Extension) ?></td>
                    <td class="TamArchivo" style="width:100px;"><?php echo $tamar; ?></td>
                    <td class="gestion_dip" style="width:150px;">
                        <button id="downArc<?php echo $arch->CodigoPublicacion ?>" onclick="goArchivo('<?php echo base_url() ?>index.php/ArchivosController/downloads/<?php echo $arch->Nombre?>')"  title="Descargar Archivo" class="btndeldip btn btn-warning" class="btn btn-info btn-lg"><span class=" glyphicon glyphicon-download-alt"></span></button>
                        <button id="deleArc<?php echo $arch->CodigoPublicacion ?>" onclick="delArchivo('<?php echo $arch->CodigoPublicacion ?>','<?php echo $arch->Titulo ?>','<?=$grup->CodigoGrupoPeriodo?>')"  title="Eliminar Archivo" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
            </tr>
        <?php 
          }
        }
    ?>         
        </tbody>
    </table>  
  </div>
<?php } ?> 
</div>
<!--Fin Lista de Archivos del Maestro-->
</div>


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
  <div class="tab-content ">
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
        <div <?php echo $idhomeA;?> >
            <h3>Diplomados - Año <?php echo $AnioActual;?></h3>
         </div>
            <?php 
            $DiplomadoGrupo='';
            foreach($gruposAlumno as $grup){ 
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
                        foreach($gruposAlumno as $gru){ 
                            $ModuloActual=$gru->NombreModulo;

                            if($AnioActual==str_split($gru->FechaInicioPeriodo,4)[0] & $DiplomadoActual==$gru->NombreDiplomado  ){
                            ?>
                         <li id="ga<?php echo $gru->CodigoGrupoPeriodo;?>" onclick="openListaArchivos('<?php echo $gru->CodigoGrupoPeriodo;?>')" data-nodeid="1" class="sub-tree-toggler list-group-item node-treeview5 ">
                            <span class="icon expand-icon glyphicon glyphicon-chevron-right"></span>
                            <span class="icon node-icon glyphicon glyphicon-bookmark"></span>
                            <?php echo $gru->NombreModulo;?>
                            <span style="color: #18bc9c;margin-left:20px;"> 
                            Inicio: <?php echo str_split($gru->FechaInicioPeriodo,5)[1];?> - Fin: <?php echo str_split($gru->FechaFinPeriodo,5)[1];?>
                            <span style="margin-left:20px;margin-right: 20px;">Grupo <?php echo $gru->CodigoGrupoPeriodo ?></span>
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
                                        <div class="container-fluid ">
                                             <button type="button" class="close btn-lg" data-dismiss="modal"  aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                                             <!--Lista de Archivos del Alumno-->
                                            <!--<div class="tab-content ">-->
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
                                                    <tbody>

                                                <?php 
                                                    foreach ($archivosAlumno as $arch) { //Listar cada archivo
                                                     if($arch->CodigoGrupoPeriodo== $gru->CodigoGrupoPeriodo){ 
                                                         
                                                         $tamar=filesize('bootstrap'.$arch->Ruta); //Formatea el size del archivo
                                                         
                                                            if($tamar>=1024 & $tamar<1048576){
                                                             $tamar = round($tamar/1024, 0)." Kb";
                                                            }  else if($tamar >= 1048576) {
                                                                $tamar = round($tamar/1048576, 2)." Mb";
                                                            }else{
                                                                $tamar = $tamar." B";
                                                            }

                                                         ?>
                                                        <tr  data-dipd='<?php echo json_encode($arch) ?>' 
                                                                 id="dip<?php echo $arch->CodigoPublicacion ?>">
                                                                <td class="Archivo"><?php echo $arch->Titulo ?></td>
                                                                <td class="Descripción"><?php echo ($arch->Contenido!= NULL ? $arch->Contenido: "No hay descripción") ?></td>
                                                                <td class="Publicado" ><?php echo $arch->FechaPublicacion ?></td>
                                                                <td class="TipoArchivo"><?php echo strtoupper($arch->Extension) ?></td>
                                                                <td class="TamArchivo" style="width:100px;"><?php echo $tamar; ?></td>
                                                                <td class="gestion_dip" style="width:150px;">
                                                                    <button id="downArc<?php echo $arch->CodigoPublicacion ?>" onclick="goArchivo('<?php echo base_url() ?>index.php/ArchivosController/downloads/<?php echo $arch->Nombre?>')"  title="Descargar Archivo" class="btndeldip btn btn-warning" class="btn btn-info btn-lg"><span class=" glyphicon glyphicon-download-alt"></span></button>
                                                                </td>
                                                        </tr>
                                                    <?php 
                                                      }
                                                    }
                                                ?>         
                                                    </tbody>
                                                </table>  
                                              <!--</div>-->

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
       
});

    function openListaArchivos(mod){
        var modale="#ListArchivosAlumno"+mod;
            $(modale).modal();
    }

    function goArchivo(arch){
    location.href = arch;
    }
</script>