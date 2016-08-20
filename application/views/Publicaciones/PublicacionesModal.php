
<?php $this->load->helper('url'); ?> 
<!--Llamada a la hoja de estilo y al js (abajo)-->
<script src="../bootstrap/js/Publicaciones.js"></script>
<link href="../bootstrap/css/publicacioncss.css" rel="stylesheet">


<!---------Modal nueva publicacion-------------------------->
<div id="NuevaPublicacion" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close" id="btnCerrarDi"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <legend class="modal-header">Nueva Publicacion</legend> 
                <div class="form-group" class="form-inline" role="form" id="divPub">

                    <div class="col-lg-9">
                        <!--La linea de abajo abre el selector de imgs -->
                        <form class="formulario" enctype="multipart/form-data" method="post" action="<?php echo base_url() ?>index.php/PublicacionesController/do_upload/" id="imgform">
                            <fieldset> 
                                <input type="file"  size="20" name="archivo" id= "imagen" >
                                <!--div para visualizar mensajes-->
                                <div class="messages"></div><br /><br />
                                <input type="button" value="Subir Imagen" class="btn btn-default" id="subir" />
                                <br><br>
                                <!--div para visualizar la imagen-->
                                <div class="showImage" id="showImg"   ></div>
                                <br><br><br>
                            </fieldset>
                        </form>

                        <div>
                            <form class="form-group-lg" id="botones" method="post" action="<?php echo base_url() ?>index.php/PublicacionesController/subirBd/">
                                <!--en las lineas de abajo esta el cuerpo de la publicacion-->
                                <fieldset> 
                                    <label for="categoriasl" class=" control-label">Seleccione una categoria: </label> 
                                    <!--Listamos las categorias de las publicaciones-->
                                    <select name="categoriasl" onchange="" id="selectCategoria">
                                        <?php
                                        foreach ($listCategorias as $categorias) {
                                            ?>
                                            <option value=<?php echo $categorias->CodigoCategoriaDiplomado ?>> <?php echo $categorias->NombreCategoriaDiplomado ?>  </option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                    <br>
                                    <br>
                                    <label for="titulo" class="col-lg-3 control-label">Titulo:</label> 
                                    <input type="text" class="form-control"  placeholder="Titulo de la publicacion"  name="titulo" required>
                                    <!--Los input tipo hidden son para obtener el nombre y la extension de la imagen de la publicacion,-->
                                    <input type="hidden" id="nombreImg" name="nombreImg" value="" readonly>
                                    <input type="hidden" id="extImg" name="extImg" value="" readonly>
                                    <br>
                                    <label for="contenido" class="col-lg-3 control-label">Contenido:</label>
                                    <textarea  class="form-control"  placeholder="Contenido" name="contenido" id="pubtexarea" required></textarea>
                                    <br>
                                    <div class="modal-footer">

                                        <button type="submit" id="btnAceptar" onclick="" class=" btn btn-default" name="aceptar"  disabled="true">Aceptar</button>
                                        <button type="reset" id="btnLimpiarPubli" onclick="" class=" btn btn-default" name="Limpiar" >Limpiar</button>
                                        <button type="reset" id="btnCancelarP" onclick="" class=" btn btn-default" name="cancelar"  data-dismiss="modal">Cancelar</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end modal nueva publicacion-->

<!-- Modal para modificar publicacion ------------->
<div id="ModificarPublicacion" class="modal fade"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <!--<button type="button" class="close" id="btnCerrarMo"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>      
                -->
                    <fieldset>
                        <legend class="modal-header">Editar Publicación:</legend> 
                                                                                      
                        <div class="col-lg-9">
                            <!--La linea de abajo abre el selector de imgs -->
                            Seleccionar otra imagen
                            <form class="formulario" enctype="multipart/form-data" method="post" action="<?php echo base_url() ?>index.php/PublicacionesController/do_upload/" id="imgformMod" >
                                <fieldset> 
                                    <input type="file"  size="20" name="archivo" id="imagenMod" >
                                    <input type="button" value="Subir la Imagen" class="btn btn-default" id="subirMod" disabled="true" />
                                    <!--div para visualizar la imagen-->
                                    <br />
                                    <div class="messages" id="msgMod"></div><br />
                                    <div class="showImage" id="showImgMod"></div>
                                    <br />
                                   
                                </fieldset>
                            </form>

                            <div>
                                <form class="form-group-lg" id="botonesMod" method="post" action="<?php echo base_url() ?>index.php/PublicacionesController/editar/">
                                    <!--en las lineas de abajo esta el cuerpo de la publicacion-->
                                    <fieldset> 
                                        <label for="categoriasl" class=" control-label">Seleccione una categoria: </label> 
                                        <!--Listamos las categorias de las publicaciones-->
                                        <select name="categoriaslMod" onchange="" id="selectCategoriaMod">
                                            <?php
                                            foreach ($listCategorias as $categorias) {
                                                ?>
                                                <option value=<?php echo $categorias->CodigoCategoriaDiplomado ?>> <?php echo $categorias->NombreCategoriaDiplomado ?>  </option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                        <br>
                                        <br>
                                        <label for="titulo" class="col-lg-3 control-label">Titulo:</label> 
                                        <input type="text" class="form-control"  placeholder="Titulo de la publicacion" id="tituloModPub" name="tituloMod" required>
                                        <!--Los input tipo hidden son para obtener el nombre y la extension de la imagen de la publicacion,-->
                                        <input type="hidden" id="nombreImgMod" name="nombreImgMod" value="" readonly>
                                        <input type="hidden" id="extImgMod" name="extImgMod" value="" readonly>
                                        <br>
                                        <label for="contenido" class="col-lg-3 control-label">Contenido:</label>
                                        <textarea  class="form-control"  placeholder="Contenido" name="contenidoMod" id="pubtexareaModificacionP" required></textarea>
                                        <br>
                                        <div class="modal-footer">

                                            <button type="submit" id="btnAceptarModificacionP" onclick="" class=" btn btn-default" name="aceptar" >Guardar Cambios</button>
                                            <button type="reset" id="btnCancelarModificacionP" onclick="" class=" btn btn-default" name="cancelar"  data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </fieldset>
                                </form>


                            </div>

                        </div>

                    </fieldset>
                
            </div>
        </div>
    </div>
</div>
<!--Fin Modal para modificar publicaciones-->

<!--Modal para eliminar publicaciones-->
<div id="EliminarPublicacion" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <button type="button" class="close btn-lg" data-dismiss="modal"  aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                <form id="frmDELpub" action="" class="form-horizontal" class="form-horizontal" method="post" >
                    <legend class="modal-header">Publicacion:</legend> 
                    <div class="form-group">
                        <div class="col-lg-9">
                            <label>¿Realmente desea eliminar la Publicacion <mark id="nombreDipPub">?</mark></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnEliminarPub" onclick="" class=" btn btn-default" name="Eliminar">Eliminar</button>
                        <button type="button" id="btnLimpiarPub" onclick="" class=" btn btn-default" name="Limpiar">Cancelar</button>
                    </div>
                    
                </form>
            </div>
        </div>   
    </div>
</div>

<!--------------------- End modal eliminar Publicaciones  ---------------------->