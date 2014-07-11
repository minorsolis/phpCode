<?php
include_once("curl.php");

$url = "http://www.google.com";
$params = array('search'=>'example');

echo curlPost($url,$params);