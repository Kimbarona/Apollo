<?php
    require_once("GlobalClass.php");
    $GlobalConnection = new GlobalConnection();

    $Id = $_POST['Id'];
    // echo $Id;
    echo $TagNumber = $_POST['TagNumber'];
    echo $VoucherNumber = $_POST['VoucherNumber'];

    if($GlobalConnection->UpdateBillingDetails($Id, $TagNumber, $VoucherNumber)){
        echo 'Updated Successfully!';
    }else{
        echo "Opps! there's an error!";
    }

?>