<?php

require_once '../Servicios/DataBase.php';
require_once '../Usuario/usuario.php';
require_once '../Manage/Public.php';
require_once '../Publicaciones/publicaciones.php';
require_once '../Comentario/Comentarios.php';
require_once '../Manage/ManageComent.php';
require_once '../Manage/ManageUsuario.php';

session_start();

$publi = new Publica();
$manageuser = new ManageUsuario();
if(isset($_SESSION['usuarioid'])){
    $resu = $publi->MostrarPublicacion();
 }
 else{
     header('Location: ../Login_Registro/Login.php');
 }
   // $publicar = new Publica();
 


    
    $usuario = new Usuario();
    $publicaciones = new Publicaciones();
    if(isset($_POST['descripcion'])){
        $publicaciones->id = $_SESSION['usuarioid'];
        $publicaciones->Descripcion = $_POST['descripcion'];
      /*  $date = new DateTime();
        $publicaciones->Fecha = $date->format('d-m-y');

        //$publicar->Agregar($publicaciones->id,$publicaciones->Descripcion,$publicaciones->Fecha);
        $sql = "INSERT INTO publicaciones (id, descripcion, fecha) VALUES (:id, :descripcion, :fecha)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$publicaciones->id);
        $stmt->bindParam(':descripcion', $publicaciones->Descripcion);
        $stmt->bindParam(':fecha',$publicaciones->Fecha);
        $stmt->execute();*/
        $publi->AgregarPublicacion($publicaciones->id, $publicaciones->Descripcion);
        $resu = $publi->MostrarPublicacion();
       
       
      
    


}
   $managecoment = new ManageComent();
   $comentarios;
   $comentarios = $managecoment->MostrarComentarios();
  
  if(isset($_POST['btncoment'])){
      $comentario = new Comentario();
      $comentario->id = $_SESSION['usuarioid'];
      $comentario->Publicacionid = $_POST['publicacionid'];
      $comentario->Texto = $_POST['texto'];
   
      $managecoment->CreateComent($comentario->id,$comentario->Publicacionid,$comentario->Texto);
      $comentarios = $managecoment->MostrarComentarios();
      
    
  }
  if(isset($_POST['btn_update'])){
      $Idupdate = $_POST['idupdate'];
      $Textupdate = $_POST['textoupdate'];
      $publi->EditarPublicacion($Idupdate,$Textupdate);
     $managecoment->MostrarComentarios();
  }
  if(isset($_POST['btn_delete'])){
    $ID = $_POST['publicacioniddelete'];
    $publi->EliminarPublicacion($ID);
    $publi->MostrarPublicacion();
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css"/>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/App.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
   
   
   
   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>

        body{
            background: rgb(202,26,210);
background: linear-gradient(90deg, rgba(202,26,210,1) 0%, rgba(127,63,255,1) 0%, rgba(163,50,215,1) 0%, rgba(103,101,226,1) 100%);

        }   
       

    .nav{
        width: 30%;
        margin: 0 auto;
        padding: 2px;
        background: #c0a6f0;
        color:#fff;
        border-radius: 0px 0px 40px 40px; 
        box-shadow: 1px 1px 1px 1px #794feb;  
        justify-content: center;
        
      /*  position:fixed;
        top:0;  */
        
    }
   
    ::placeholder{
            color: #fff;
            font-size: 1.5em;
        }
    i{
        padding-left:10px;
        padding-right:10px;
    }
    .card{
        border-radius: 10px 10px 10px 10px;
        background: #c0a6f0;
        color:#606060;
        font-size:14px;
    }
    .main{
        width: 50%;
        height:200px;
        margin: 0 auto;
        margin-top:50px;
        padding: 15px;
        background: #c0a6f0;
        border-radius: 10px 10px 10px 10px;
        box-shadow: 2px 2px 2px 2px #c7c7c7; 
    }
    .publicaciones{
        margin-top:120px;
    }
    p{
        display:inline;
    }
    #text{
        resize: none;
        height: 100px;
        opacity:0.5;
        font-size:12px;
        border-radius: 10px 10px 10px 10px;
    }
    #tt{
        opacity:0.5;
        font-size:12px;
        border-radius: 10px 0px 0px 10px;
    }
    #exit{
        color:red;
    }
    h3, main{
        margin:12px;
        color:#fff;
    }
    h3{
        position:fixed;
        font-style: cursive;
    }
    img{
        border-radius:50%;
    }
  #name{
      border-radius:50%;
      position:fixed;
      padding:15px;
  }
    a{
        color:#fff;
    }
    #trash{
        color:red;
    }
    $upt{
        color:#0071a3;
    }
    
    </style>
