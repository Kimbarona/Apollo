<?php
 require_once("class.php");
 $ProjectMonitoring = new ProjectMonitoring();

    $CapexNumber = $_POST['capex'];

   

        $stmt = $ProjectMonitoring->runQuery("SELECT * FROM apollo_enrolledproject WHERE capex_number='$CapexNumber'");
        $stmt->execute();
        while ($rowSub = $stmt->fetch(PDO::FETCH_ASSOC)) 
        {
            $contractor = $rowSub['contractor'];
            $projectname = $rowSub['project_name'];

                $responseArray["Contractor"] = $contractor;
                $responseArray["ProjectName"] = $projectname;
                echo json_encode($responseArray);
        }

?>