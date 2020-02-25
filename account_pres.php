<?php
    include('layout/cabecera.php');
    include('layout/izq.php');
    include('layout/centro.php');
    require_once('functions/socio.php');
    $socio  = new Socio();
    $resultado = $socio->obtsocio($_GET["dni"]);
    $fila = $resultado->fetch_assoc();
?>
<div class="row">
    <div class="col-lg-4 px-2">
        <div class="text-dark border" style="border-radius : 0.7rem">
            <div class="p-3" style="background-color : #F5F5F5 !important">
                <div class="row">
                    <div class="col-xl-5 col-6">
                        <div style="background : url('<?php obt();echo "assets/perfiles/".$fila["FOTO"]?>')"
                            class="imgsoc mx-auto"></div>
                    </div>
                    <div class="col-xl-7 border-left u-regular font-weight-bold col-6">
                        <div class="d-block text-center "> <?php echo $fila["APELLIDOS"].", ".$fila["NOMBRES"]?></div>
                        <hr class="mb-1 mt-1">
                        <div class="text-center btnsemaforo">
                            <a href="tel: 950607247">
                                <button
                                    class="btn p-2 ml-0 text-capitalize u-regular font-weight-bold"
                                    data-toggle="tooltip" data-placement="bottom" title="Llamar">
                                    <i class="fas mr-1"></i><span></span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-dark mt-3 border rounded" style="background-color : #F5F5F5 !important">
            <div class="row">
                <div class=" col-12 mx-auto">
                    <div class="text-center mt-2">
                        <div class="u-regular font-weight-bold h5-responsive">Tus prestamos</div>
                    </div>
                    <hr>
                    <div class="cjprestamos pt-2 overflow-auto">
                        <div class="text-right">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="oppend" name="estado" checked
                                    value="PENDIENTE">
                                <label class="custom-control-label u-light" for="oppend">Pendientes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="oppag" name="estado"
                                    value="PAGADO">
                                <label class="custom-control-label u-light" for="oppag">Pagadas</label>
                            </div>
                        </div>
                        <div class="cont px-2 mt-2">
                            <table class="table table-fit table-hover table-bordered " id="tbpressoc">
                            </table>
                        </div>
                        <div class="detalle h-100 d-none">
                            <div class="h5-responsive u-regular font-weight-bold h-100 d-flex justify-content-center align-items-center"
                                style="color : #6c757d !important; cursor : pointer"></div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8"></div>
</div>
<?php
    include('layout/footer.php')
?>