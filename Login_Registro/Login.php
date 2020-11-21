<?php

session_start();

require_once '../Servicios/DataBase.php';
require_once '../Usuario/usuario.php';
require_once '../Manage/ManageUsuario.php';



    if(isset($_SESSION['usuarioid'])){
        header('Location: ../Navegacion/Home.php');
    }

    $manageuser = new ManageUsuario();


    $message = '';
if(!empty($_POST['Correo']) && !empty($_POST['Contraseña'])){
    $manageuser->Login($_POST['Correo'],$_POST['Contraseña']);
    $message = "Datos no validos";
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
    
    <title>Red Social</title>

    <style>
        body{

            background: rgb(202,26,210);
background: linear-gradient(90deg, rgba(202,26,210,1) 0%, rgba(127,63,255,1) 0%, rgba(163,50,215,1) 0%, rgba(103,101,226,1) 100%);

  
   }
        .row{
           
        width: 50%;
        height:380px;
        margin: 0 auto;
        margin-top:50px;
        padding: 85px;
        background: #8a32d7;
        border-radius: 10px 10px 10px 10px;
      
        
        }
        .form-group{
            margin-top:20px;
        }
        .btn{
            width:100%;
        }
        h1{
            color:#fff;
        }
        .form-control{
            background:#c7b0f5;
        }
        ::placeholder{
            color: #fff;
            font-size: 1.5em;
        }
       
    </style>
</head>
<body>

<?php if(ManageUsuario::$validar):?>
        <h2 ><center><?php echo $message?></center></h2>
        <?php endif; ?>


<div clas="col text-center ">

<div class="row">
  
   <div class="col-sm-12">
   
   <h1><center>Iniciar Session</center></h1>
   <form method="POST" action="Login.php">
    <div class="form-group">
   <input type="text" name="Correo" class="form-control" placeholder="Correo"/>
    </div>
    <div class="form-group ">
   <input type="password" name="Contraseña" class="form-control" placeholder="Contraseña"/>
    </div> 
    <button type="submit" class="btn btn-outline-light btn-lg">Iniciar Session</button>
    </form>
        <div>
            <a class="btn btn-outline-light btn-lg" href="Registro.php">Crear Cuenta</a>
         </div>
   </div>
</div>
</div>
</body>
</html>