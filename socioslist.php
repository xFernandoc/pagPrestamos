<?php
    include('layout/cabecera.php');
    include('layout/izq.php');
    include('layout/centro.php');
    include_once('functions/socio.php');
    $socios = new Socio();
    $resultados = $socios->obtsocios();
?>
<div class="row">
    <div class="<?php echo isset($_GET["dni"]) ? "col-lg-8" : "col-lg-12";?> col-12 text-dark">
        <div class="card">
            <div class="card-header">
                <div class="u-regular font-weight-bold h4-responsive" style="color : rgb(163, 17, 27)">Lista de socios</div>
            </div>
            <div class="card-body">
                <div class="justify-content-end row">
                    <div class="col-lg-6 col-12 p-lg-0">
                        <span class="d-inline-block u-regular font-weight-bold mr-2">Buscar : </span>
                        <div class="md-form m-0 d-inline-block">
                            <input type="text" id="txtbuscar" class="form-control">
                            <label for="form1" class="u-regular">D.N.I / Nombre</label>
                        </div>
                    </div>
                </div>
                <?php
                    if ($resultados->num_rows>0) {
                        ?>
                <div id="frmtbsocios" class="overflow-auto">
                    <table class="table table-hover table-fit" id="tbsocios" style="cursor : pointer">
                        <thead>
                            <tr>
                                <th class="u-regular font-weight-bold">#</th>
                                <th class="u-regular font-weight-bold">D.N.I</th>
                                <th class="u-regular font-weight-bold">Nombre</th>
                                <th class="u-regular font-weight-bold">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $x=0;
                            while($fila = $resultados->fetch_assoc()){
                                $x++;
                                ?>
                            <tr>
                                <td><?php echo $x?></td>
                                <td><?php echo $fila["DNI"]?></td>
                                <td><?php echo $fila["APELLIDOS"].", ".$fila["NOMBRES"]?></td>
                                <td class="text-center">
                                    <a href="<?php obt()?>socioslist/<?php echo $fila["DNI"]?>"><i
                                            class="fas fa-eye versoc mr-1 text-primary pr-1 border-right h4"></i></a>
                                    <a
                                        href="#"><i class="fas fa-trash-alt h4 eliminar"></i></a></td>
                            </tr>
                            <?php
                            }
                        ?>
                        </tbody>
                    </table>

                </div>
                <?php
                    }else{

                    }
                ?>

            </div>
        </div>
    </div>
    <?php
        if (isset($_GET["dni"])) {
            $dni = $_GET["dni"];
            $hoy = getdate();
            $resultados = $socios->obtsocio($dni);
            $fila = $resultados->fetch_assoc();
            $fechaact = new DateTime(getdate()["year"]."-".getdate()["mon"]."-".getdate()["mday"]);
            $cumple = new DateTime($fila["FECHA_NAC"]);
            $edad = $cumple->diff($fechaact);
            ?>

    <div class="col-lg-4 col-12 container mt-lg-0 mt-3 text-dark" id="contenidosocio">
        <div class="text-center">
            <img src="<?php obt()?>assets/perfiles/<?php echo $fila["FOTO"]==""  ? "notperfi.png" : $fila["FOTO"] ?>" alt=""
                class="perfilsocio border rounded-circle">
        </div>
        <div class="text-center u-regular font-weight-bold text-dark mt-2 border-bottom">
            <?php echo $fila["APELLIDOS"].", ".$fila["NOMBRES"]?>
        </div>
        <div class="row mt-2 u-regular font-weight-bold border-bottom pb-1">
            <div class="col-lg-6 border-right text-center">
                <div class="d-block border-lg-bottom border-0">
                    <i class="fas fa-map-marker-alt text-primary "></i>
                    <?php echo ucwords(strtolower($fila["DOMICILIO"]))?>
                </div>
                <div class="d-block mt-lg-1 mt-2 ">
                    <i class="fas fa-map text-warning"></i>
                    <?php echo ucwords(mb_strtolower($fila["DEPARTAMENTO"],"UTF-8"))." / ".ucwords(mb_strtolower($fila["PROVINCIA"],"UTF-8")) . " / " . ucwords(mb_strtolower($fila["DISTRITO"],"UTF-8"))?>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="d-block border-lg-bottom border-0m">
                    <i class="fas fa-birthday-cake text-success"></i>
                    <?php echo $fila["FECHA_NAC"]?>
                    <div class="text-danger"><?php echo $edad->y?> años</div>
                </div>
            </div>
        </div>
        <div class="text-center mt-1">
            <button class="btn btn-primary"><a href="<?php obt()?>account_pres/<?php echo $fila["DNI"]?>">Ver prestamos</a></button>
            <button class="btn btn-success">Ver acciones</button>
        </div>
    </div>
    <?php
        }
    ?>
</div>
<?php
    include('layout/footer.php')
?>