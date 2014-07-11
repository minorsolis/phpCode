<?php

/**
 * @param $from
 * @param $to
 * @param string $interval
 * @return float|int
 */
function dateDifference($from,$to,$interval='day'){
    $returnValue    = false;
    $fromTime       = strtotime($from);
    $toTime         = strtotime($to);
    $intervalArray  = array(
        'minute' => (60),
        'hour'   => (60*60),
        'day'    => (60*60*24),
        'week'   => (60*60*24*7),
    );

    $seconds        = ($fromTime - $toTime);
    if($seconds>0){
        if(@$intervalArray[$interval] > 0){
            $returnValue = ($seconds / $intervalArray[$interval]);
        }else{
            $returnValue = $seconds;
        }
    }else{
        $returnValue = $seconds;
    }
    return $returnValue;
}