</head>
<body>






  
      


    <div class="nav">
        <div class="menu ">
  
        <div class="row ">
    <div class="col text-center ">
        <?php if(!empty($resu)):?>
        <a class="btn btn-lg" href="AllUsers.php" ><i class="glyphicon glyphicon-user"></i></a>
       <a class="btn btn-lg" href="Home.php"><i class="glyphicon glyphicon-home"></i></a>
        <a class="btn btn-lg" id="exit" href="../Login_Registro/Logout.php"><i class="glyphicon glyphicon-off"></i></a>
        <?php else:?>
            <div>
            <a class="btn-outline-light btn-lg" href="../Login_Registro/Login.php">Iniciar Session</a>
         </div>
         <?php endif?>
       
    </div>
  </div>
        </div>
    </div>  
    <div id="name">
    <center>
    <img src="../asset/descarga.png" width="120px" height="120px"/>
    <h3><strong><?php echo $manageuser->GetName($_SESSION['usuarioid']);?></strong></h3>
    </center>
    </div>
    
    <div class="main">
        <div>
            <form method="POST" action="Home.php">
                <div class="form-group">
                     <label for="exampleFormControlTextarea1">publicacion</label>
                     <textarea class="form-control" name="descripcion" id="text" rows="3" placeholder="Que quieres publica?"></textarea>
                </div>
                <div>
                <input type="submit" class="btn btn-dark btn-lg float-right " value="Publicar"/>
                
                </div>
            </form>
        <div>
    </div>
<?php foreach($resu as $item):?>
    <form method="POST" action="Home.php">
<div class="publicaciones">
    <div class="card border-light mb-3" style="max-width: 100%, max-height: 45%">
  <div class="card-header bg-transparent border-light">
  <p><?php echo $item['publicacionid']?></p>
  <?php if($_SESSION['usuarioid'] == $item['id']):?>
 
 
 
  <a class="btn" id="upt" data-toggle="modal" data-target="#exampleModalCenter"><i class="glyphicon glyphicon-pencil pull-right"></i></a>
  <form method="POST" action="Home.php">
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $item['publicacionid']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input class="form-control" name="textoupdate" placeholder="Escribe el texto aqui" value="<?php echo $item['descripcion']?>"/>
        <input class="form-control" type="hidden" name="idupdate"  value="<?php echo $item['publicacionid']?>"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancelar</button>
        <input type="submit" name="btn_update" class="btn btn-dark" value="Guardar Cambios"/>
      </div>
    </div>
  </div>
    </form>


</div>  

 <a class="btn" id="trash" data-id="<?php echo $item['publicacionid']?>"><i class="glyphicon glyphicon-trash pull-right"></i></a>


<?php endif;?>

  </div>
  <div class="card-body text-light">
    <p class="card-text"><?php echo $item['descripcion']?></p>
  </div>
  <div class="card-footer bg-transparent border-light"><?php echo $item['fecha']?>
  </div>

  <div class="card-footer bg-transparent border-transparent">
   <div class="input-group mb-3">
  <input type="text" class="form-control border-secondary" id="tt" name="texto" placeholder="Escribe un comentario" aria-label="Recipient's username" aria-describedby="basic-addon2">
    <input type="hidden" name="publicacionid" value="<?php echo $item['publicacionid']?>"/>    
  
  <div class="input-group-append">
    <input class="input-group btn btn-dark btn-lg coment" type="submit" name="btncoment" value="Comentar"/>
   </form>
   
</div>


  </div>
  <p>
      <a class="btn " data-toggle="collapse" href="#colapso1" role="button">Ver Comentarios<i class="glyphicon glyphicon glyphicon-chevron-down"></i></a>
    </p>
    <?php foreach($comentarios as $listComent):?>
    <div id="colapso1" class="collapse">
      <div class="card card-body">
      <h5><?php echo $listComent['nombre']?></h5>
      <p><?php echo $listComent['texto']?></p>
      
      </div>
    </div>
    <?php endforeach;?>
</div>
</div>

<?php endforeach;?>

        <script src="../js/Sections/index.js"></script>

</body>
</html>