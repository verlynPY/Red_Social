<?php

require_once '../Servicios/DataBase.php';


   class Publica extends DB{

  
    function AgregarPublicacion($userid,$descripcion){
        $usuario = new Usuario();
        $publicaciones = new Publicaciones();
        $publicaciones->id = $userid;
        $publicaciones->Descripcion = $descripcion;
        date_default_timezone_set('America/Santo_Domingo');
        $date= date('Y-m-d H:i:s') ;

        $publicaciones->Fecha = $date;
        $sql = "INSERT INTO publicaciones (id, descripcion, fecha) VALUES (:id, :descripcion, :fecha)";
        
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id',$publicaciones->id);
        $stmt->bindParam(':descripcion', $publicaciones->Descripcion);
        $stmt->bindParam(':fecha',$publicaciones->Fecha);
        $stmt->execute();
        $this->MostrarPublicacion();

    }

    function MostrarPublicacion(){
    
        $consult = $this->connect()->prepare('SELECT id,nombre,apellido,correo,clave FROM usuario WHERE id=:id');
        $consult->bindParam(':id',$_SESSION['usuarioid']);
        $consult->execute(); 
        $usuario = new Usuario();
        $result = $consult->fetch(PDO::FETCH_ASSOC);
        if(count($result) > 0){
            $usuario->id = $result['id'];
            $usuario->Nombre = $result['nombre'];
            $usuario->Apellido = $result['apellido'];
    
            $listpublicaciones = array();


            $sql = "SELECT U.id , U.nombre, P.id, P.publicacionid ,P.descripcion, P.fecha FROM 
            usuario U INNER JOIN publicaciones P ON U.id = P.id";




            $con = $this->connect()->prepare($sql);
            $con->execute(); 
            $lista = array();
            $resu = $con->fetchAll(PDO::FETCH_ASSOC);
            return $resu;
        }
        else{
            return "Debes iniciar session para ver los contenidos";
        }
    }
    function GetNombrePublicacion(){
        

        $consult = $this->connect()->prepare('SELECT nombre_usuario FROM usuario LEFT JOIN ');
    }
    function EditarPublicacion($ID, $Texto){
      
        $query = "UPDATE publicaciones SET descripcion=:descripcion WHERE publicacionid=:publicacionid";
        $updated = $this->connect()->prepare($query);
        $updated->bindParam(':descripcion',$Texto);
        $updated->bindParam(':publicacionid',$ID);
        $updated->execute();
    }
    function EliminarPublicacion($ID){
        $message = '';
        $query = "DELETE FROM publicaciones WHERE  publicacionid=$ID";
        $updated = $this->connect()->query($query);
      //  $updated->bindParam(':publicacionid',$ID);
        if(!$updated){
            $message = "Mal";
        }
        else{
            $message = "Algo fallo al eliminar a " . $ID;
        }
        $file = "../asset/LogFile.txt";

        $fl = fopen($file, 'a+');
        fwrite($fl, $message ."\n");
        fclose($fl);

    }
    
   }

?>