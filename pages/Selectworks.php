<?php
    require_once("Class.php");
    $AssignedWorks = new AssignedWorks();
//select.php
$CapexNumber = $_POST['CapexNumber'];

$query = "SELECT * FROM apollo_project_assigned_scopes WHERE capex_number = '$CapexNumber' AND work_status ='Open'";  

$statement = $AssignedWorks->runQuery($query);

if($statement->execute())
{
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }

 echo json_encode($data);
}

?>
