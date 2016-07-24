 <?php $this->load->helper('url'); ?>
 <!-- Publicaciones  Grid Section -->
        <section id="portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Publicaciones Recientes</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">

                   <?php
                        foreach ($ArchivosUsuario as $publicacion) {
                            ?>

                            <div  >

                               
                                    <img  src="<?php echo '../bootstrap' . $publicacion->Ruta ?>" alt="" style="height:200px; width: 170px;">
                                </a>

                            </div>

                            <?php
                        }
                    
                    ?>

                </div>
                <!-- start paginacion-->

               
                <!-- finish paginacion-->
            </div>
        </section>
