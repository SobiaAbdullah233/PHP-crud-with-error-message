<?php

$servername="localhost";
$username="root";
$password="";
$database="my_crud";
$connection=new mysqli($servername,$username, $password,$database);
if($connection->connect_error)
{
    die("connection faield:".$connection->connect_error);
}
// echo "Connected Successfully";
// selecting data from table of  databas

?>