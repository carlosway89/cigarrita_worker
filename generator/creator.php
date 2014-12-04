<?php 

require_once('generator.php');


// $_POST['table'];

$table=$_POST['table'];
$app=$_POST['aplication']?$_POST['aplication']:'cigarrita/app';
$variable= new generator_model();

$variable->write($table,$app);


?>