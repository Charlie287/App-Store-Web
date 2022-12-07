<?php
session_start();
require_once('db.php');
if (isset($_REQUEST['email'])) {
    $error ='';
    $email    = stripslashes($_REQUEST['email']);
    $email    = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $confirm_password = stripslashes($_REQUEST['confirm_password']);
    $confirm_password = mysqli_real_escape_string($con, $confirm_password);
    // $role = $_POST['position'];
    $select = mysqli_query($con, "SELECT `email` FROM `account` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error($con));
    
    

    if (
        empty($email) || empty($password) || empty($confirm_password)
    ) { 
        $error='Vui lòng điền đầy đủ thông tin!';
    }
    else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
        $error = 'Email của bạn thiếu dấu @';
    }
    else if ($password !== $confirm_password) {
        $error='Hai mật khẩu phải trùng nhau!';
        
    }
    else if(mysqli_num_rows($select)) {
        $error ='Email này đã được đăng kí!';
        //  echo "<div class='form'>
        //          <h3>This email is already being used!</h3><br/>
        //          <p class='link'>Click here to <a href='signup.php'>Registration</a></p>
        //          </div>";
        
    }else{
        $rand = random_int(0, 1000);
        $token = md5($email .'+'. $rand);
        $pass = md5($password .'+'. $token);
        $query    = "INSERT into `account` ( password, email, type, activate_token)
            VALUES ('$pass' , '$email','$role','$token')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            $_SESSION['email'] = $email;
            echo"<script>alert('Đăng kí tài khoản thành công')</script>";
            sleep(2);
            header('Location: login.php');
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
    <title>Đăng kí</title>
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
               <h2>Đăng kí</h2>
               <hr>
            <p>Nhập đầy đủ thông tin để tạo tài khoản</p>
           </div>
           <div class="form">
            <form method="post" action="signup.php" novalidate class="border rounded w-100 mb-5 mx-auto px-3 pt-3 bg-light">
                <div class="form-group-name">
                  <label for="email">Nhập Email:</label>
                  <input name="email" value="" id="email" type="text" class="form-control" placeholder="Email">
                </div>
                <div class="form-group-name">
                  <label for="password">Nhập mật khẩu:</label>
                  <input name="password" value="" id="password" type="password" class="form-control" placeholder="Mật khẩu">
                  <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>
                </div>
                <div class="form-group-name">
                    <label for="confirm_password">Nhập lại mật khẩu:</label>
                    <input name="confirm_password" value="" id="password" type="password" class="form-control" placeholder="Mật khẩu">
                    <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>
                  </div>
                  <?php
                        if (!empty($error)) {
                            echo  "<div class='alert alert-danger'>$error</div>";
                        }
                    ?>
                  <hr>
                  <p>Để tạo tài khoản bạn vui lòng chấp nhận <a href="#">Điều khoản và Pháp lý</a>.</p>
                <div class="form-group">
                  <button name="signup" type="submit" class="btn btn-success px-5">Đăng kí</button>
                </div>
              </form>
           </div>
       </div>
    </div>
     
    <div class="container signin">

        <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a>.</p>
    </div>
    <div class="footer">
        <p>
            Copyright by team D.A.T <br>
                    😘😘😘
                  </p>
    </div>
    
</body>
</html>