<?php
 session_start();

 require_once("Class.php");
 $AssignedWorks = new AssignedWorks();

    $CapexNumber = $_POST['capex'];

   

        $stmt = $AssignedWorks->runQuery("SELECT * FROM apollo_enrolledproject WHERE capex_number='$CapexNumber'");
        $stmt->execute();
        while ($rowSub = $stmt->fetch(PDO::FETCH_ASSOC)) 
        {
            $result =($rowSub['ecost']);
            $User = $rowSub['engineer'];
            $responseArray["Ecost"] = $result;
            $responseArray["User"] = $User;
            
            echo json_encode($responseArray);
            // $_SESSION['engineer']=$User;
           
        }
     
?>
      
  