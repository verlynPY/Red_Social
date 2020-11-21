<?php  


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

?>