<?php $this->load->helper('url'); ?>

<div id="AdministrarCalificaciones" class="decorateStyleCrud"><!----------Calificaciones Maestro --------->
    <script src="../bootstrap/js/Calificaciones.js"></script>
    <script src="../bootstrap/js/jquery.maskMoney.js"></script>
    
     <div class="panel-heading well">
        <h3 class="panel-title">Administrar Calificaciones</h3>
     </div>
     <ul class="nav nav-tabs">
        <?php foreach ($gruposMaestro as $grup) { //Lista cada grupo como tabs
            ?>
         <li >
             <a href="#grupoCalificacionesM<?=$grup->CodigoGrupoPeriodo?>" data-toggle="tab" title="<?php echo $grup->NombreDiplomado?> " >
                 Grupo <?php echo $grup->CodigoGrupoPeriodo."(".str_split($grup->FechaInicioPeriodo,7)[0].")" ?> - <?php echo $grup->NombreModulo?> 
                 <?php 
                    $total=0;
                    foreach ($alumnosMaestro as $arch) { //numero de alumnos por grupo
                     if($arch->CodigoGrupoPeriodo== $grup->CodigoGrupoPeriodo){
                         $total++;
                     }
                    }//Total de alumnos que se muestra en el tab
                  ?> 
                 <span class="badge" id="badge-grupoCalificacionesM<?php echo $grup->CodigoGrupoPeriodo?>"><?php echo $total?>
                 </span>
             </a>
         </li>
        <?php } ?> 
     </ul> 
    <!-- Fin tab Grupos-->

    <!--Lista de Alumnos del Maestro-->
    <div class="tab-content">
        <?php 
             $principal=1;                          //propiedades si es tab principal
             $classgroup="tab-pane fade in active";
             $idhome ="";

        foreach ($gruposMaestro as $grup) { //Lista cada grupo
            $numAl =0;
            $grupom = $grup->CodigoGrupoPeriodo;
              if($principal!=1){
              $classgroup="tab-pane fade";     //propiedades para tabs ocultos
              $idhome ="id=\"homeCalificacionesM\" class=\"tab-pane fade in active\"";
                }?>
      <div id="grupoCalificacionesM<?php echo $grup->CodigoGrupoPeriodo?>" class="<?php echo $classgroup?>" >
          <div no numeric noise key 1056>
            
          </div>  
        <table id="table-CalificacionesM<?php echo $grup->CodigoGrupoPeriodo?>"  class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr><!--Informacion a mostrar -->
                    <th>#</th>
                    <th>Alumno</th>
                    <th>Calificación</th>
                    <th>Acción</th>
                </tr>
            </thead> 
            <tbody id="CalificacionesGrupoM<?php echo $grup->CodigoGrupoPeriodo;?>">

        <?php $principal=0;
            $cont=1;
            foreach ($alumnosMaestro as $alu) { //Listar cada archivo
             if($alu->CodigoGrupoPeriodo== $grup->CodigoGrupoPeriodo){
                 $numAl++;
                 $dis="";
                 if($alu->CalificacionModulo>0){
                     $dis='disabled=""';
                 }
                 ?>
                <tr  data-dipd='<?php echo json_encode($alu) ?>' 
                     id="calif<?php echo $alu->CodigoGruposParticipantes ?>" >
                        <td ><?php echo $cont ?></td>
                        <td ><?php echo $alu->Nombre?></td>
                        <td ><input type="text" size="4" id="calificacion<?=$alu->CodigoGruposParticipantes?>" value="<?=$alu->CalificacionModulo?>"  class="calificacion"></td>
                        <td class="gestion_dip" style="width:150px;">
                            <button id="btnGuardarCalificacion<?php echo $alu->CodigoGruposParticipantes ?>" onclick="guardarC('<?php echo $alu->CodigoGruposParticipantes?>')" title="Guardar" class="btndeldip btn btn-success"><span class="glyphicon glyphicon-save"></span></button>
                            <button id="btnEditarCalificacion<?php echo $alu->CodigoGruposParticipantes ?>" onclick="editarC('<?php echo $alu->CodigoGruposParticipantes?>')" disabled="disabled" title="Editar" class="btndeldip btn btn-info"><span class="glyphicon glyphicon-edit"></span></button>
                        </td>
                </tr>
               <?php 
                $cont++;
              }
               
            }
            ?>   
            </tbody>
        </table>  
      </div>
    <?php } ?> 
    </div>

</div><!----------Fin Calificaciones Maestro --------->


