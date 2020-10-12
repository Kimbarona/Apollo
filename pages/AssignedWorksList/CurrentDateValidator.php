<?php

$capex = $_POST['capex'];
require_once("Class.php");
$ListOfWOrks = new ListOfWOrks();

$stmt = $ListOfWOrks->runQuery("SELECT * FROM apollo_enrolledproject WHERE capex_number='$capex'");
        $stmt->execute();
        while ($rowSub = $stmt->fetch(PDO::FETCH_ASSOC)) 
        {
            echo  $rowSub['startdate'];
            
           
        }


?>
