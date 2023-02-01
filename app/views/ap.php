<?php
header("Access-Control-Allow-origin: http://localhost/CineHall/");
header("content-type:application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:*");
header("Access-Control-Max-Age:3600");
header("Access-Control-Allow-Header:*");
$data=array(
    "name"=>"smiya",
    "age"=>"3mor",
    "ville"=> "mdina"
);
$json_data= json_encode($data);
print_r($json_data);