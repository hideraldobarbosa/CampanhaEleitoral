<?php
    require_once("views/pecas/header.tpl.php");
   
    $oMenubd = New MenuBD;
    $aMenubd = $oMenuBD->GetSetor();
    
?>


<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menu Login Banco de Dados</title>

    <!-- Bootstrap Core CSS -->
    <!--link href="assets/css/bootstrap.min.css" rel="stylesheet"-->
    
    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    
      
    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <!--link href="assets/css/modern-business.css" rel="stylesheet"-->

    <!-- Custom Fonts -->
    <link href="assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>

<body>
    
    <ul>
        <?php 
           //chamar controle e função de buscamodulos
           foreach ($array as $key => $value) {
               echo ('<li>'.nomemenu.'</li>');
           }  
        ?>
        <li><a href="">Categoria</li>
        <ul>
            
            
        </ul>
        
    </ul>
    
</body>
</Html>