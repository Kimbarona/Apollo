<?php
require_once("class_userAccount.php");
$user = new user();

$newpass = $_POST['newpass'];
$oldusername = $_POST['oldusername'];
$Pass = md5($newpass);

$stmts = $user->runQuery("SELECT * From apollo_useraccounts WHERE username = '$oldusername'");
$stmts->execute();
$row = $stmts->fetch();

if($row!=0){
    if($user->UserUpdate($Pass, $oldusername)){   
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>ok!</strong> Successfully saved!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="fa fa-times"></span>
            </button>
    </div>
    <?php
   }
  }

else{
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Opps!</strong> Please Enter correct Username!!.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span class="fa fa-times"></span>
        </button>
</div>
<?php
}