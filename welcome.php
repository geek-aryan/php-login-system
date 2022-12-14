<?php 
    session_start();
    if(!isSet($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
    {
        header("location: login.php");
        exit;
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WELCOME-<?php echo $_SESSION["username"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
   <?php require 'partials/_nav.php' ?>
   <h1 class="text-center">
        WELCOME-<?php echo $_SESSION["username"] ?>
   </h1>   



   <div class="container">
        <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">WELCOME-<?php echo $_SESSION["username"] ?></h4>
        <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
        <hr>
        <p class="mb-0">Whenever you need to, be sure to logout <a href="/loginsystem/logout.php"> using this link.</a></p>
        </div>
   </div>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>