<div id="HistoricoCalificacionesAlumno" ><!-------Calificaciones de Alumno------->

 <!------Lista de Anios tabs---------->
 <ul class="nav nav-tabs"> 
    <?php 
    if(isset($gruposAlumno)){
    $Aniog='';
    foreach ($gruposAlumno as $grup) { //Lista cada grupo tabs
        $AnioPeriodo=str_split($grup->FechaInicioPeriodo,4)[0];
        if($Aniog!=$AnioPeriodo){?>
     <li >
         <a href="#grupoCalificaciones<?php echo $AnioPeriodo?>" data-toggle="tab" >
             Año <?php echo $AnioPeriodo?>
         </a>
     </li>
    <?php $Aniog=$AnioPeriodo; } 
    }?> 
 </ul>
 <!------ Fin Lista de Anios tab---------->
   
  <!----Lista de Anios---->
  <div class="tab-content">
    <?php 
        $Aniogrupo='';
        $principalA=1; //propiedades si es tab principal
        $classgroupA="tab-pane fade in ";
        $idhomeA ="";
    foreach ($gruposAlumno as $grupo) { //Lista cada grupo
        
        $AnioActual=str_split($grupo->FechaInicioPeriodo,4)[0];//obtener anio para comparar
        if($Aniogrupo!=$AnioActual){ //separa grupos por anios
            if($principalA!=1){
                $classgroupA="tab-pane fade";     //propiedades para tabs ocultos
                $idhomeA ="id=\"homeCalificaciones\" class=\"tab-pane fade in active\"";
            }?>

    <div id="grupoCalificaciones<?php echo $AnioActual?>" class="<?php echo $classgroupA?>" >
        <div no numeric noise key 1033>
            <h3>Calificaciones del Año <?php echo $AnioActual;?></h3>
        </div>
            <?php 
            $DiplomadoGrupo='';
            foreach($gruposAlumno as $grup){ //lista los diplomados del anio seleccionado
                $DiplomadoActual=$grup->NombreDiplomado;
                
                if($AnioActual==str_split($grup->FechaInicioPeriodo,4)[0] & $DiplomadoGrupo!=$DiplomadoActual){
                ?>
                
                <ul class="list-group">
                    <!--------DIPLOMADOS----->
                    <li style="color:#FFFFFF;background-color:#428bca;" data-nodeid="0" class="arbol-toggler list-group-item node-treeview5 node-selected">
                        <span class="icon expand-icon glyphicon glyphicon-chevron-down"></span>
                        <span class="icon node-icon glyphicon glyphicon-bookmark"></span>
                         <?php echo $DiplomadoActual;?>  
                        
                    </li>
                    
                    <!-----------Modulos-------------->
                    <ul class="arbol node-treeview5">
                        <?php 
                        $ModuloGrupo='';
                        foreach($gruposAlumno as $gru){ //lista los grupos del diplomado seleccionado
                            $ModuloActual=$gru->NombreModulo;

                            if($AnioActual==str_split($gru->FechaInicioPeriodo,4)[0] & $DiplomadoActual==$gru->NombreDiplomado  ){
                            ?>
                        <li id="grupoPeriodoCalificacion<?php echo $gru->CodigoGrupoPeriodo;?>" data-nodeid="1" class="sub-arbol-toggler list-group-item node-treeview5">
                            <span class="icon expand-icon glyphicon glyphicon-chevron-right"></span>
                            <span class="icon node-icon glyphicon glyphicon-bookmark"></span>
                            <?php echo $gru->NombreModulo;?>
                            <span style="color: #18bc9c;margin-left:20px;"> 
                            Inicio: <?php echo str_split($gru->FechaInicioPeriodo,5)[1];?> - Fin: <?php echo str_split($gru->FechaFinPeriodo,5)[1];?>
                            <br /><span style="margin-left:20px;margin-right: 20px;">Grupo <?php echo $gru->CodigoGrupoPeriodo ?></span>
                            </span>
                            <?php 
                                $nota="Cancelado";
                                if($gru->CodigoGruposParticipantes!=NULL){
                                    if($gru->CalificacionExiste=="t"){
                                        $nota="Calificación: ".$gru->CalificacionModulo;
                                    }else{
                                        $nota="La calificación aun no ha sido publicada";
                                    }
                                }else{
                                    $nota="Debe cancelar la cuota para ver su calificación.";
                                }
                              ?> 
                            <span class="badge" id="badge-calificaciones<?php echo $gru->CodigoGrupoPeriodo?>">
                                <?php 
                                echo $nota;
                                ?> 
                            </span>
                        </li>
  
                        <?php }
                        $ModuloGrupo=$ModuloActual;
                         }
                         $DiplomadoGrupo=$DiplomadoActual;
                         ?>   
                    </ul>
                    <!------fin modulos-------------->
                </ul>
                <!-------fin DIPLOMADOS--------->
            
            <?php }
            }  ?> 
    </div><?php
            
            $Aniogrupo=$AnioActual;
         $principal=0;   
        } //fin separa grupos por anio
         

     }//fin lista cada grupo
    
    }?>
   </div>
   <!---- Fin lista Anios---->
</div><!--Fin Calificaciones Alumno-->  
  
  
<script type="text/javascript">
    //eventos de arboles de archivos
    $(document).ready(function () {
//        $('.sub-sub-arbol').toggle(false).css('cursor','pointer');
        $('.arbol').toggle(false);
//        $('.arbol').css('cursor', 'pointer');
//        $('.sub-arbol').toggle(false).css('cursor','pointer');
        $('.arbol-toggler').css('cursor', 'pointer').hover(function(){
            $(this).css('background','#0066ae');
        },function(){
            $(this).css('background','rgb(66, 139, 202)');
        });
        
	$('.arbol-toggler').click(function () {
		$(this).parent().children('.arbol').toggle(300);
	});
        $('.sub-arbol-toggler').click(function () {
		$(this).parent().children('.sub-arbol').toggle(300);
	});
        $('.sub-sub-arbol-toggler').click(function () {
		$(this).parent().children('.sub-sub-arbol').toggle(300);
	});
        
    });

</script>