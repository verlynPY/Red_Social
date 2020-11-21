<?php
require_once '../Servicios/DataBase.php';
require_once '../Usuario/usuario.php';


class ManageUsuario extends DB{
   
    public static $validar = true;
    
    public function Login($Correo,$Clave){
        $consult = $this->connect()->prepare('SELECT id, correo, clave FROM usuario WHERE correo =:correo');
        $usuario = new Usuario();
        $usuario->Correo = $Correo;
        $usuario->Clave = $Clave;
        $consult->bindParam(':correo', $usuario->Correo);
        $consult->execute();
        $resultado = $consult->fetch(PDO::FETCH_ASSOC);

        if(count($resultado) > 0 && password_verify($usuario->Clave, $resultado['clave'])){
            $_SESSION['usuarioid'] = $resultado['id'];
            $validar = true;
            header('Location: ../Navegacion/Home.php');
        }else{
            $message = 'Datos no validos, Verifica que todo los campos esten correctos.';
            $validar = false;
        }
    }

    public function Register($Nombre,$Apellido,$Nombre_Usuario,$Telefono,$Correo,$Clave){
     /*usuario = new Usuario();
    $usuario->Nombre = $_POST['Nombre'];
    $usuario->Apellido = $_POST['Apellido'];
    $usuario->NombreUsuario = $_POST['NombreUsuario'];
    $usuario->Telefono = $_POST['Telefono'];
    $usuario->Correo = $_POST['Correo'];*/

    $consult = $this->connect()->prepare('SELECT correo FROM usuario WHERE correo =:correo');
    $consult->bindParam(':correo',$Correo);
    $consult->execute();
    $data = $consult->fetchAll(PDO::FETCH_ASSOC);
    if(count($data) > 0){
        $validar = false;
    }
    else{
           $stmt = $this->connect()->prepare('INSERT INTO usuario (nombre, apellido,nombre_usuario,telefono,correo,clave) VALUES
     (:nombre, :apellido, :nombre_usuario, :telefono, :correo, :clave)');
     $stmt->bindParam(':nombre',$Nombre);
     $stmt->bindParam(':apellido',$Apellido);
     $stmt->bindParam(':nombre_usuario',$Nombre_Usuario);
     $stmt->bindParam(':telefono',$Telefono);
     $stmt->bindParam(':correo',$Correo);
     $stmt->bindParam(':clave',$Clave);

     if($stmt->execute()){
        $message = 'El usuario se ha registrado con exito';
        header('Location: ../Login_Registro/Login.php');
        $validar = true;
     }else{
        $message = 'Ha ocurrido un fallo al crear la cuenta';
     }
    }


    
  
    }

    function GetName($ID){
        $message;
        $query = "SELECT nombre_usuario FROM usuario WHERE id = :id";
        $stat = $this->connect()->prepare($query);
        $stat->bindParam(':id',$ID);
        
        if($stat->execute()){
            $Nombre = $stat->fetch(PDO::FETCH_ASSOC);
            return $Nombre['nombre_usuario'];
        }
        else{
            $message = "Nombre no disponible";
        }
    }

    function ShowAllUser(){
        $message;
        $query = "SELECT id, nombre, apellido, nombre_usuario FROM usuario";
        $stat = $this->connect()->prepare($query);

        if($stat->execute()){
            $users = $stat->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }
        else{
            return $message = "No hay Usuarios registrados";
        }
    }
    
    
}

?>