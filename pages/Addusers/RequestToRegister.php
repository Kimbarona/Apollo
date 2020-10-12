<?php
require_once("class_userAccount.php");
$user = new user();

$FullName = $_POST['FullName'];
$UserName = $_POST['UserName'];
$Password = $_POST['user_password'];
$Position = $_POST['Position'];

$Pass = md5($Password);


    if($user->UserRegistration($FullName, $UserName, $Pass, $Position)){
   
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>ok!</strong> Successfully saved!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span class="fa fa-times"></span>
        </button>
    </div>
    <?php

   }
   else{
    
   }
   
