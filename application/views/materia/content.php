<?php ?>
<form action="<?= base_url() . 'index.php/sys/inscribir' ?>" method="post"> 
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2><?= $title ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="container container-secciones">
                    <?php if(count($secciones) > 0): ?>
                        <?php foreach($secciones as $seccion): ?>
                        <div class="row seccion">
                            <div class="col-sm-1">
                                <input type="radio" 
                                       class="radio seccion-option" 
                                       name="nrc"
                                       value="<?= $seccion['nrc'] ?>" 
                                       required=""/>
                            </div>
                            <div class="col-sm-2">
                                <p><?= $seccion['profesor'] ?></p>
                            </div>
                            <div class="col-sm-2">
                                <p>Sección <?= $seccion['numero_seccion'] ?></p>
                            </div>
                            <div class="col-sm-5">
                                <p><?= $seccion['horario_string'] ?></p>
                            </div>
                            <div class="col-sm-1">
                                <p><?= $seccion['nrc'] ?></p>
                            </div>
                            <div class="col-sm-1">
                                Cupos: <?= $seccion['cupos'] ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h3 class="text-danger">No quedan secciones abiertas para esta materia</h3>
                    <?php endif; ?>
                    
                    
                </div>
            </div>
            <div class="row">
                <span class="text-danger">*Nota: Todos los horarios que no aparezcan, es debido a que su sección ha sido cerrada</span>
            </div>
            <br />
            <div class="row">
                <div class="col-sm-8 col-md-10"></div>
                <div class="col-sm-2 col-md-1 col-xs-6">
                    <a href="<?= base_url() . 'index.php' ?>" class="btn btn-default pull-right">
                       <span class="glyphicon glyphicon-arrow-left"></span> Volver 
                    </a>
                </div>
                <div class="col-sm-2 col-md-1 col-xs-6">
                    <button class="btn btn-primary" id="seccion-summit" type="submit">
                       Inscribir  <span class="glyphicon glyphicon-check"></span>
                    </button>
                </div>                
            </div>
        </div>
    </form>

