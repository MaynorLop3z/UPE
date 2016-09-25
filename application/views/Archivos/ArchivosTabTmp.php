<!--
    Tab de Archivos en el Dashboard
-->
 <?php $this->load->helper('url'); ?> 
 <script src="../bootstrap/js/Comentarios.js"></script>
 <link href="../bootstrap/css/archivos.css" rel="stylesheet">
 <script src="../bootstrap/js/jquery.twbsPagination.min.js"></script>
 <script src="../bootstrap/js/utils.js"></script>
<div id="ArchivoMaestro" class="decorateStyleCrud">
<!--Tab Grupos-->
 <div class="panel-heading well">
    <h3 class="panel-title">Gestión de Archivos</h3>
 </div>
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
<div class="tab-content">
    <?php 
         $principal=1;                          //propiedades si es tab principal
         $classgroup="tab-pane fade in active";
         $idhome ="";
         
    foreach ($gruposMaestro as $grup) { //Lista cada seccion de grupo
        $numArch =0;
        $grupom = $grup->CodigoGrupoPeriodo;
          if($principal!=1){
          $classgroup="tab-pane fade";     //propiedades para tabs ocultos
          $idhome ="id=\"home\" class=\"tab-pane fade in active\"";
            }?>
  <div id="grupo<?php echo $grup->CodigoGrupoPeriodo?>" class="<?php echo $classgroup?>" >
      <h3>Administrar archivos del grupo</h3>
      <div no numeric noise key 1095>
        <div class="btn btn-group" >
          <button onclick="setVarsOpenModal('<?php echo $grup->CodigoGrupoPeriodo?>',                      '<?php echo $grup->NombreCategoriaDiplomado?>',                      '<?php echo $grup->CodigoCategoriaDiplomado?>',                      '<?php echo $grup->CodigoGruposPeriodoUsuario?>'                      )" class="btn btn-default btn-default" >Subir Nuevo Archivo</button>
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
        <tbody id="ArchivosGrupoMaestroContent<?php echo $grup->CodigoGrupoPeriodo;?>">
  
    <?php $principal=0;
        foreach ($archivosMaestro as $arch) { //Listar cada archivo
         if($arch->CodigoGrupoPeriodo== $grup->CodigoGrupoPeriodo){
             $numArch++;
             if($numArch<=ROWS_PER_PAGE){ //Limita lista al numero de paginacion establecido
             if(file_exists('bootstrap'.$arch->Ruta)){
                $tamar=filesize('bootstrap'.$arch->Ruta); //Formatea el size del archivo
                if($tamar>=1024 & $tamar<1048576){
                    $tamar = round($tamar/1024, 0)." Kb";
                }  else if($tamar >= 1048576) {
                    $tamar = round($tamar/1048576, 2)." Mb";
                }else{
                    $tamar = $tamar." B";
                }
             }else{$tamar="Indeterminado";}
             ?>
            <tr  data-dipd='<?php echo json_encode($arch) ?>' 
                 id="dip<?php echo $arch->CodigoPublicacion ?>" onclick="cargarComentarios('dip<?php echo $arch->CodigoPublicacion ?>')" class="comment-toggler" title="Ver Comentarios">
                    <td class="Archivo"><?php echo $arch->Titulo ?></td>
                    <td class="Descripcion"><?php echo ($arch->Contenido!= NULL ? $arch->Contenido: "No hay descripción") ?></td>
                    <td class="Publicado" ><?php echo $arch->FechaPublicacion ?></td>
                    <td class="TipoArchivo"><?php echo strtoupper($arch->Extension) ?></td>
                    <td class="TamArchivo" style="width:100px;"><?php echo $tamar; ?></td>
                    <td class="gestion_dip" style="width:150px;">
                        <button id="downArc<?php echo $arch->CodigoPublicacion ?>" onclick="goArchivo('<?php echo base_url() ?>index.php/ArchivosController/downloads/<?php echo $arch->Nombre?>')"  title="Descargar Archivo" class="btndeldip btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span></button>
                        <button id="deleArc<?php echo $arch->CodigoPublicacion ?>" onclick="delArchivo('<?php echo $arch->CodigoPublicacion ?>','<?php echo $arch->Titulo ?>','<?=$grup->CodigoGrupoPeriodo?>')"  title="Eliminar Archivo" class="btndeldip btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
            </tr>
            <tr id="comment-dip<?php echo $arch->CodigoPublicacion ?>" class="comment">
                <td class="form-group" colspan="6"> <label for="usr">Comentarios:</label>
                    <input type="text" class="form-control inputComment" placeholder="Escribe un comentario..." >
                    <div class="list-group" id="comment-<?php echo $arch->CodigoPublicacion?>"></div>
                </td>
            </tr>
           <?php 
             }
          }
        }
        $paginas =  intval(ceil($numArch/ ROWS_PER_PAGE));
        if($numArch>ROWS_PER_PAGE){ //Evalua si paginador es necesario
        ?>   
            <tr id="pagerArchivosMaestroGrupo<?php echo $grupom ?>"><td colspan=6>
                <div class="row">
                <ul class="pager" id="footpagerArchivosMaestroGrupo<?php echo $grupom ?>">
                <li><button data-datainic="1" id="aFirstPagArchivosMaestroGrupo<?php echo $grupom ?>" onclick="goFirstPaginMaestro('<?php echo $grupom ?>')" >&lt;&lt;</button></li>
                <li><button id="aPrevPagArchivosMaestroGrupo<?php echo $grupom ?>" onclick="goBackPaginMaestro('<?php echo $grupom ?>')">&lt;</button></li>
                <li><input data-datainic="1" type="text" value="1" id="txtPagingSearchArchivosMaestroGrupo<?php echo $grupom ?>" onkeypress="MaestroGoTo(event, '<?php echo $grupom ?>')" name="txtNumberPag" data-mask="000000000" size="5">/ <?php echo $paginas ?></li>
                <li><button id="aNextPagArchivosMaestroGrupo<?php echo $grupom ?>" onclick="goNextPaginMaestro('<?php echo $grupom ?>')">&gt;</button></li>
                <li><button id="aLastPagArchivosMaestroGrupo<?php echo $grupom ?>" data-datainic=" <?php echo $paginas ?>" onclick="goLastPaginMaestro('<?php echo $grupom ?>')">&gt;&gt;</button></li>
                <li>[1 -  <?php echo $paginas ?> / <?php echo $numArch ?> ]</li></ul></div>'
            </td></tr>
        <?php } ?>
        </tbody>
    </table>  
      <div id="context-menu">
	      	<ul class="dropdown-menu" role="menu">
            <li><a tabindex="-1">Action</a></li>
	           <li><a tabindex="-1">Another action</a></li>
	           <li><a tabindex="-1">Something else here</a></li>
	           <li class="divider"></li>
	           <li><a tabindex="-1">Separated link</a></li>
	      	</ul>
	      </div>
  </div>
<?php } ?> 
</div>

<!--Fin Lista de Archivos del Maestro-->
</div>


<!------------------------------------------------------------------->

    
  
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