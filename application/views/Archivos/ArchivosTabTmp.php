<!--
    Tab de Archivos en el Dashboard
-->
 <?php $this->load->helper('url'); ?> 
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

<!--Lista de Archivos-->
<div class="tab-content">
    <?php 
         $principal=1;                          //propiedades si es tab principal
         $classgroup="tab-pane fade in active";
         $idhome ="";
    foreach ($gruposMaestro as $grup) { //Lista cada seccion de grupo
          if($principal!=1){
          $classgroup="tab-pane fade";     //propiedades para tabs ocultos
          $idhome ="id=\"home\" class=\"tab-pane fade in active\"";
            }?>
  <div id="grupo<?php echo $grup->CodigoGrupoPeriodo?>" class="<?php echo $classgroup?>">
      <h3>Administrar archivos del grupo</h3>
      <div no numeric noise key 1029>
        <div class="btn btn-group" id="frmArchivoNuevo">
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
                        <button id="downArc<?php echo $arch->CodigoPublicacion ?>" onclick="goArchivo('<?php echo base_url() ?>index.php/ArchivosController/downloads/<?php echo $arch->Nombre?>')"  title="Descargar Archivo" class="btndeldip btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span></button>
                        <button id="deleArc<?php echo $arch->CodigoPublicacion ?>" onclick="delArchivo('<?php echo $arch->CodigoPublicacion ?>','<?php echo $arch->Titulo ?>','<?=$grup->CodigoGrupoPeriodo?>')"  title="Eliminar Archivo" class="btndeldip btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
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
<!--Fin Lista de Archivos-->


<div id="treeview5" class="treeview">
    <ul class="list-group">
        <li style="color:#FFFFFF;background-color:#428bca;" data-nodeid="0" class="tree-toggler list-group-item node-treeview5 node-selected">
            <span class="icon expand-icon glyphicon glyphicon-chevron-down"></span>
            <span class="icon node-icon glyphicon glyphicon-bookmark"></span>
            Año 2016
        </li>
        
        <ul class="tree node-treeview5">
            
           <li  style="color:undefined;background-color:undefined;" data-nodeid="1" class="sub-tree-toggler list-group-item node-treeview5">
                <span class="icon expand-icon glyphicon glyphicon-chevron-right"></span>
                <span class="icon node-icon glyphicon glyphicon-bookmark"></span>
                Mongo DB with java
           </li>
              
                <li style="color:undefined;background-color:undefined;" data-nodeid="2" class="sub-tree list-group-item node-treeview5">
                    <span class="indent"></span>
                    <span class="icon glyphicon glyphicon-chevron-down"></span>
                    <span class="icon node-icon"></span>
                    Grupo 1
                </li>
        </ul>
    </ul>
    <ul class="list-group">
        <li style="color:#FFFFFF;background-color:#428bca;" data-nodeid="3" class="tree-toggler list-group-item node-treeview5 node-selected">
            <span class="icon expand-icon glyphicon glyphicon-chevron-down"></span>
            <span class="icon node-icon glyphicon glyphicon-bookmark"></span>
            Año 2015
        </li>
        <ul class="tree node-treeview5">
            <li  style="color:undefined;background-color:undefined;" data-nodeid="4" class="sub-tree-toggler list-group-item node-treeview5">
                <span class="icon expand-icon glyphicon glyphicon-chevron-right"></span>
                <span class="icon node-icon glyphicon glyphicon-bookmark"></span>
                HTML5 + JS
            </li>

                <li style="color:undefined;background-color:undefined;" data-nodeid=5" class="sub-tree list-group-item node-treeview5">
                    <span class="indent"></span>
                    <span class="icon glyphicon"></span>
                    <span class="icon node-icon glyphicon glyphicon-bookmark"></span>
                    Grupo 5
                </li>
        </ul>
        
    </ul>
</div>
        
<script type="text/javascript">
    $(document).ready(function () {
        $('.tree').toggle(false);
        $('.tree').css('cursor', 'pointer');
        $('.sub-tree').toggle(false).css('cursor','default');
        $('.tree-toggler').css('cursor', 'pointer');
        
	$('.tree-toggler').click(function () {
		$(this).parent().children('.tree').toggle(300);
	});
        $('.sub-tree-toggler').click(function () {
		$(this).parent().children('.sub-tree').toggle(300);
	});
});

    function goArchivo(arch){
    location.href = arch;
    }
</script>