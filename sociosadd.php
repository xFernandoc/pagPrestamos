<?php
    include('layout/cabecera.php');
    include('layout/izq.php');
    include('layout/centro.php');
    include_once("lib/simple_dom/simple_html_dom.php");
?>
<div class="row text-dark justify-content-center">
    <div class="col-lg-10 col-12">
        <div class="card">
            <div class="card-header">
                <div class="h4-responsive font-weight-bold u-regular" style="color : rgb(163, 17, 27)">Ingresar socio
                </div>
            </div>
            <div class="card-body text-dark">
                <form id="frmaddsocio">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-inline-block">
                                <i class="fas fa-id-card fa-2x mr-2 text-primary"></i></div>
                            <div class="md-form m-0 d-inline-block txtdnx">
                                <input type="number" oninput="this.value = this.value.slice(0, this.maxLength);"
                                    id="txtbuscar" name="txtdocumento" class="form-control font-weight-bold u-regular"
                                    min=0 maxLength="8" required>
                                <label class="u-regular ">D.N.I</label>
                            </div>
                            <div class="d-inline-block">
                                <a class="btn border-comp-azul p-1 text-dark u-light" id="busqdni"><i
                                        class="fas fa-search fa-1x p-1 "></i></a>
                            </div>
                            <div class="u-regular font-weight-bold text-danger d-inline-block"><i
                                    class="fas mr-1 d-none" id="icoerror"></i><span id="errorsoc"></span></div>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="form-group col-xl-3 col-12 position-relative">
                            <label class="u-regular font-weight-bold">Nombre: </label>
                            <div class="cjnomb">
                                <input type="text" class="form-control d-inline-block" name="txtNombre" id="txtnomb"
                                    placeholder="Nombres completos" required autocomplete="false">
                                <span class="adv opac-0"> <i class="fas fa-exclamation-circle text-danger"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-xl-3 col-12 position-relative">
                            <label class="u-regular font-weight-bold">Apellidos: </label>
                            <div class="cjape">
                                <input type="text" class="form-control" name="txtApellido" id="txtape"
                                    placeholder="Apellidos completos" required autocomplete="false">
                                <span class="adv opac-0"> <i class="fas fa-exclamation-circle text-danger"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-xl-3 col-12 position-relative">
                            <label class="u-regular font-weight-bold">Fecha de nacimiento: </label>
                            <div class="cjcump">
                                <input type="date" class="form-control" required name="fecha_nac" id="fecha_nac_soc"
                                    placeholder="Fecha">
                                <span class="adv opac-0"> <i class="fas fa-exclamation-circle text-danger"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-xl-3 col-12 position-relative">
                            <label class="u-regular font-weight-bold">Celular: </label>
                            <div class="cjcelu">
                                <input type="number" oninput="this.value = this.value.slice(0, this.maxLength);"
                                    name="celular" class="form-control font-weight-bold u-regular" id="txtcelular" min=0
                                    maxLength="9" required placeholder="Celular">
                                <span class="adv opac-0"> <i class="fas fa-exclamation-circle text-danger"></i></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="txtdep" id="txtdep">
                    <input type="hidden" name="txtprov" id="txtprov">
                    <input type="hidden" name="txtdist" id="txtdist">
                    <div class="form-row mt-3">
                        <div class="form-group col-xl-3">
                            <label class="u-regular font-weight-bold d-block">Departamento: </label>
                            <select name="opdep" id="opdep" class="custom-select" style="cursor : pointer"
                                required></select>
                        </div>
                        <div class="form-group col-xl-3">
                            <label class="u-regular font-weight-bold">Provincia: </label>
                            <select name="optprov" id="opprov" class="custom-select" style="cursor : pointer"
                                required></select>
                        </div>
                        <div class="form-group col-xl-3">
                            <label class="u-regular font-weight-bold">Distrito: </label>
                            <select name="optdistr" id="opdist" class="custom-select" style="cursor : pointer"
                                required></select>
                        </div>
                        <div class="form-group col-xl-3 position-relative"">
                            <label class=" u-regular font-weight-bold">Domicilio: </label>
                            <div class=" cjdomc">
                                <input type="text" name="txtdomc" id="txtdomic" class="form-control"
                                    placeholder="Dirección" required>
                                <span class=" adv opac-0"> <i class="fas fa-exclamation-circle text-danger"></i></span>
                            </div>
                        </div>
                    </div>
                    <form class="form-row mt-3">
                        <div class="col-xl-12 d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-primary p-3" name="ingresar" id="btningsoc"> Ingresar
                                socio <i class="fas fa-spinner fa-spin ml-2 d-none" id="loadingsocio"></i></a>
                        </div>
                    </form>
                </form>
                <hr>
                <div id="infoadd" class="d-none">
                    <i class="fas fa-exclamation-circle mr-1 text-danger"></i><span class=" u-light">Falta algun
                        dato</span>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
    include('layout/footer.php');
?>