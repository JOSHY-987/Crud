<?php
class Usuarios
{
    private $DB;

    function __construct($conn)
    {
        $this -> DB = $conn;
    }

    //Mostrar Todos Los Usuarios
    public function ListarUsuarios($consulta)
    {
        $establecer = $this -> DB -> prepare($consulta);
        $establecer -> execute() > 0;
         
        while($columna = $establecer -> fetch(PDO::FETCH_ASSOC))
        {
            ?> 
            <tr>
            <td><?php echo $columna['Id']?></td>
            <td><?php echo $columna['Username']?></td>
            <td><?php echo $columna['Email']?></td>
            <td><?php echo $columna['Estado']?></td>
            <td>
                <a href="EditarUsuario.php?EditId=<?php echo $columna['Id']?>" class="btn btn-warning">
                    <i class="fa-solid fa-pencil"></i>
                </a>
            </td>
            <td>
                <a href="EliminarUsuario.php?ElimId=<?php echo $columna['Id']?>" class="btn btn-danger">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </td>
        </tr>
            
        <?php
        } 
    }

    public function AgregarUsuario($Nombre, $Contra, $Email, $Estado)
    {
        $Sql = mysqli_prepare($this->conn, "SELECT * FROM usuarios WHERE email = ".$Email."");
        $Sql->execute();

        /*if ($Sql->rowCount() > 0) 
        {
            echo '<div class="alert alert-danger" role="alert">
                        ¡La dirección de correo electrónico ya está registrada!
                    </div>';
        }
        else
        {*/
            $Sql = "INSERT INTO usuarios (Username, Password, Email, Estado) VALUES ('".$Nombre."','".$Contra."','".$Email."','".$Estado."')";
            $Resultado=$this->conn->query($Sql);
            if(!$Resultado)
            {
                echo 'Operacion Agregar Fallida';
            }
            else
            {
                return $Resultado;
                $Resultado->close();
                $this->conn->close();
            }
        /*}*/
    }

    public function Actualizar($Id, $Username, $Email, $Estado)
    {
        try
        {
            $establecer = $this -> DB -> prepare("UPDATE usuarios SET username=:username,
            email=:email, estado=:estado WHERE id=:id");
            $establecer->bindParam(":username", $Username);
            $establecer->bindParam(":email", $Email);
            $establecer->bindParam(":estado", $Estado);
            $establecer->bindParam(":id", $Id);
            $establecer->execute();

            return true;
        }
        catch(PDOException $Exc)
        {
            echo $Exc->getMessage();
            return false;
        }
    }

    public function Eliminar($Id)
    {
        try
        {
            $establecer = $this -> DB -> prepare("DELETE FROM usuarios WHERE id=:id");
            $establecer->bindParam(":id", $Id);
            $establecer->execute();

            return true;
        }
        catch(PDOException $Exc)
        {
            echo $Exc->getMessage();
            return false;
        }
    }
}
?>