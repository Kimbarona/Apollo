<?php
 require_once("class.php");
 $ForGanttChart = new ForGanttChart();

 $CapexNumber = $_POST['capex'];
 
 $Slacks = $ForGanttChart->runQuery("SELECT project_name FROM apollo_enrolledproject WHERE capex_number='$CapexNumber'");
 $Slacks->execute();
 $row = $Slacks->fetch();

 $a = $row['project_name'];
 echo $a;
?>