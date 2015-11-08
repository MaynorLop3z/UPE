<!------Modal para agregar Publicaciones----------------------------------------------------------------------------------->
<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Publicaciones.js"></script>
<div id="NuevaPublicacion" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid "id="publicacionDiv">
                <!--  <form  class="form-horizontal" id="publicacionForm"  method="post">-->
                <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                <fieldset>
                    <legend class="modal-header"> Nueva Publicacion:</legend> 


                    <div class="form-group" class="form-inline" role="form" id="divPub">

                        <div class="col-lg-9">
                            <!--La linea de abajo abre el selector de imgs -->
                            <!-- <form name="este" id="este" enctype="multipart/form-data" method="post" action="<?php //echo base_url()       ?>index.php/PublicacionesController/do_upload">
                            -->
                            <?php echo form_open_multipart('PublicacionesController/do_upload'); ?> 
                            <label for="DiplomadoNombre" class="col-lg-3 control-label">Titulo</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control"  placeholder="Titulo de la publicacion"  name="titulo">
                            </div>
                            <input type="file"  size="20" name="userfile" >
                            <br><br>
                            <input type="submit" value="upload"  id="uploadImg" name="upload">
                            <br><br>
                            <!--en las lineas de abajo esta el cuerpo de la publicacion-->
                            <label form="DiplomadoCuerpo" class="col-lg-3 control-label">Contenido</label>
                            <textarea rows="5"  placeholder="Contenido" name="contenido" id=""></textarea>
                            <input type="hidden" value="<?php echo base_url() ?>index.php/PublicacionesController/do_upload/" name="escondido">
                            <div class="modal-footer">
                                <button type="reset" id="btnEnviar" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                                <button type="reset" id="btnLimpiar" onclick="" class=" btn btn-default" name="Limpiar" >Limpiar</button>
                                <button  id="btnCerrar" onclick="" class=" btn btn-default" name="Cerrar">Cerrar</button>
                            </div>
                            </form>

                        </div>
                    </div>

                </fieldset>
                <!-- </form>-->
            </div>
        </div>
    </div>
</div>
<script src="../bootstrap/js/Publicaciones.js"></script>