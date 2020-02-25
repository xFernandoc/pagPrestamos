<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/me.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <title>Inicio de sesión</title>
</head>
<?php
    if (isset($_POST["login"])) {
        
    }
?>

<body>
    <div class="todo d-flex justify-content-center align-items-center">
            <div class="card caja">
        <form action="" method="post">
                <div class="row">
                    <div class="col-md-5 col-12">
                        <div class="container">
                            <div class="h1 mt-5 text-center titulos barra font-weight-bold">Inicio de sesión
                                <div class="barra_sub"></div>
                            </div>
                            <div class="md-form ml-4 mt-5">
                                <i class="fas fa-user prefix"></i>
                                <input type="text" id="user" class="form-control" autocomplete="off">
                                <label for="inputIconEx2">Usuario</label>
                            </div>
                            <div class="md-form ml-4 mt-5 position-relative">
                                <i class="fas fa-key prefix"></i>
                                <input type="password" id="clave" class="form-control" id="pass">
                                <label for="inputIconEx2">Clave</label>
                                <i class="fas fa-eye-slash ver" id="ver"></i>
                            </div>
                            <div class="row mt-5">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn boton btn-block my-4 waves-effect"
                                        style="font-size : 1.2rem" name="login">Ingresar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-7 d-lg-inline-block d-none">
                        <div class="fondo"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/mdb.min.js"></script>
<script src="js/propio.js"></script>
<script>
</script>

</html>