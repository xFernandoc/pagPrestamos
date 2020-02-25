<?php
    include('layout/cabecera.php');
    include('layout/izq.php');
    include('layout/centro.php');
?>
<div class="card shadow">
    <div class="card-header titulo-card  h5-responsive font-weight-bold u-regular">Simulación de prestamos</div>
    <div class="card-body" style="color : var(--secundario) !important">
        <div class="row">
            <div class="col-lg-4 col-12 border-right">
                <div class="form-row d-flex justify-content-center text-center">
                    <form id="frmprestamo" method="post">
                        <div class="form-group col-md-12">
                            <label class="font-weight-bold u-regular">Cantidad solicitada</label>
                            <div class="input-group mb-1 position-relative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">S/.</span>
                                </div>
                                <input name="txtcant" type="number" min=0
                                    class="form-control font-weight-bold u-regular animated fast"
                                    placeholder="Ejem: 25000" id="txtcant">
                                <div class="position-absolute error mt-2 d-none" id="error1"><i
                                        class="fas fa-exclamation-circle"></i></div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 position-relative">
                            <label class="font-weight-bold u-regular">Cuotas</label>
                            <input name="txtcuota" type="number"
                                class="form-control text-center font-weight-bold u-regular animated fast" min=1
                                value="1" id="txtcuota">
                            <div class="position-absolute mt-2 d-none" id="error2"><i
                                    class="fas fa-exclamation-circle"></i></div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="font-weight-bold u-regular">Interes Mensual (TEM)</label>
                            <div class="input-group mb-1 position-relative">
                                <input name="txtinte" min=0 type="number"
                                    class="form-control font-weight-bold u-regular text-center animated fast"
                                    placeholder="Ejem: 2.5" id="txtinte">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="position-absolute error mt-2 d-none" id="error3"><i
                                        class="fas fa-exclamation-circle"></i></div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 text-center">
                            <button class="btn btn-outline-primary" id="btncalpres" type="button">Simular</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-12 ">
                <div class="row" id="resultado">
                    <div class="col-12 text-center">
                        <div class="u-regular font-weight-bold h5">Valor de la cuota mensual : <span id="lblcuota"
                                style="color : rgb(163, 17, 27)"></span></div>
                    </div>
                    <div class="col-12 mt-2 overflow-auto p-0  " id="conttabla" style="white-space: nowrap;">
                        <table class="table table-fit table-hover mb-0" id="tbcontenido">
                        </table>
                    </div>
                </div>
                <div class="row d-none pt-xl-3" id="btnsexport">
                    <div class="button-group" role="group">
                        <form action="proformas/excel.php" method="post" class="d-inline-block">
                            <input type="hidden" name="data" id="listado">
                            <button type="submit" class="btn excel">
                                <span class="espacio">
                                    <i class="fas fa-file-excel pt-1" style="font-size : 1.3rem"></i>
                                </span>
                                <span class="text-capitalize ml-1 font-weight-bold u-regular">Excel</span>
                            </button>
                        </form>
                        <button type="button" class="btn pdf">
                            <span class="espacio"><i class="fas fa-file-pdf pt-1" style="font-size : 1.3rem"></i></span>
                            <span class="text-capitalize font-weight-bold u-regular ml-1">pdf</span>
                        </button>
                        <button type="button" class="btn exe">
                            <span class="espacio"><i class="fas fa-handshake pt-1" style="font-size : 1.3rem"></i></span>
                            <span class="text-capitalize font-weight-bold u-regular ml-1">crear</span>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include('layout/footer.php')
?>