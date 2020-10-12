<html>
    <head>
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        ?>
        <p class="txtFormat">
          INITIAL PAYMENT
        </p>
        <?php
        $curr_date = "2019-06-30";
        $tstamp =  strtotime($curr_date);
        $old_date = date('l, F d Y', $tstamp);              // returns Saturday, January 30 10 02:06:34
        $old_date_timestamp = strtotime($old_date);
        $new_date = date('Y-m-d ', $old_date_timestamp);
        
        $NAME = "kim";
        echo $old_date;

       $fname=$_SESSION['fullname'];
        $a = strtoupper($fname);
        echo $a;
        ?>
    </body>
</html>