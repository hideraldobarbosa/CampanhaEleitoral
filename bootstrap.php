<?php

require('config.php');

error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1);  
function appload($classe) {
	$dir = realpath(dirname(__FILE__));
  
	$arquivo = "$dir/$classe.php";
	if(file_exists($arquivo)) {
		require_once($arquivo);
		return true;
	}
}

function modload($classe) {
	$dir = realpath(dirname(__FILE__));
	$arquivo = "$dir/controllers/$classe.php";

	
	if(file_exists($arquivo)) {
		require_once($arquivo);
		return true;
	}
}

function modelload($classe){
    $dir = realpath(dirname(__FILE__));
    $arquivo = "$dir/model/$classe.php";

	
    if(file_exists($arquivo)){
        require_once($arquivo);
        return true;
    }
}

function libsload($classe){
    $dir = realpath(dirname(__FILE__));
    $arquivo = "$dir/app/helpers/$classe.php";
     if(file_exists($arquivo)){
        require_once($arquivo);
        return true;
    }
}

require_once(dirname(__FILE__) . '/lib/Doctrine.php');
require_once(dirname(__FILE__) . '/lib/fpdf17/fpdf.php');
require_once(dirname(__FILE__) . '/lib/PHPMailer/PHPMailerAutoload.php');

spl_autoload_register(array('Doctrine', 'autoload'));
spl_autoload_register('libsload');
spl_autoload_register('appload');
spl_autoload_register('modload');
spl_autoload_register('modelload');
$manager = Doctrine_Manager::getInstance();
$db = Doctrine_Manager::connection("{$config['driver']}://{$config['usuario']}:{$config['senha']}@{$config['host']}/{$config['banco']}");
$manager->setAttribute(Doctrine_Core::ATTR_QUOTE_IDENTIFIER, true);
$manager->setAttribute(Doctrine_Core::ATTR_SEQNAME_FORMAT, '%s_seq');

$statement = Doctrine_Manager::getInstance()->connection();
$results = $statement->execute("Set search_path to public;");

//Gerar classes
Doctrine_Core::generateModelsFromDb('model', array('doctrine')); 