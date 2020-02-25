<?php
    include_once("../socio.php");
    $socio = new Socio();
    $dni = $_POST["dni"];
    $estado = $_POST["estado"];
    $resultado = $socio->exispend_pag($dni,$estado);
    if ($resultado->num_rows>0) {
        ?>
<thead>
    <tr>
        <th>N°</th>
        <th>Cant.</th>
        <th>Cuota</th>
    </tr>
</thead>
<tbody>
    <?php
        while ($fila = $resultado->fetch_assoc()) {
            $cuota = $socio->obcuotaxpres($fila["num_prest"]);
            $pag=0;
            $deb=$fila["tiemp_pres"];
            if ($_POST["estado"]=="PAGADO") {
                $pag=$fila["tiemp_pres"];
            }else{
                while ($fila_cuota = $cuota->fetch_assoc()) {
                    $fila_cuota["estado"]=="PAGADO" ? $pag++ : "";
                }
            }
    ?>
    <tr>
        <td class="font-weight-bold text-center"><?php echo $fila["num_prest"]?></td>
        <td class="font-weight-bold text-center text-primary"><?php echo "S/ ".$fila["cant_soc"]?></td>
        <td
            class="font-weight-bold text-center <?php echo $_POST["estado"]=="PENDIENTE" ? "text-danger" : "text-success"?>">
            <?php echo $pag."/".$deb?></td>
    </tr>
    <?php
        }
    ?>
</tbody>
<?php     
    }else{
        echo "vacio";
    }
?>