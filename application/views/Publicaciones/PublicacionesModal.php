
<?php $this->load->helper('url'); ?>
<!--Llamada a la hoja de estilo y al js (abajo)-->
<script src="../bootstrap/js/Publicaciones.js"></script>
<link href="../bootstrap/css/publicacioncss.css" rel="stylesheet">

<div id="NuevaPublicacion" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
                                    <input type="hidden" id="nombreImg" name="nombreImg" value="" readonly>
                                    <input type="hidden" id="extImg" name="extImg" value="" readonly>
                                    <br>
                                    <label for="contenido" class="col-lg-3 control-label">Contenido:</label>
                                    <textarea  class="form-control"  placeholder="Contenido" name="contenido" id="pubtexarea" required></textarea>
                                    <br>
                                    <div class="modal-footer">
                                        
                                        <button type="submit" id="btnAceptar" onclick="" class=" btn btn-default" name="aceptar"  disabled="true">Aceptar</button>
                                        <button type="reset" id="btnLimpiarPubli" onclick="" class=" btn btn-default" name="Limpiar" >Limpiar</button>
                                        <button type="reset" id="btnCancelarP" onclick="" class=" btn btn-default" name="cancelar" >Cancelar</button>
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

