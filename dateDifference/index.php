<?php
include_once("dateDifference.php");

$from         = date("Y-m-d");
$to           = "2014-01-01";
$interval     = 'day';

echo "from: $from <br/>";
echo "to: $to <br/>";
echo "interval: $interval <br/>";
echo "result = ".dateDifference($from,$to,$interval);

