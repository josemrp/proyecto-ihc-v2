<?php ?>

<div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>Seleccione la materia que desea eliminar</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <br />
                    
                    <!-- Tabla del horario -->
                    <?php $this->load->view('overall/horario'); ?>
                    
                </div>
            </div>

            <br />
            <div class="row">
                <div class="col-xs-12">
                    <a href="<?= base_url() . 'index.php' ?>" class="btn btn-default">
                        <span class="glyphicon glyphicon-arrow-left"></span> Volver
                    </a>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                var seccion = $('.seccion-inscrita');
                seccion.click(function () {
                    var respuesta = confirm("Seguro que desea eliminar esta materia");
                    if (respuesta) {
                        var nrc = $(this).children().data('nrc');
                
                        $.ajax({
                            type: "POST",
                            url: '<?= base_url() . 'index.php/sys/eliminarNRC' ?>',
                            data: {nrc: nrc}
                        }).done(function() {
                            window.location="<?= base_url() . 'index.php' ?>";
                        });
                    }
                });
            });
        </script>
