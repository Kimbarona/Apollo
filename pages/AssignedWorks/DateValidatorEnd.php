<?php
$Capex = $_POST['capex'];
$EndDate = $_POST['EndDate'];
require_once("Class.php");
$AssignedWorks = new AssignedWorks();

$stmt = $AssignedWorks->runQuery("SELECT * FROM apollo_enrolledproject WHERE capex_number='$Capex'");
        $stmt->execute();
        while ($rowSub = $stmt->fetch(PDO::FETCH_ASSOC)) 
        {
            
            
                echo  $rowSub['end_date'];
         
            
        }

?>