<?php
include ('Config.php');

if(isset($_POST['BtnActualizar']))
{
    $id = $_GET['EditId'];
    $username = $_POST['usuario'];
    $email = $_POST['email'];
    $estado = $_POST['estado'];

    if($llamado -> Actualizar($id, $username, $email, $estado))
    {
        $mensaje = "<div class='alert alert-success' role='alert'>
                        Registro Se Ha Actualizado!
                    </div>";
    }
    else
    {
        $mensaje = "<div class='alert alert-danger' role='alert'>
                        Operacion Actualizar Ha Fallado!
                    </div>";
    }
}

if (isset($_GET['EditId']))
{
    $Id = $_GET['EditId'];
    $establecer = $conn -> prepare("SELECT * FROM usuarios WHERE id=?");
    $establecer->execute([$Id]);
    $registro = $establecer -> fetch(PDO::FETCH_OBJ);
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php require_once "Menu.php" ?>
    <title>New Usuario</title>
</head>

<body>

    <div class="container"><br>
        <div class="row justify-content-center">
            <?php
            if(isset($mensaje))
            {
                echo $mensaje;
            }
            ?>
            <div class="col-6 p-5 bg-white shadow-lg rounded">
                <h3>Actualizar Usuario</h3>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label for="usuario">Nombre del Usuario</label>
                        <input id="usuario" value="<?php echo $registro->Username;?>" class="form-control" type="text" name="usuario">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" value="<?php echo $registro->Email;?>" class="form-control" type="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input id="estado" value="<?php echo $registro->Estado;?>" class="form-control" type="text" name="estado">
                    </div>

                    <br>

                    <div class="d-grid gap-1 col-6 mx-auto">
                        <button class="btn btn-primary" name="BtnActualizar" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>