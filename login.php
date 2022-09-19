<?php
    $login=false;
    $showError=false;
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        include 'partials/_dbconnect.php';
        $username=$_POST["username"];
        $password=$_POST["password"];

       
        // $sql="Select * from users where username='$username' and password='$password'";
        $sql="Select * from users where username='$username'";
        $result=mysqli_query($con,$sql);
        $num=mysqli_num_rows($result);
        if($num==1)
        {
            while($row=mysqli_fetch_assoc($result))
            {
                if(password_verify($password,$row['password']))
                {
                  $login=true;
                  session_start();
                  $_SESSION['loggedin']=true;
                  $_SESSION['username']=$username;
                  header("location: welcome.php");
                }
                else{
                  $showError='Invalid Credintials';
                }
            }     
        }
    }
    
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
    <?php require 'partials/_nav.php'  ?>
    <?php
        if($login)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> You are logged in.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }   
    ?> 
    <?php
        if($showError)
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed!</strong> '.$showError.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }   
    ?> 


    <div class="container">
        <h1 class="text-center">Login to Our Website</h1>

        <form action="/loginsystem/login.php" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
              
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="password" required>
            </div>
            
            
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>