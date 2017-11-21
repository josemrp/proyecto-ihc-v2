<?php ?>

<div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>Agregar observaciones</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <form class="form">
                        <p>Agregar Obaservaciones</p>
                        <textarea class="form-control" id="observaciones"></textarea>
                    </form>
                </div>
                <div class="col-md-8">
                    <br />
                    
                    <!-- Tabla del horario -->
                    <?php $this->load->view('overall/horario'); ?>
                    
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="<?= base_url() . 'index.php' ?>" class="btn btn-default">
                              <span class="glyphicon glyphicon-arrow-left"></span>  Volver 
                            </a>
                        </div>
                        <div class="col-xs-6">
                            <a href="<?= base_url() . 'index.php/sys/fin' ?>" class="btn btn-primary pull-right">
                                Enviar <span class="glyphicon glyphicon-send"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

