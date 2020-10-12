<?php 

    $start = date('Y-m-d');
    $days = 7;

    $d = new DateTime($start);
    $t = $d->getTimestamp();

    // loop for X days
    for($i=0; $i<$days; $i++){

        // add 1 day to timestamp
        $addDay = 86400;

        // get what day it is next day
        $nextDay = date('w', ($t+$addDay));

        // if it's Saturday or Sunday get $i-1
        if($nextDay == 0 || $nextDay == 6) {
            $i--;
        }

        // modify timestamp, add 1 day
        $t = $t+$addDay;
    }

    $d->setTimestamp($t);

    echo $d->format( 'l, F d Y' ). "\n";

?>