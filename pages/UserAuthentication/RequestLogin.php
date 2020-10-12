<?php

session_start();

require_once("class.php");
$UserLogin = new UserLogin();

$UserName = $_POST['userName'];
$UserPass = $_POST['password'];
$today = $_POST['today'];

// echo $UserPass;
$EncryptPass = md5($UserPass);

$stmts = $UserLogin->runQuery("SELECT * From apollo_useraccounts WHERE username = '$UserName' AND user_password='$EncryptPass'");
$stmts->execute();

$updateActualDate = $UserLogin->UpdateActualStartDate($today);


$row = $stmts->fetch();
  $Position = $row['position'];
  $FullName = $row['fullname'];
  $UserId = $row['id'];
if ($row !=0) {
        if($Position =='Admin')
        {
        //   echo $Position;
        header("Location:../index.php");
            $_SESSION['position'] = $Position;
            $_SESSION['fullname'] = $FullName;
            $_SESSION['id'] = $UserId;
        exit();
        }

        elseif($Position =='Head')
        {
            // echo $Position;
            header("Location:../index.php");
                $_SESSION['position'] = $Position;
                $_SESSION['fullname'] = $FullName;
                $_SESSION['id'] = $UserId;
        exit();
        }

        elseif($Position =='Eo')
        {
            // echo $Position;
            header("Location:../index.php");
                $_SESSION['position'] = $Position;
                $_SESSION['fullname'] = $FullName;
                $_SESSION['id'] = $UserId;

        exit();
        }

        elseif($Position =='Planner')
        {
            // echo $Position;
            header("Location:../enrollProject.php");
                $_SESSION['position'] = $Position;
                $_SESSION['fullname'] = $FullName;
                $_SESSION['id'] = $UserId;

        exit();
        }

        elseif($Position =='Proponent')
        {
            // echo $Position;
            header("Location:../SecondApprovalOfBilling.php");
                $_SESSION['position'] = $Position;
                $_SESSION['fullname'] = $FullName;
                $_SESSION['id'] = $UserId;

        exit();
        }

        elseif($Position =='Approver-2')
        {
            // echo $Position;
            header("Location:../ThirdApprovalOfBilling.php");
                $_SESSION['position'] = $Position;
                $_SESSION['fullname'] = $FullName;
                $_SESSION['id'] = $UserId;

        exit();
        }

        elseif($Position =='Final-Approver')
        {
            // echo $Position;
            header("Location:../FinalApprovalOfBilling.php");
                $_SESSION['position'] = $Position;
                $_SESSION['fullname'] = $FullName;
                $_SESSION['id'] = $UserId;

        exit();
        }

        elseif($Position =='Amg')
        {
            // echo $Position;
            header("Location:../PrintingOfBillings.php");
                $_SESSION['position'] = $Position;
                $_SESSION['fullname'] = $FullName;
                $_SESSION['id'] = $UserId;

        exit();
        }

        elseif($Position =='Finance-FA')
        {
            // echo $Position;
            header("Location:../projectMasterlist.php");
                $_SESSION['position'] = $Position;
                $_SESSION['fullname'] = $FullName;
                $_SESSION['id'] = $UserId;

        exit();
        }

        elseif($Position =='Internal-Audit')
        {
            // echo $Position;
            header("Location:../ProjectCostDetailsAudit.php");
                $_SESSION['position'] = $Position;
                $_SESSION['fullname'] = $FullName;
                $_SESSION['id'] = $UserId;

        exit();
        }

        elseif($Position =='Finance-Tagging')
        {
            // echo $Position;
            header("Location:../BudgetedVsApplied.php");
                $_SESSION['position'] = $Position;
                $_SESSION['fullname'] = $FullName;
                $_SESSION['id'] = $UserId;

        exit();
        }
        
        
        }   
        else
        {    
            ?>
        <script>
            alert('Username or Password is Incorect!');
            window.location.assign('../../login.php');
                    
        </script>
    <?php
        }


?>