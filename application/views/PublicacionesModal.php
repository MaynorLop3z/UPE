<!------Modal para agregar Publicaciones----------------------------------------------------------------------------------->
<div id="NuevaPublicacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container-fluid ">
                <form action="PublicacionesController" class="form-horizontal" method="post" >
                    <fieldset>
                        <legend class="modal-header"> Nueva Publicacion:</legend> 
                        <div class="form-group">
                            <label for="DiplomadoNombre" class="col-lg-3 control-label">Titulo</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="PublicacionTitulo" placeholder="Titulo de la publicacion" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label form="DiplomadoCuerpo" class="col-lg-3 control-label">Contenido</label>
                            <div class="col-lg-9">
                                <textarea rows="5"  placeholder="Contenido"></textarea>
                            </div>
                        </div>
                        

                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnEnviar" onclick="" class=" btn btn-default" name="Aceptar">Aceptar</button>
                            <button type="submit" id="btnLimpiar" onclick="" class=" btn btn-default" name="Limpiar">Limpiar</button>
                            <button type="submit" id="btnCerrar" onclick="" class=" btn btn-default" name="Cerrar">Cerrar</button>
                        </div>
                        
                    </fieldset>
                </form>
            </div>
        </div></div>
    </div>