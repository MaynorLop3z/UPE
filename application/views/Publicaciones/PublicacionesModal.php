<!------Modal para agregar Publicaciones----------------------------------------------------------------------------------->
<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Publicaciones.js"></script>
<div id="NuevaPublicacion" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid "id="publicacionDiv">
                <!--  <form  class="form-horizontal" id="publicacionForm"  method="post">-->
                <button type="button" class="close btn-lg" data-dismiss="modal" aria-hidden="true">×</button>
                <!--<fieldset>-->
                <legend class="modal-header"> Nueva Publicacion:</legend> 

                <div class="form-group" class="form-inline" role="form" id="divPub">

                    <div class="col-lg-9">
                        <!--La linea de abajo abre el selector de imgs -->
                        <form class="formulario" enctype="multipart/form-data" method="post" action="<?php echo base_url() ?>index.php/PublicacionesController/do_upload/">


                            <input type="file"  size="20" name="archivo" id= "imagen" >
                            <!--div para visualizar mensajes-->
                            <div class="messages"></div><br /><br />
                            <input type="button" value="Subir Imagen" class="btn btn-default" id="subir" />
                            <!--div para visualizar la imagen-->
                            <div class="showImage"></div>
                            <br><br><br>
                        </form>

                        <div>
                            <form class="form-inline" id="botones " action="<?php echo base_url() ?>index.php/PublicacionesController/subirBd/">
                                <!--en las lineas de abajo esta el cuerpo de la publicacion-->
                                <div class="col-lg-9">
                                    <label for="titulo" class="col-lg-3 control-label">Titulo</label> 
                                    <input type="text" class="form-control"  placeholder="Titulo de la publicacion"  name="titulo">
                                    <label for="contenido" class="col-lg-3 control-label">Contenido</label>
                                    <textarea rows="5"  placeholder="Contenido" name="contenido" id=""></textarea>
                                    <br>
                                    <div class="modal-footer">
                                        <button type="submit" id="btnAceptar" onclick="" class=" btn btn-default" name="aceptar">Aceptar</button>
                                        <button type="reset" id="btnLimpiar" onclick="" class=" btn btn-default" name="Limpiar" >Limpiar</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>

                </div>

                </fieldset>
                <!-- </form>-->
            </div>
        </div>
    </div>
    <script src="../bootstrap/js/Publicaciones.js"></script>