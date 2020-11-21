<?php

require_once '../Amigos/Friends.php';
require_once '../Manage/ManageAmigos.php';
require_once '../Manage/ManageUsuario.php';

session_start();
$manageuser = new ManageUsuario();
$manageamigo = new ManageAmigos();

$amigos = new Amigos();



$result = $manageuser->ShowAllUser();
    if(isset($_POST['btnamigos'])){
          $amigos->id = $_SESSION['usuarioid'];
    $amigos->id_receptor = $_POST['id'];
    var_dump($amigos->id,$amigos->id_receptor);
    $manageamigo->AddFriends($amigos->id,$amigos->id_receptor);

    }
  
/*if(isset($_SESSION['usuarioid'])){
    
}*/


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
        color:#0071a3;
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
        margin-bottom:50px;
        
      /*  position:fixed;
        top:0;  */
        
    }
   .col{
  
   
        margin: 0 auto;
        
        background: #c0a6f0;
        border-radius: 10px 10px 10px 10px;
       
   }
    .c{
           background: #c0a6f0;
    }
    i{
        padding-left:10px;
        padding-right:10px;
    }
    a{
        color:#fff;
    }
    #exit{
        color:red;
    }
    
    </style>
</head>
<body>
    
<div class="nav">
        <div class="menu ">
  
        <div class="row ">
    <div class="col text-center ">
      
        <a class="btn btn-lg" href="AllUsers.php" ><i class="glyphicon glyphicon-user"></i></a>
       <a class="btn btn-lg" href="Home.php"><i class="glyphicon glyphicon-home"></i></a>
        <a class="btn btn-lg" id="exit" href="../Login_Registro/Logout.php"><i class="glyphicon glyphicon-off"></i></a>
      
       
    </div>
  </div>
        </div>
    </div>  

    <div class="row">
 
    
    <div class="col col-sm-5">
    <div class="col text-center">
    <?php foreach($result as $item): ?>
        <form method="POST" action="AllUsers.php">
            <div class="card-header border-success ">Desconocido</div>
            <div class="card-body text-light">
            <h5 ><?php echo $item['nombre_usuario']?></h5>
            <p><?php echo $item['nombre']. " " . $item['apellido']?></p>
       
            </div>
            <input type="hidden" name="id" value="<?php echo $item['id']?>"/>
            <input type="submit" name="btnamigos" class="btn btn-dark" value="Agregar Amigos"/>
    </form>
    <?php endforeach;?>
   </div>
   
    </div>

</body>
</html>