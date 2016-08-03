<!--
    Tab de Archivos en el Dashboard
-->
 
<!--Tab Grupos-->
 <h3>Gestión de archivos</h3>
 <ul class="nav nav-tabs">
    <?php foreach ($gruposMaestro as $grup) { //Lista cada grupo como tabs
        ?>
     <li >
         <a href="#grupo<?=$grup->CodigoGrupoPeriodo?>" data-toggle="tab" title="<?php echo $grup->NombreCategoriaDiplomado?> " >
             Grupo <?php echo $grup->CodigoGrupoPeriodo."(".str_split($grup->FechaInicioPeriodo,7)[0].")" ?> - <?php echo $grup->NombreModulo?> 
             <span class="badge">
             <?php 
                $total=0;
                foreach ($archivosMaestro as $arch) { //numero de archivos por grupo
                 if($arch->CodigoGrupoPeriodo== $grup->CodigoGrupoPeriodo){
                     $total++;
                 }
                }
                echo $total; //Total de archivos que se muestra en el tab
              ?>     
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
      <div <?php echo $idhome?>>
        <div class="btn btn-group">
          <button href="#NuevoArchivo"  class="btn btn-default btn-default" data-toggle="modal">Subir Nuevo Archivo</button>
        </div>
      </div>  
    <table id="tableTitulo"  class="table table-bordered table-striped table-hover table-responsive">
        <thead>
            <tr><!--Informacion a mostrar de las publicaciones-->
                <th>Titulo</th>
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
             $tamar=filesize('bootstrap'.$arch->Ruta);
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
                    <td class="Titulo"><?php echo $arch->Titulo ?></td>
                    <td class="Publicado"><?php echo $arch->FechaPublicacion ?></td>
                    <td class="TipoArchivo"><?php echo strtoupper($arch->Extension) ?></td>
                    <td class="TipoArchivo"><?php echo $tamar; ?></td>
                    <td class="gestion_dip" >
                        <button id="downArc<?php echo $arch->CodigoPublicacion ?>" onclick="<?php echo base_url() ?>index.php/ArchivosController/downloads/<?php echo $arch->Nombre?>"  title="Descargar Archivo" class="btndeldip btn btn-warning" class="btn btn-info btn-lg"><span class=" glyphicon glyphicon-download-alt"></span></button>
                        <button id="deleArc<?php echo $arch->CodigoPublicacion ?>" onclick=""  title="Eliminar Archivo" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
            </tr>
        <?php }
        }
    ?>         
        </tbody>
    </table>  
  </div>
<?php } ?> 
</div>
<!--Fin Lista de Archivos-->
