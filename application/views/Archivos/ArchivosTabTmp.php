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
  <div id="grupo<?php echo $grup->CodigoGrupoPeriodo?>" class="<?php echo $classgroup?>" >
      <h3>Administrar archivos del grupo</h3>
      <div no numeric noise key 1084>
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
       
});

    function openListaArchivos(mod){
        var modale="#ListArchivosAlumno"+mod;
            $(modale).modal();
    }

    function goArchivo(arch){
    location.href = arch;
    }
</script>