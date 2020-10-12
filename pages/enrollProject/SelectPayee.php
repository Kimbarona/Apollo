<?php
require_once("class.php");
$EnrollNewProject = new EnrollNewProject();

$Cantractor = $_POST['Cantractor'];
$stmts = $EnrollNewProject->runQuery("SELECT contact_person From  apollo_contractor_list WHERE contractor_name = '$Cantractor'");
$stmts->execute();
$row = $stmts->fetch();
$Payee = $row['contact_person'];   
    echo $Payee;
?>