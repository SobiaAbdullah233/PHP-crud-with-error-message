<?php require_once('connection.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Crud</title>


</head>
<body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        <a class="btn btn-primary" href="/my_crud/creat.php" role="button">New Client</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Creat At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <!-- connecting this page with database -->
                <?php
 

                $sql="SELECT * from clients";
                $result=$connection->query($sql);
                if(!$result)
                {
                    die("invalid query:".$connection->error);
                }

                while($row=$result->fetch_assoc())
                {
                    echo "
                    <tr>
                <td>$row[id]</th>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[address]</td>
                <td>$row[creat_at]</td>
                <td>
                <a class='btn btn-primary btn-sm' href='/my_crud/update.php?id=$row[id]'>Edit</a>
                <a class='btn btn-danger btn-sm' href='/my_crud/delete.php?id=$row[id]'>Delete</a>
                </td>
            </tr>
                    ";
                }
                ?>
            
            </tbody>
        </table>

    </div>
</body>
</html>