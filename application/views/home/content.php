<div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>Agregar Materias</h1>
                </div>
            </div>
            <div class="row">
                
                <!-- Cuadros de busqueda por NRC -->
                <?php $this->view('home/nrc'); ?>
                
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h2>
                        Lista de materias a inscribir
                    </h2>
                    <ul>
                        <?php foreach ($materias as $materia): ?>
                        <li>
                            <a 
                                    href="<?= base_url() . 'index.php/materia/index/' . $materia->id ?>"
                                    class="btn btn-liink">
                                    <?= $materia->nombre ?>
                                    
                                </a>
                            
                            <?php /*
                            <?php if($materias_habilitadas[$materia['id']]): ?>
                                <a 
                                    href="<?= base_url() . 'index.php/sys/materia/' . $materia['id'] ?>"
                                    class="btn btn-liink">
                                    <?= $materia['materia'] ?>
                                    
                                </a>
                            <?php else: ?>
                                <a href="#" class="btn btn-liink disabled">
                                    <?= $materia['materia'] ?>
                                </a>
                            <?php endif; ?>                            
                            */?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
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
                            
                            <div class="progress">
                                <div class="progress-bar" 
                                     role="progressbar" 
                                     aria-valuenow="<?= $creditos ?>"
                                     aria-valuemin="0" 
                                     aria-valuemax="32" 
                                     style="width:<?= $creditos * 100 / 32 ?>%">
                                </div>
                            </div>
                                
                        </div>
                        
                        <div class="col-xs-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="<?= base_url() . 'index.php/sys/eliminar' ?>" class="btn btn-danger pull-right <?= $disabled_btn ?>">
                                        <span class="glyphicon glyphicon-trash"></span> Eliminar materia 
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href='<?= base_url() . 'index.php/sys/observaciones' ?>' class="btn btn-primary pull-right <?= $disabled_btn ?>">
                                        Inscribir <span class="glyphicon glyphicon-ok"></span>
                                    </a>
                                </div>
                            </div>
                            <br /><br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
