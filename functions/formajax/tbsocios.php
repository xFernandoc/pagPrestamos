<?php
    $busq = $_POST["busq"];
    include_once("../socio.php");
    $socio = new Socio();
    $resultados = $socio->obtsocioxdni($busq);
    function obt(){
        echo "http://".$_SERVER['SERVER_NAME']."/prestamos/";
    }
    ?>
<thead>
    <tr>
        <th class="u-regular font-weight-bold">#</th>
        <th class="u-regular font-weight-bold">D.N.I</th>
        <th class="u-regular font-weight-bold">Nombre</th>
        <th class="u-regular font-weight-bold">Acciones</th>
    </tr>
</thead>
<?php
    if ($resultados->num_rows>0) {
        ?>
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
            <a href="<?php obt()?>socioslist/<?php echo $fila["DNI"]?>"><i class="fas fa-eye versoc mr-1 text-primary pr-1 border-right h4"></i></a>
            <a href="#"><i
                    class="fas fa-trash-alt h4 eliminar"></i></a>
        </td>
    </tr>
    <?php
            }
        ?>
</tbody>
<?php
    }
?>
<?php
?>