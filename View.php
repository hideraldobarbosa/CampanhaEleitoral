<?php

class View {

    public function load($file, $data = null) {


        header('Content-Type: text/html; charset=utf-8');        
        //include("views/$file.tpl.php");
        include("views/$file.php");
        exit();
    }

    function Redirecionar($controller, $action) {
        echo "<script language='JavaScript'> window.location='?controller={$controller}&action={$action}'; </script> ";
        die();
    }

}
