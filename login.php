<?php
$serverName = "localhost";
$user= 'root';
$db = 'ussdsecontrial';
$pass= "";
$con = new mysqli($serverName,$user,$pass,$db);
if (isset($_POST['name']) && isset($_POST['pass'])){
$username =$_POST["name"]; ;
$password = $_POST["pass"];


$query = "SELECT * FROM admin WHERE name='$username' AND password = '$password'";
$result = $con->query($query);
if(mysqli_num_rows($result) ==1){
    session_start();
    $_SESSION['auth'] = true;
    $_SESSION['username'] = $username;
    if($_SESSION['auth']){
    header('location: /admin/index.php');
    }
  }else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Details not found</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <style>
      body {
        background-color: #f8f8f8;
        font-family: Arial, sans-serif;
      }

      h1 {
        text-align: center;
        color: #004c6d;
        margin-top: 50px;
      }

      .login-box {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        margin: 0 auto;
        margin-top: 50px;
        padding: 20px;
      }

      .login-box label {
        display: block;
        color: #333;
        font-size: 18px;
        margin-bottom: 10px;
      }

      .login-box input[type=text], .login-box input[type=password] {
        width: 90%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
      }

      .login-box button[type=submit] {
        background-color: #004c6d;
        border: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 18px;
        cursor: pointer;
        width: 100%;
        margin-top: 20px;
      }

      .login-box button[type=submit]:hover {
        background-color: #346888;
      }

      .alert {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
      }

      .alert strong {
        font-weight: bold;
      }

      .alert button {
        float: right;
        border: none;
        background-color: transparent;
        color: inherit;
        font-size: 20px;
        cursor: pointer;
      }

      .alert button:focus {
        outline: none;
      }
      img {
        height: 100px;
        width: 100px;
        display: block;
        margin-left: auto;
        margin-right: auto;
}

    </style>
  </head>
  <body>
    <h1>Welcome to the Admin Page</h1>
    <img src="./icon2.jpeg" alt="Icon">
    <div class="login-box">
      <form method="POST">
        <?php
          if (isset($errorMessage)) {
            echo '<div class="alert">' . $errorMessage . '<button type="button" onclick="this.parentNode.parentNode.removeChild(this.parentNode);" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
          }
        ?>
         <div class="form-group">
              <label for="name">Username</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Username">
          </div>
          <div class="form-group">
              <label for="pass">Password</label>
              <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-info btn-block">Submit</button>
      </form>
    </div>
  </body>
</html>

