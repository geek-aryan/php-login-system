<?php
    $showAlert=false;
    $showError=false;
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        include 'partials/_dbconnect.php';
        $username=$_POST["username"];
        $password=$_POST["password"];
        $cpassword=$_POST["cpassword"];
        
        // Checking username exst already
        $existsSql="Select * from users where username='$username'";
        $result=mysqli_query($con,$existsSql);
        $num=mysqli_num_rows($result);
        if($num<1)
        {
            if(($password==$cpassword))
            {
                $hash=password_hash($password, PASSWORD_DEFAULT);
                $sql="INSERT INTO `users` (`username`, `password`, `date`) VALUES ('$username', '$hash', current_timestamp())";
                $result=mysqli_query($con,$sql);
                if($result)
                {
                    $showAlert=true;
                }
            }
            else{
                $showError='Passwords do not match!!';
            }
        }
        else{
            $showError='Username already exist!!.';
        }
        
    }
    
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIGNUP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
    <?php require 'partials/_nav.php'  ?>
    <?php
        if($showAlert)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Account is now created and you can login.
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
        <h1 class="text-center">Signup to Our Website</h1>
        <form action="/loginsystem/signup.php" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required maxlength="11">
              
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="password" required maxlength="23">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" required maxlength="23">
                <div id="emailHelp" class="form-text">Make sure to type the same password</div>
            </div>
            
            <button type="submit" class="btn btn-primary">Signup</button>
          </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>