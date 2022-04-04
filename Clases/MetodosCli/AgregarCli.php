<?php
require_once "../Config.php";

if (isset($_POST['addcli'])) 
{
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $dui = $_POST['dui'];

    $query = $conn->prepare("INSERT INTO clientes (Nombre, Direccion, Telefono, Dui) VALUES (:nombre, :direccion, :telefono, :dui)");
    $query->bindParam("Nombre", $nombre, PDO::PARAM_STR);
    $query->bindParam("Direccion", $direccion, PDO::PARAM_STR);
    $query->bindParam("Telefono", $telefono, PDO::PARAM_STR);
    $query->bindParam("Dui", $dui, PDO::PARAM_STR);
    $result = $query->execute();

    if ($result) 
    {
        echo '<div class="alert alert-success" role="alert">Tu registro fue exitoso!</div>';
    } 
    else 
    {
        echo '<div class="alert alert-danger" role="alert">¡Algo salió mal!</div>';
    }
}
?>