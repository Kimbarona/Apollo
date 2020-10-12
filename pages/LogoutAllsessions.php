<?php
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['fullname']);
    unset($_SESSION['position']);
    unset($_SESSION['engineer']);

    if(!isset($_SESSION['id'])){
        ?>
        <script>
            // alert('Username or Password is Incorect!');
            window.location.assign('../login.php');
                    
        </script>
    <?php
    }
    
?>