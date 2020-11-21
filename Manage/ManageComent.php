<?php
require_once '../Servicios/DataBase.php';
require_once '../Usuario/usuario.php';


class ManageComent extends DB{

    function CreateComent($UserId, $PublicacionId, $Texto){
        $stmt = $this->connect()->prepare('INSERT INTO comentarios (id, publicacionid,texto) VALUES
        (:id, :publicacionid, :texto)');
        $stmt->bindParam(':id',$UserId);
        $stmt->bindParam(':publicacionid',$PublicacionId);
        $stmt->bindParam(':texto',$Texto);

        if($stmt->execute()){
            $message = 'El usuario se ha registrado con exito';
         }else{
            $message = 'Ha ocurrido un fallo al crear la cuenta';
         }
    }
    function MostrarComentarios(){
        $query = "SELECT C.id,C.texto,C.publicacionid, U.id, U.nombre, P.publicacionid  FROM comentarios C
        INNER JOIN publicaciones P ON C.publicacionid = P.publicacionid
        INNER JOIN usuario U ON C.id = U.id" ;

        $conn = $this->connect()->prepare($query);
        $conn->execute();
        $result = $conn->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}

?>