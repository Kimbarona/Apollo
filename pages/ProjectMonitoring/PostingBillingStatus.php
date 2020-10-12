<?php
  require_once("class.php");
  $ProjectMonitoring = new ProjectMonitoring();
    $BillingNumber = $_POST['BillNumber'];
    $BillStat = 3;
    if($Setting = $ProjectMonitoring->UpdateBillingStatus($BillingNumber,$BillStat)){
    
    }

  ?>