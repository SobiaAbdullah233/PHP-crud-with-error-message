<?php 
require_once('connection.php');
$id="";
$name="";
$email="";
$phone="";
$address="";

$errormsg="";
$successmsg="";

if($_SERVER['REQUEST_METHOD']=='GET')
{   
    if(!isset($_GET["id"]))
    {
        header("location:/my_crud/index.php");
        exit;
    }
    $id=$_GET["id"];

    $sql="SELECT * from clients where id=$id";
    $result=$connection->query($sql);
    $row=$result->fetch_assoc();
    if(!$row)
    {
        header("location:/my_crud/index.php");
        exit;
    }
    $name=$row["name"];
    $email=$row["email"];
    $phone=$row["phone"];
    $address=$row["address"];

    
}
else{
    $id=$_POST["id"];
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];

    // validation of form entery data
    if(empty($id)||empty($name)||empty($email)||empty($phone)||empty($address))
    {
        $errormsg="All the fields are required";  
  
    }

    // add data from new client
    $sql = "UPDATE clients " .
    "SET name='$name', email='$email', phone='$phone', address='$address' " .
    "WHERE id=$id;";
    $result=$connection->query($sql);
    if(!$result)
    {
        $errormsg="Invalid Query:". $connection->error;
        
    }
    $successmsg="Client Updated Correctly";
    header("location:/my_crud/index.php");
    exit;

} 

?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>My Crud</title>
</head>
<body class="bg-secondary">
    <div class="container my-5">
        <h2>New Client</h2>
  <?php 
  if(!empty($errormsg))
  {
  echo "
  <div div class='row'>
  <div class='col-md-6'>
  <div class='alert alert-warning alert-dismissible' role='alert'>
  <strong>$errormsg</strong> 
  <button class='btn btn-close' data-bs-dismiss='alert' aria-label='close'></button>
  </div>
</div>
</div>
  ";}
  ?>

<div class="row">
    <div class="col-md-6 ">
    <form  method="post" >
        <input type="hidden" name="id" value="<?php echo"$id" ?>">
  <div class="mb-3 mt-3">
    <label for="name" class="form-label text-white" >Name:</label>
    <input type="name" class="form-control bg-light" id="name"placeholder="Enter Name" name="name"  value="<?php echo "$name"?>" >
  </div>

  <div class="mb-3">
    <label for="email" class="form-label  text-white">Email:</label>
    <input type="email" class="form-control bg-light" id="email" placeholder="Enter Email" name="email"  value="<?php echo "$email"?>" >
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label  text-white">Phone:</label>
    <input type="text" class="form-control bg-light" id="phone" placeholder="Enter Phone" name="phone"  value="<?php echo "$phone"?>" >
  </div>
  <div class="mb-3">
    <label for="address" class="form-label  text-white">Address:</label>
    <input type="address" class="form-control bg-light" id="address" placeholder="Enter address" name="address"  value="<?php echo "$address"?>" >
  </div>
  <?php
  if(!empty($successmsg))
  {
    echo "
    <div class='alert alert-success alert-dismissible fade-show' role='alert'>
    <strong>$successmsg</strong> 
    <button class='btn btn-close' data-bs-dismiss='alert' aria-label='close'></button>
  </div>
    ";
  }
  ?>


  

  <button type="submit" class="btn btn-primary">Submit</button>
  <button type="button" class="btn btn-outline-primary text-white bg-info" href="/my_crud/index.php" role="button">Cancle</button>
</form>
  </div>
</div>
</div>
</body>
</html>