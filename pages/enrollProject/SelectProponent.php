<?php
require_once("class.php");
$EnrollNewProject = new EnrollNewProject();

$Capex = $_POST['Capex'];
$stmts = $EnrollNewProject->runQuery("SELECT proponent From  apollo_projectlist WHERE capex_number = '$Capex'");
$stmts->execute();
$row = $stmts->fetch();
$Proponent = $row['proponent'];   
    echo $Proponent;
?>