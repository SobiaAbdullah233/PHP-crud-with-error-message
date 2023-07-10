<?php
require_once('connection.php');
if(isset($_GET["id"]))
{
    $id=$_GET["id"];
$sql="DELETE from clients where id=$id";
$connection->query($sql);
}
header("location: /my_crud/index.php");
exit;

?>