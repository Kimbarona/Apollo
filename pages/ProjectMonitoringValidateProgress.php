<?php
require_once("GlobalClass.php");
$GlobalConnection = new GlobalConnection();

    $Id = $_POST['Id'];
        $ValidateProgress = $GlobalConnection->runQuery("SELECT * FROM `apollo_project_assigned_scopes` WHERE id='$Id'");
        $ValidateProgress->execute();
        $Validate = $ValidateProgress->fetch();

        $Progress = $Validate['subscope_percent'];
        echo $Progress;

?>