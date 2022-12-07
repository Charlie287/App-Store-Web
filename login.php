<?php
session_start();
require_once('db.php');
if (isset($_POST['login'])) {
  $error = '';
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, $_POST['password']);
  $select = mysqli_query($con, "SELECT `email` FROM `account` WHERE `email` = '" . $email . "'");

  if (empty($email)) {
    $error = 'Please enter your email';
  }else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
    $error = 'Your email must have @';
  } else if (empty($password)) {
    $error = 'Please enter your password';
  } else if (strlen($password) < 6) {
    $error = 'Password must have at least 6 characters';
  } else {
    $sql_query = "select count(*) as cntUser from account where email='" . $email . "' ";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);
    $count = $row['cntUser']; 
    if ($count > 0) {
      $query = "SELECT * FROM account WHERE email ='" . $email . "'";
      $result2 = mysqli_query($con,$query);
      $row2 = mysqli_fetch_array($result2);
      $email = $row2['email'];
      $pass = $row2['password'];
      $token = $row2['activate_token'];
      $pass_hash = md5($password .'+'. $token);
        if($pass == $pass_hash){
          $_SESSION['email'] = $email;
          $_SESSION['money'] = $row2['money'];
          $_SESSION['firstname'] = $row2['firstName'];
          $_SESSION['lastname'] = $row2['lastName'];
          header('Location: home.php');

        }else{
          $error = "Invalid email and password";
        }
    }else {
      $error = "Invalid email and password";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!-- header -->
    <div class="header">
        <!-- logo -->
        <nav class="navbar navbar-expand-md bg-white navbar-light">
            <!-- Brand -->
            <a class="navbar-brand" href="home.php">
                <img src="images/logo.PNG" width="200" height="50" style="padding-left: 50px;">
            </a>
            
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            </button> 
        
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" id="games" style="padding-top: 8px">       
                        <a class="nav-link" href="games.php"> <img src="images/Game icon.png" style="width:50px"> Trò Chơi</a>
                    </li>
                    <li class="nav-item" id = "apps">
                        <a class="nav-link" href="apps.php"> <img src="images/android icon.png" style="width:50px">Ứng dụng</a>
                    </li>
                    <li class="nav-item" id ="users" style="padding-right: 20px;">
                        <a class="nav-link" href="login.php"> <img src="images/user icon.png" style="width:50px">Đăng nhập</a>
                    </li>
                </ul>
            </div>
        </nav> 
    </div>
    <div class="row" id="row-apps">
        <!-- hot free Games -->
       <div class="col-lg-10 title-item">
           <!-- title Apps hot -->
           <div class="title">
               <h2>Đăng nhập</h2>
           </div>
           <div class="form">
            <form method="post" action="login.php" class="border rounded w-100 mb-5 mx-auto px-3 pt-3 bg-light">
                <div class="form-group-name">
                  <label for="email">Nhập Email:</label>

                   <?php
                    if(isset($_SESSION['email'])){
                      echo( "<input name='email' value='$_SESSION[email]' id='email' type='text' class='form-control' placeholder='Email' required>");
                    }else{
                      echo( "<input name='email' value='' id='email' type='text' class='form-control' placeholder='Email' required>");
                    }
                  ?>
                </div>
                <div class="form-group-name">
                  <label for="password">Nhập mật khẩu:</label>
                  <input name="password" value="" id="password" type="password" class="form-control" placeholder="Mật khẩu">
                </div>
                  <div class="form-group custom-control custom-checkbox">
                    <input name="remember" type="checkbox" class="custom-control-input" id="remember">
                    <label class="custom-control-label" for="remember">Remember login</label>
                  </div>
                <?php
                  if (!empty($error)) {
                    echo "<div class='alert alert-danger'>$error</div>";
                  }
                ?>
                <div class="form-group">
                  <button name="login" type="submit" class="btn btn-success px-5">Đăng nhập</button>
                </div>

              </form>
           </div>
       </div>
    </div>
     <!-- bottom box -->
  <div class="bottom-container">
    <div class="row">
      <div class="col">
        <a href="signup.php" style="color:white" class="btn">Đăng kí</a>
      </div>
      <div class="col">
        <a href="forgot.php" style="color:white" class="btn">Quên mật khẩu?</a>
      </div>
    </div>
  </div>
    <div class="footer">
        <p>
            Copyright by team D.A.T <br>
                    😘😘😘
                  </p>
    </div>
    
</body>
</html>