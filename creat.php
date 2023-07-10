<?php 
require_once('connection.php');
$name="";
$email="";
$phone="";
$address="";

$errormsg="";
$successmsg="";

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];
}


    if(empty($name)||empty($email)||empty($phone)||empty($address))
    {
        $errormsg="All the fields are required";  
    } 
    else {
      $sql="SELECT * from clients where email = '$email'";
      $result=$connection->query($sql);
      if(!$result)
      {
          die("invalid query:".$connection->error);
      }
      
     $old_records = $result->fetch_all();
     if(sizeof($old_records)> 0) {
        $errormsg = "This email is already exists";
     } else {
      $sql = "INSERT INTO clients(name,email,phone,address) " .
      "VALUES('$name','$email','$phone','$address')";

          $result=$connection->query($sql);
          if(!$result)
          {
          $errormsg="Invalid Query:".$connection->error;
          exit;
          }
           else
         {
          header("location:/my_crud/index.php");

          }
          
          $name="";
          $email="";
          $phone="";
          $address="";
          $successmsg="Client Added Correctly";
          
            }
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
  if(!empty($errormsg)){
  echo "
  <div div class='row'>
  <div class='col-md-6'>
  <div class='alert alert-warning alert-dismissible' role='alert'>
  <strong>$errormsg</strong> 
  <button class='btn btn-close' data-bs-dismiss='alert' aria-label='close'></button>
  </div>
</div>
</div>
  ";
  }
  ?>

<div class="row">
    <div class="col-md-6 ">
    <form  method="post" >
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
  <button type="button" class="btn btn-outline-primary  text-white bg-info"  role="button"><a href="/my_crud/creat.php">Cancle</a></button>
</form>
  </div>
</div>
</div>
</body>
</html>