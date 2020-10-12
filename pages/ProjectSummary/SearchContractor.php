<?php
 require_once("class.php");
 $ProjectSummary = new ProjectSummary();

    $CapexNumber = $_POST['capex'];

   

        $stmt = $ProjectSummary->runQuery("SELECT * FROM apollo_enrolledproject WHERE capex_number='$CapexNumber'");
        $stmt->execute();
        while ($rowSub = $stmt->fetch(PDO::FETCH_ASSOC)) 
        {
            $result = $rowSub['contractor'];

            echo $result;
        }

?>