<?php

require_once '../Servicios/DataBase.php';
require_once '../Usuario/usuario.php';


class ManageAmigos extends DB{
   public function AddFriends($Id, $Id_receptor){
        $message;
        $query = "INSERT INTO amigos (id,id_receptor) VALUES (:id, :id_receptor)";
        $stat = $this->connect()->prepare($query);
        $stat->bindParam(':id',$Id);
        $stat->bindParam(':id_receptor',$Id_receptor);

        if($stat->execute()){
            $message = "Agregado Correctamente";
        }
        else{
            $message = "Algo fallo al agregar a $Id_receptor";
        }

        $file = "../asset/LogFile.txt";

        $fl = fopen($file, 'a+');
        fwrite($fl, $message ."\n");
        fclose($fl);
    }
    public function Button_Friends($Id_User,$Id_Receptor){
        $ON;
        $query = "SELECT id, id_receptor FROM amigos WHERE id=:id  AND id_receptor=:id_receptor";
        $statment = $this->connect()->prepare($query);
        $statment->bindParam(':id', $Id_User);
        $statment->bindParam(':id_receptor', $Id_Receptor);
        $data = $statment->execute();
        /*if(count($data) > 0){
            $ON = true;
        }
        else{
            $ON = false;
        }
        return $ON;*/
        return $data;
    }
    

}

?>